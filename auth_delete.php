<?php
$servername="localhost";
$username="root";
$password="";
$database="enock";


$conn=mysqli_connect($servername,$username,$password,$database);

if(isset($_GET['id'])){
    $id=$_GET['id'];

$sql="DELETE FROM details WHERE id='$id'";
$result=mysqli_query($conn,$sql);

if ($result) {
    header("Location: auth_read.php"); // Redirect to auth_read.php after successful update
    exit(); // Make sure to exit after redirection
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}


?>