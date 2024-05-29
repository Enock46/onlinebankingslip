<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction Success</title>
</head>
<body>
    <div id="navbar">
        <a href="success.php">Back</a>
        <a href="" onclick="printTransactionDetails()">Print</a>
        <a href="home.php">Log Out</a>
    </div>
    <br><br>
    <div class="transaction-details">
        <h3 style="  color:green";><i>Transaction Details</i></h3>
        <form id="transactionForm">
            <label for="bankType">Bank Type:</label>
            <input type="text" id="bankType" name="bankType" value="<?php echo isset($_SESSION["bankType"]) ? $_SESSION["bankType"] : ''; ?>" readonly><br><br>

            <label for="accountNumber">Account Number:</label>
            <input type="text" id="accountNumber" name="accountNumber" value="<?php echo isset($_SESSION["accountNumber"]) ? $_SESSION["accountNumber"] : ''; ?>" readonly><br><br>

            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" value="<?php echo isset($_SESSION["amount"]) ? $_SESSION["amount"] : ''; ?>" readonly><br><br>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo isset($_SESSION["phoneNumber"]) ? $_SESSION["phoneNumber"] : ''; ?>" readonly><br><br>

            <label for="transactionType">Transaction Type:</label>
            <input type="text" id="transactionType" name="transactionType" value="<?php echo isset($_SESSION["transactionType"]) ? $_SESSION["transactionType"] : ''; ?>" readonly><br><br>
        </form>
        <center><!-- Add a new button for downloading -->
<button type="button" onclick=" printTransactionDetails()"><i>DOWNLOAD</i></button>
</center>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
        // Function to print transaction details
        function printTransactionDetails() {
            // Open a new window and print the content
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Transaction Details</title></head><body>');
            printWindow.document.write('<h1>Transaction Details</h1>');
            printWindow.document.write(document.getElementById('transactionForm').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
        
    </script>
</body>
</html>

<style>
    body {
        background-color: #f3f3f3;
        margin: 0;
        padding: 0;
        font-family: 'Times New Roman', Times, serif;
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

    .transaction-details {
        width: 50%;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .transaction-details h3 {
        text-align: center;
        font-style: italic;
        color: #333;
    }

    #transactionForm label {
        display: block;
        margin: 10px 0;
        font-weight: bold;
        color: #333;
    }

    #transactionForm input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: lightgreen;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    h3{
        font-family: Georgia, serif;
        font-style: italic;
          
    }
</style>
