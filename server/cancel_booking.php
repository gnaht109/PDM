<?php
session_start();
include('connection.php');  // Ensure you have the database connection file included

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login.php'); // Redirect if the user is not logged in
    exit;
}

if (isset($_POST['cancel_booking'])) {
    // Get the booking ID from the POST request
    $booking_id = $_POST['booking_id'];

    // Check if the booking ID exists
    if (isset($booking_id) && !empty($booking_id)) {
        // Update the booking status to "Cancelled"
        $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
        $stmt->bind_param('i', $booking_id);

        if ($stmt->execute()) {
            // Redirect with a success message
            header('Location: ../account.php?message=Booking cancelled successfully');
        } else {
            // Redirect with an error message
            header('Location: ../account.php?error=Failed to cancel booking');
        }
    } else {
        // Redirect if no booking ID is provided
        header('Location: ../account.php?error=Invalid booking ID');
    }
}
?>
