<?php
session_start();
include('connection.php');

// Check if the user is logged in (you can adjust this if needed)
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

// Check if the delete button was pressed and the order_id is set
if(isset($_POST['order_delete']) && isset($_SESSION['order_id'])) {

    $order_id = $_SESSION['order_id'];

    // Delete all order items first from the order_items table
    $stmt1 = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
    $stmt1->bind_param('i', $order_id);

    // Execute the deletion
    if($stmt1->execute()) {

        // Now delete the order itself from the orders table
        $stmt2 = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt2->bind_param('i', $order_id);

        // Execute the deletion
        if($stmt2->execute()) {
            // Success: Redirect user to their account page
            $_SESSION['message'] = "Order has been deleted successfully!";
            header('location: ../account.php');
            exit;
        } else {
            // If the deletion fails, show an error
            $_SESSION['message'] = "Failed to delete the order. Please try again.";
            header('location: ../account.php');
            exit;
        }
    } else {
        // If deleting order items fails, show an error
        $_SESSION['message'] = "Failed to delete the order items. Please try again.";
        header('location: ../account.php');
        exit;
    }
} else {
    // Redirect back if no order id is provided
    header('location: ../account.php');
    exit;
}
?>
