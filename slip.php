<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "enock";

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    // You might want to get the user ID from your session variable
    $userId = $_SESSION["user_id"];

    // Get other form data
    $bankType = $_POST["bankType"];
    $accountNumber = $_POST["accountNumber"];
    $amount = $_POST["amount"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $transactionType = $_POST["transactionType"];
    $code = generateUserCode($transactionType);

    // Insert transaction data into the database, associating it with the user ID
    $insertSql = "INSERT INTO transactions (user_id, bank_type, account_number, amount,phone_number, email, transaction_type, confirmation_code,status) 
                  VALUES ('$userId', '$bankType', '$accountNumber', '$amount','$phoneNumber', '$email', '$transactionType', '$code','pending')";

    if ($conn->query($insertSql) === TRUE) {
        $_SESSION["confirmation_code"] = $code; // Store the code in a session variable
        $_SESSION["bankType"] = $bankType;
        $_SESSION["accountNumber"] = $accountNumber;
        $_SESSION["amount"] = $amount;
        $_SESSION["phoneNumber"] = $phoneNumber;
        $_SESSION["transactionType"] = $transactionType;

        header("Location: success.php");
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

function generateUserCode($transactionType) {
    $characters = '0123456789';
    $typeCode = substr($transactionType, 0, 4); // Get the first four letters of the transaction type.

    $code = $typeCode; // Initialize with the transaction type code.

    for ($i = 0; $i < 5; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)]; // Append five random numbers.
    }

    return $code;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bank slip</title>
</head>
<body>
    <div id="navbar">
        <a href="#">Help</a>
        <a href="success.php">View Transaction code</a>
        <a href="login.php">Cancel Transaction</a>
        <a href="home.php">Log Out</a>
    </div>
    <br><br>

    <form id="transactionForm" method="POST" action="slip.php">
         <h2> <i>Bank Deposit/Withdraw Form</i></h2>
         <br>
        <label for="bankType">Bank Type:</label>
        <select id="bankType" name="bankType">
            <option value="CRDB">CRDB</option>
            <option value="NMB">NMB</option>
            <option value="NBC">NBC</option>
            <option value="Exim Bank">Exim Bank</option>
            <option value="BACKCLAYS">BACKCLAYS</option>
            <option value="Amana Bank">Amana Bank</option>
            <option value="VICOBA">VICOBA</option>
             <option value="DTB">DTB</option>
             <option value="ABSA">ABSA</option>
             <option value="Equity Bank">Equity Bank</option>
             <option value="Bank of Africa">Bank of Africa</option>

            
            <!-- Add more bank options here -->
        </select><br><br>

        <label for="accountNumber">Account Number:</label>
        <input type="number" id="accountNumber" name="accountNumber" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" placeholder="eg.5000" required><br><br>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="radio" id="deposit" name="transactionType" value="deposit" checked>
        <label for="deposit">Deposit</label>
        <input type="radio" id="withdrawal" name="transactionType" value="withdrawal">
        <label for="withdrawal">Withdrawal</label><br><br>

        <button type="submit">Submit</button>
        <br>
        <div id="confirmationCode" style="display: none;">
            <label for="code">Confirmation Code:</label>
            <input type="text" name="code" id="code" readonly>
        </div>
    </form>
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

    h2 {
        text-align: center;
        padding: 20px;
        font-family: Georgia, serif;
            color:green;
        
    }

    form {
        width: 50%;
        margin: auto;
        height: 700px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: inline-block;
        width: 150px;
    }

    input[type="text"],
    input[type="tel"],
    input[type="number"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 25px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    button {
        background-color: lightgreen;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #confirmationCode {
        display: none;
        margin-top: 20px;
        width: 50%;
        margin: auto;
        padding: 30px;
    }
</style>
