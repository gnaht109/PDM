<?php

session_start();

include('connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if (isset($_POST["booking-submit-btn"])) {
    
    $booking_status = "booked";
    $user_id = $_SESSION['user_id'];

    $booking_name = $_POST['booking_name'];
    $booking_email = $_POST['booking_email'];
    $booking_phone = $_POST['booking_phone'];
    $booking_plate = $_POST['booking_plate'];
    $booking_date = $_POST['booking_date'];
    $booking_service = $_POST['booking_service'];


    $stmt1 = $conn -> prepare("INSERT INTO bookings (user_id,booking_name,booking_email,booking_phone,booking_plate,booking_date,booking_service,booking_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
    $stmt1->bind_param("isssssss", $user_id, $booking_name, $booking_email, $booking_phone, $booking_plate, $booking_date, $booking_service, $booking_status);    

    $stmt1->execute();



    header("location:../account.php?booking_message=booking successfully");

}else{

    header("location:../index.php");
    exit;

}




?>