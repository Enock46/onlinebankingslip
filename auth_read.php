<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "enock";

$conn = mysqli_connect($servername, $username, $password, $database);

$searchText = "";

if (isset($_POST['search'])) {
    $searchText = $_POST['searchText'];
    $searchText = mysqli_real_escape_string($conn, $searchText);

    $sql = "SELECT details.*, transactions.bank_type, transactions.account_number, transactions.amount, 
                   transactions.phone_number, transactions.email, transactions.transaction_type, transactions.confirmation_code, transactions.status 
            FROM details
            LEFT JOIN transactions ON details.id = transactions.user_id
            WHERE details.email LIKE '%$searchText%' OR transactions.confirmation_code = '$searchText'";
} else {
    $sql = "SELECT details.*, transactions.bank_type, transactions.account_number, transactions.amount, 
                   transactions.phone_number, transactions.email, transactions.transaction_type, transactions.confirmation_code, transactions.status 
            FROM details
            LEFT JOIN transactions ON details.id = transactions.user_id";
}

$result = mysqli_query($conn, $sql);

if (isset($_POST['toggleStatus'])) {
    $transactionId = $_POST['transaction_id'];
    $currentStatus = $_POST['current_status'];
    
    $newStatus = ($currentStatus === 'Pending') ? 'Completed' : 'Pending';
    
    $updateStatusSql = "UPDATE transactions SET status = '$newStatus' WHERE id = '$transactionId'";
    if ($conn->query($updateStatusSql) === TRUE) {
        // Success
        echo 'Status updated successfully';
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Read</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="navbar">
        <!-- <a href="home.php">Home</a> -->
        <a href="login.php">Log Out</a>
    </div>

    <div class="main-container">
        <h2> <i>User and Transaction Details</i></h2>
        <div class="search-container">
            <form method="POST" action="auth_read.php">
                <input type="text" name="searchText" value="<?php echo $searchText; ?>" placeholder="Search by Email or Confirmation Code">
                <button type="submit" name="search">Search</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>User Email</th>
                    <th>Phone Number</th>
                    <th>Password</th>
                    <th>Bank Type</th>
                    <th>Account Number</th>
                    <th>Amount</th>
                    <th>Transaction Type</th>
                    <th>Confirmation Code</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['passwordI']; ?></td>
                            <td><?php echo $row['bank_type']; ?></td>
                            <td><?php echo $row['account_number']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['transaction_type']; ?></td>
                            <td><?php echo $row['confirmation_code']; ?></td>
                            <td>
                                <a href="auth_update.php?id=<?php echo $row['id']; ?>">UPDATE</a> |
                                <a href="auth_delete.php?id=<?php echo $row['id']; ?>">DELETE</a>
                            </td>
                            <td>
                                <form class="status-form">
                                    <input type="hidden" name="transaction_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="current_status" value="<?php echo $row['status']; ?>">
                                    <button type="button" class="status-button <?php echo ($row['status'] === 'Pending') ? 'status-pending' : 'status-completed'; ?>">
                                        <?php echo $row['status']; ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
       $(document).ready(function () {
    // Use event delegation to handle click events on .status-button
    $(document).on("click", ".status-button", function () {
        var button = $(this);
        var transactionId = button.siblings('form.status-form').find('input[name="transaction_id"]').val();
        var currentStatus = button.siblings('form.status-form').find('input[name="current_status"]').val();

        $.ajax({
            type: "POST",
            url: "auth_read.php", // Replace with the actual URL of this page
            data: { transaction_id: transactionId, current_status: currentStatus },
            success: function (response) {
                // Update the button text and class
                if (currentStatus === "Pending") {
                    button.text("Completed");
                    button.removeClass("status-pending");
                    button.addClass("status-completed");
                    button.siblings('form.status-form').find('input[name="current_status"]').val("Completed");
                } else {
                    button.text("Pending");
                    button.removeClass("status-completed");
                    button.addClass("status-pending");
                    button.siblings('form.status-form').find('input[name="current_status"]').val("Pending");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

    </script>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

#navbar {
    background-color: #333;
    color: white;
    padding: 10px 20px;
}

#navbar a {
    color: lightgreen;
    text-decoration: none;
    margin-right: 20px;
}

.main-container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.search-container {
    text-align: center;
    margin-bottom: 20px;
}

.search-container input[type="text"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.search-container button {
    background-color: lightgreen;
    color: #333;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: lightgreen;
    color: #333;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

a {
    text-decoration: none;
    color: lightseagreen;
}

.status-button {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: capitalize;
}

.status-pending {
    background-color: lightseagreen;
    color: #333;
}

.status-completed {
    background-color: gray;
    color: white;
}

h2 {
    font-family: Georgia, serif;
    color: green;
}
</style>
