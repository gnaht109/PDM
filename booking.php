<?php

session_start();

include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}




?>
      
    <?php include('layouts/header.php');?>

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Booking service</h2>
            <hr class = "mx-auto">
        </div>

        <div class ="mx-auto container text-center">
                <div class="container mt-3">
                    <form id="booking-form" method="POST" action="server/booking_completed.php">
                            <!-- First Column -->
                            <div >
                                <div class="form-group mt-3">
                                    <label class="mb-2">Full Name</label>
                                    <input type="text" class="form-control" id="booking-name" name="booking_name" placeholder="Pham Nguyen Viet Thang" required/>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-2">Email</label>
                                    <input type="email" class="form-control" id="booking-email" name="booking_email" placeholder="vietthang05p@gmail.com" required />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-2">Phone</label>
                                    <input type="tel" class="form-control" id="booking-phone" name="booking_phone" placeholder="0868278098" required />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-2">Plate</label>
                                    <input type="text" class="form-control" id="booking-plate" name="booking_plate" placeholder="78469" required />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-2">Date</label>
                                    <input type="datetime-local" name="booking_date" class="form-control" >
                                </div>

                                <div class="container form-group mt-3">
                                    <label for="service">Choose a serives:</label>
                                    <select id="booking-serivce" name="booking_service">
                                        <option value="routine inspection">Routine Inspection</option>
                                        <option value="general inspection">General Inspection</option>
                                        <option value="parts replacement">Parts Replacement</option>
                                        <option value="vehicle cleaning">Vehicle Cleaning</option>
                                        <option value="maintainance">Maintain</option>
                                        <option value="oil change">Oil changing</option>
                                    </select>
                                </div>

                                
                            </div>

                        <button class="btn btn-primary mt-5 book-btn" type="submit" name="booking-submit-btn" value="Book Now">
                            Book now
                        </button>
                    </form>
                </div>
    </section>


    <?php include('layouts/footer.php'); ?>