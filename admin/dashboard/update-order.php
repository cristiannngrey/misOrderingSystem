<?php

include 'dbconn.php';

$order_id = $_POST['order_id'];

$sql2 = "UPDATE cart_orders SET status='9' WHERE order_id = '$order_id'";
$result2 = mysqli_query($conn,$sql2);

header("location: orders.php");
?>