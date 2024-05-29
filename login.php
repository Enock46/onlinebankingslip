<?php
session_start();

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $confirmPassword = $_POST["password"];
    $userType = $_POST["user_type"]; // Add a user type field to determine if the user is admin or regular user

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $database = "enock";

    $conn = new mysqli($servername, $username, $dbpassword, $database);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    // Determine the SQL query based on the user type
    if ($userType == 'admin') {
        $sql = "SELECT id, admin_reg_number, password FROM admin WHERE admin_reg_number = '$email'";
    } else {
        $sql = "SELECT id, email, passwordI FROM details WHERE email = '$email'";
    }

    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Fetch the password based on user type
        $storedPassword = $userType == 'admin' ? $row["password"] : $row["passwordI"];

        if ($confirmPassword === $storedPassword) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["email"] = $email;

            // Redirect based on user type
            if ($userType == 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: slip.php");
            }
            exit();
        } else {
            $loginError = "Invalid email or password.";
        }
    } else {
        $loginError = "Invalid email or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>

<body>
    <div id="navbar">
        <a href="home.php">Home</a>
        <a href="auth_register.php">Register</a>
    </div>
    <br><br><br><br><br>

    <form class="login-form" method="POST" action="">
        <center><h1> <i>Bank Slip Login</i></h1></center>
        <label for="email">Email/Admin Reg :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="user_type">Login as:</label>
        <select id="user_type" name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <button type="submit">Login</button>
        <p style="color: red;"><?php echo $loginError; ?></p>
    </form>
</body>
</html>

<style>
    body {
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    #navbar {
        background-color: #333;
        color: white;
        text-align: right;
        padding: 10px 20px;
    }

    #navbar a {
        color: lightgreen;
        text-decoration: none;
        padding: 5px 10px;
    }

    #navbar a:hover {
        background-color: lightgreen;
        color: black;
        border-radius: 5px;
    }

    .login-form {
        width: 50%;
        margin: auto;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-form label {
        display: inline-block;
        width: 150px;
    }

    .login-form input[type="email"],
    .login-form input[type="password"],
    .login-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 25px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .login-form button {
        background-color: lightgreen;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    h1 {
        text-align: center;
        padding: 20px;
        font-family: Georgia, serif;
        color: green;
    }
</style>
