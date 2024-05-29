<?php
session_start();
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
</head>
<body>
    <div id="navbar">
        <a href="#">Home</a>
        <a href="auth_register.php">Register</a>
        <a href="login.php">Login</a>
    </div>

    <div class="bank-website">
        <i><h1>Welcome to Greenlight Bank</h1></i> 
        <p>Experience secure and convenient banking services with us.</p>
        <div class="image-container">
            <img src="./img/pic1.jpg" alt="Image 1">
            <img src="./img/pic2.jpg" alt="Image 2">
            <img src="./img/pic3.jpg" alt="Image 3">
            <img src="./img/pic4.jpg" alt="Image 4">
            <img src="./img/pic5.jpg" alt="Image 5">
        </div>
        <br><br>
        <div class="call-to-action">
            <div class="cta-heading">Use online Bank slip today!</div>
            <div class="cta-message">Unlock a world of financial possibilities. Enjoy easy transactions, secure payments, and exclusive offers.
                <br><br> <i>Easy and Fast</i>
            </div>
            <a href="auth_register.php" class="cta-button">Get Started</a>
        </div>
    </div>
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
        background-color: #333;1
        color: white;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
    }

    #navbar a {
        color: lightgreen;
        text-decoration: none;
        padding: 5px 10px;
    }

    #navbar a:hover {
        background-color: #ddd;
        color: black;
        border-radius: 5px;
    }

    .bank-website {
        background: url('./img/enoc2.jpg') no-repeat center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        margin: 50px auto;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        height: 800px;
        overflow: hidden;
        margin-top: 6px;
    }

    .bank-website h1 {
        margin-bottom: 20px; /* Add spacing between title and paragraph */
        font-size: 28px; /* Increase font size for the title */
        color: #333; /* Change title color */
    }

    .image-container {
        display: flex;
        animation: moveImages 15s linear infinite; /* Animation for moving images */
    }

    .bank-website img {
        max-width: 250px; /* Increase maximum width for larger images */
        height: auto;
        margin: 0; /* Remove margin for precise positioning */
        padding: 20px; /* Add more padding between images */
        border-radius: 10px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        animation: moveImage 15s linear infinite; /* Animation for each image */
    }

    .call-to-action {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 30px;
        border-radius: 10px;
        margin-top: 30px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .cta-heading {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .cta-message {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .cta-button {
        background-color: lightgreen;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block; /* Display button inline */
    }
</style>
