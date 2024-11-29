<?php

session_start();

include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

date_default_timezone_set('Asia/Ho_Chi_Minh');

$localDateTime = date('Y-m-d H:i:s');


if(isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];

}

$user_id = $_SESSION["user_id"];
$payment_cost = $_SESSION['total_price'];
$sql = "SELECT * FROM users WHERE user_id='{$user_id}' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_name = $row["user_name"];
$_SESSION["user_name"] = $user_name;
$user_email = $row["user_email"];
$_SESSION["user_email"] = $user_email;

?>

    <?php include('layouts/header.php');?>

    <!--Payment-->
    


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">

            <h2 class="form-weight-bold">Billing Address</h2>
            <hr class = "mx-auto">
        </div>
        <div class ="mx-auto container text-center">

            <!-- If STMT 1 -->
            <?php if(isset($_SESSION['total_price']) && $_SESSION['total_price'] != 0) { ?>
                <?php $order_id = $_POST['order_id'] ?? "";?>
                <div class="container mt-5">
                    <form id="payment-form" method="POST" action="server/payment_completed.php">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" id="payment-name" name="name" placeholder="Pham Nguyen Viet Thang" readonly value="<?php echo $_SESSION["user_name"] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="payment-email" name="email" placeholder="vietthang05p@gmail.com" readonly value="<?php echo $_SESSION["user_email"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" id="payment-date" name="date" readonly value="<?php echo "$".$payment_cost ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="datetime-local" class="form-control" readonly value="<?php echo $localDateTime ?>">
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Card Owner:</label>
                                    <input class="form-control" name="card_holder" type="text" placeholder="CARD HOLDER"required >
                                </div>
                                <div class="form-group">
                                    <label>Card Number:</label>
                                    <input class="form-control" required name="card_number" type="tel" placeholder="1111 2222 3333 4444">
                                </div>
                                <div class="form-group">
                                    <label>Exp Year:</label>
                                    <input class="form-control" required name="exp_year" type="text" placeholder="2077">
                                </div>
                                <div class="flex">
                                    <div class="form-group">
                                        <label>Exp Month:</label>
                                        <input class="form-control" required name="exp_month" type="text" placeholder="October">
                                    </div>
                                    <div class="form-group">
                                        <label>CVV:</label>
                                        <input class="form-control" required name="CVV" type="text" placeholder="132">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <button class="btn payment-submit-btn" type="submit" name="payment-submit-btn" value="Pay Now">
                            Pay now
                        </button>
                    </form>
                </div>


            <!-- Else If -->
            <?php } else if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
                <?php $order_id = $_POST['order_id'] ?? "";?>
                <div class="container mt-5">
                    <form id="payment-form" method="POST" action="payment.php">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <h3 class="title">Billing Address</h3>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" id="payment-name" name="name" placeholder="Pham Nguyen Viet Thang" readonly value="<?php echo $_SESSION["user_name"] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="payment-email" name="email" placeholder="vietthang05p@gmail.com" readonly value="<?php echo $_SESSION["user_email"] ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" id="payment-date" name="date" readonly value="<?php echo "$".$payment_cost ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="datetime-local" class="form-control" readonly value="<?php echo $localDateTime ?>">
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6">
                                <h3 class="title">Payment</h3>
                                <div class="form-group">
                                    <span>Card Accepted:</span>
                                    <img src="assets/imgs/imgcards.png" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Card Owner:</label>
                                    <input class="form-control" name="card_holder" type="text" placeholder="CARD HOLDER"required >
                                </div>
                                <div class="form-group">
                                    <label>Card Number:</label>
                                    <input class="form-control" required name="card_number" type="tel" placeholder="1111 2222 3333 4444">
                                </div>
                                <div class="form-group">
                                    <label>Exp Year:</label>
                                    <input class="form-control" required name="exp_year" type="text" placeholder="2077">
                                </div>
                                <div class="flex">
                                    <div class="form-group">
                                        <label>Exp Month:</label>
                                        <input class="form-control" required name="exp_month" type="text" placeholder="October">
                                    </div>
                                    <div class="form-group">
                                        <label>CVV:</label>
                                        <input class="form-control" required name="CVV" type="text" placeholder="132">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <button class="btn btn-primary" type="submit" name="payment-submit-btn" value="Pay Now">
                            Pay now
                        </button>
                    </form>
                </div>



            <!-- Else -->
            <?php } else { ?>
                <p style="color: red" >Your cart is empty</p>

            <?php } ?>



        </div>
    </section>


    <?php include('layouts/footer.php'); ?>