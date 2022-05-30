<?php
include_once "connection.php";

$sql = "SELECT * FROM products";
$products = $conn->query($sql);

?>