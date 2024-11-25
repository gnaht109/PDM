<?php

include('connection.php');

$stmt = $conn->prepare("SELECT*FROM products WHERE product_category='motorbike'LIMIT 4");

$stmt-> execute();

$motorbikes_products = $stmt->get_result();

?>