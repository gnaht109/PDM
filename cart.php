<?php

session_start();

if(isset($_POST['add_to_cart'])){
    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id");  // [2,3,4,10,15] 
        //if product has already been added to cart or not
        if(!in_array($_POST['product_id'], $products_array_ids)  ){

            $product_id = $_POST['product_id']; 

                $product_array = array(
                    'product_id' => $_POST['product_id'],
                    'product_name' => $_POST['product_name'],
                    'product_category' => $_POST['product_category'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity']
                );

                $_SESSION['cart'][$product_id] = $product_array;

            //product has already been added
        }else{

            echo '<script>alert("Product was already added")</script>';

        }

        //if this is the first product
    }else{

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $product_price= $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_category' => $product_category,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        // [  2 => [] , 3 => [] , 5 => [] ]
    }

    //calculate total
    calculateTotalCart();

//remove product from cart
}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    calculateTotalCart();

}else if(isset($_POST['edit_quantity'])){

    //We get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //Get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product's quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;

    calculateTotalCart();

}else{

    //header('location: index.php');
    //go to home page
}


function calculateTotalCart(){

    $total = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        
        $total = $total + ($price * $quantity);

    }

    $_SESSION['total'] = $total;

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

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">

            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/Products/<?php echo $value['product_category']; ?>/<?php echo $value['product_image']; ?>"/>
                        <div>
                            <p>
                                <?php echo $value['product_name']; ?>
                            </p>
                            <small>
                                <span>$</span>
                                <?php echo $value['product_price']; ?>
                            </small>
                            <br>
                            <!--remove button-->
                            <form method="POST" action="cart.php"> 
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="remove">
                            </form>

                        </div>
                    </div>
                </td>
                
                <td>
                    <!--Edit button-->
                    <form method="POST"action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                        <input type="submit" class="edit-btn" value="edit" name="edit_quantity"/>
                    </form>

                </td>

                <td>
                    <span>$</span>
                    <span class="product-price">
                        <?php echo $value['product_quantity'] * $value['product_price']; ?>
                    </span>
                </td>
            </tr>

            <?php } ?>

        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>
                        Total
                    </td>
                    <td>
                        $<?php echo $_SESSION['total']?>
                    </td>
                </tr>
            </table>
        </div>
        
        <!--Checkout Button-->
        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout"> 
            <form>
        </div>

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