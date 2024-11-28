<?php

/*
not paid
shipped
delivered
*/

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ? ");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

}else{

    header('location: account.php');
    exit;

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pikachu</title>
    <link rel="icon" type="image/png" href="assets/imgs/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/99bc1cbf38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary fixed-top">
        <div class="container">
          <img class="logo" src="assets/imgs/logo.png"/>
          <h2 class="brand">Pikachu</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>

              <li class="nav-item ">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="account.php"><i class="fa-solid fa-user"></i></a>             
              </li>

            </ul>

          </div>
        </div>
    </nav>


    <!--Orders-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h3 class="font-weight-bold text-center">Your Orders</h3>
            <hr class="mx-auto">
        </div>

        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php while($row = $order_details->fetch_assoc()){ ?>
            
            <tr>
                <td>
                    <div class = "product-info">
                        <img src="assets/imgs/Products/<?php echo $row['product_category'];?>/<?php echo $row['product_image'];?>"/>         
                        <div>
                            <p class="mt-3">
                                <?php
                                    echo $row['product_name'];
                                ?>
                            </p>
                        </div>
                    </div>
                </td>

                <td>
                    <span>$
                        <?php
                            echo $row['product_price'];
                        ?>
                    </span>
                </td>

                <td>
                    <span>
                        <?php
                            echo $row['product_quantity']
                        ?>
                    </span>
                </td>
                
            </tr>

            <?php } ?>

        </table>

        <!--Pay Now Button-->
        <?php if($order_status == "not paid"){ ?>
            <form style="float: right;">
                <input type="submit" class="btn btn-primary" value="Pay Now"/>
            </form>
        <?php } ?>

    </section>

    
    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto  pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/logo.png"/>
                <p class="pt-3">
                    Pika pika pika
                </p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">
                    Feature
                </h5>
                <ul class="text-uppercase">
                    <li><a href="#">Handling</a></li>
                    <li><a href="#">Break</a></li>
                    <li><a href="#">Mirror</a></li>
                    <li><a href="#">Light</a></li>
                    <li><a href="#">Motorbike</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">
                    Contact Us
                </h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>International University, Thu Duc city</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>0868278098</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>vietthang05p@gmail.com</p>
                </div>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-sm-12 ">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/imgs/logo.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/logo.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/logo.png" class="img-fluid w-25 h-100 m-2"/>
                </div>
            </div>

            <div class="copyright mt-5">
                <div class="row container mx-auto">
                    <div class="col-lg-3 col-md-6 col-md-12 mb-4">
                        <img src="assets/imgs/payment.png"/>
                    </div>
                    <div class="col-lg-3 col-md-6 col-md-12 mb-4 text-nowrap mb-2">
                        <p>eCommerce @ 2025 All Right Reserved</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-md-12 mb-4">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>

                    </div>
                </div>
            </div>

        </div>
      </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>