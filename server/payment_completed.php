<?php

session_start();

include('connection.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');

$localDateTime = date('Y-m-d H:i:s');



if (isset($_POST["payment-submit-btn"]) && isset($_SESSION['order_id'])) {
    
    $order_id = $_SESSION['order_id'];
    $order_status = "paid";
    $user_id = $_SESSION['user_id'];

    $payment_cost = $_SESSION['total_price'];
    $card_number = $_POST['card_number'];
    $card_holder = $_POST['card_holder'];
    $exp_year = $_POST['exp_year'];
    $exp_month = $_POST['exp_month'];
    $CVV = $_POST['CVV'];

    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param('si',$order_status,$order_id);

    $stmt->execute();

    $stmt1 = $conn -> prepare("INSERT INTO payments (order_id,user_id,payment_cost,payment_date,
                                                card_number,card_holder,exp_year,exp_month,CVV) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
    $stmt1->bind_param("iiissssss", $order_id, $user_id, $payment_cost, $localDateTime, 
                                $card_number, $card_holder, $exp_year, $exp_month, $CVV);    

    $stmt1->execute();



    header("location:../account.php?payment_message=paid successfully");

}else{

    header("location:../index.php");
    exit;

}




?>