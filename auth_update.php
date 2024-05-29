<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "enock";

$conn = mysqli_connect($servername, $username, $password, $database);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullName = $_POST['full_name'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];

    // Check if a new password is provided, if not, keep the existing password
    if (!empty($newPassword)) {
        $sql = "UPDATE details SET full_name='$fullName', email='$email', passwordI='$newPassword', phone_number='$phoneNumber' WHERE id='$id'";
    } else {
        $sql = "UPDATE details SET full_name='$fullName', email='$email', phone_number='$phoneNumber' WHERE id='$id'";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: auth_read.php"); // Redirect to auth_read.php after a successful update
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM details WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fullName = $row['full_name'];
            $email = $row['email'];
            $password = $row['passwordI'];
            $phoneNumber = $row['phone_number'];
            $id = $row['id'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    
</head>
<body>
    <h2 class="header2";> <i>Edit User Details</i></h2>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $fullName; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <!-- Keep the 'New Password' field with current password value -->
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" value="<?php echo $password; ?>"><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $phoneNumber; ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-family: Georgia, serif;
            color:green;
        }

        form {
            width: 50%;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: lightgreen;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
       
    </style>
