<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phoneNumber =$_POST["phoneNumber"];
    $dbpassword = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if passwords match
    if ($dbpassword !== $confirmPassword) {
       echo "Passwords do not match.";
    } else {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $database = "enock";

        // Create a database connection
        $conn = new mysqli($servername, $username, $dbpassword, $database);

        if($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }

        // SQL query to insert user data into the database
        $sql = "INSERT INTO details (full_name, email,phone_number, passwordI) VALUES ('$fullName', '$email','$phoneNumber', '$confirmPassword')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<div id="navbar">
    <a href="home.php">Home</a>
    <!-- <a href="#">Register</a> -->
    <a href="login.php">Login</a>
</div>
   <br><br><br>
<body>
    <form class="register-form" method="POST" onsubmit="return validateForm()">
        <!-- Your form fields here -->
        <center><h2> <i>Bank slip Registration</i></h2></center> 
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br>
        <p id="passwordMatchError" style="color: red; display: none;">Passwords do not match!</p>
        <button type="submit">Register</button>
    </form>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                document.getElementById("passwordMatchError").style.display = "block";
                return false;
            } else {
                document.getElementById("passwordMatchError").style.display = "none";
                return true;
            }
        }
    </script>
</body>
</html>
<style>
    body {
        background-color: #f5f5f5; /* Milk color */
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
    h2{
    
        font-family: Georgia, serif;
        color:green;
    }

    .register-form {
        width: 50%;
        margin: auto;
        height: 700px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .register-form label {
        display: inline-block;
        width: 150px;
    }

    .register-form input[type="text"],
    .register-form input[type="tel"],
    .register-form input[type="email"],
    .register-form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 25px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .register-form button {
        background-color: lightgreen;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>