<?php
// Check if the required data is received
if (isset($_POST['transaction_id']) && isset($_POST['new_status'])) {
    $transactionId = $_POST['transaction_id'];
    $newStatus = $_POST['new_status'];

    // Perform the database update here (you should use prepared statements to prevent SQL injection)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "enock";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $updateStatusSql = "UPDATE transactions SET status = '$newStatus' WHERE id = '$transactionId'";
    if ($conn->query($updateStatusSql) === TRUE) {
        // Status updated successfully
        echo 'Status updated successfully';
    } else {
        echo "Error updating status: " . $conn->error;
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid data received.";
}
?>
