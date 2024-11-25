<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();

    $products = $stmt->get_result();

    //no product id given
}else{

    header('location: index.php');

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/99bc1cbf38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
    
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary fixed-top">
        <div class="container">
          <img class="logo" src="assets/imgs/1.png"/>
          <h2 class="brand">Megaman</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="shop.html">Shop</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>

              <li class="nav-item ">
                <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="account.html"><i class="fa-solid fa-user"></i></a>             
              </li>

            </ul>

          </div>
        </div>
      </nav>
    
    <!--Single Product-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

       <?php while($row = $products->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" id="mainImg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image1']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <h6>
                    <?php echo $row['product_category']; ?>
                </h6>
                <h3 class="py-4">
                    <?php echo $row['product_name']; ?>
                </h3>
                <h2>
                    $<?php echo $row['product_price']; ?>
                </h2>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_category" value="<?php echo $row['product_category']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1"/>
                    <button class="buy-btn" type="submit" name="add_to_cart">
                    Add To Cart
                    </button>
                </form>

                <h4 class="mt-5 mb-5">
                    Product details
                </h4>
                <span>
                    <?php echo $row['product_description']; ?>
                </span>
            </div>

        </form>

        <?php } ?>

        </div>
      </section>

    <!--Featured-->
    <section id="featured" class="my-5 pd-5">
            <div class="container text-center mt-5 py-5">
                <h3>Related products</h3>
                <hr>
                <p>Here you can check out our featured </p>
            </div>
            <div class="row mx-auto container-fluid">
                <!--Product 1-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/f1.png"/>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        Megaman
                    </h5>
                    <h4 class="p-price">
                        9.99$
                    </h4>
                    <button class="buy-btn">
                        Buy now
                    </button>
                </div>
                <!--Product 2-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/f1.png"/>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        Megaman
                    </h5>
                    <h4 class="p-price">
                        9.99$
                    </h4>
                    <button class="buy-btn">
                        Buy now
                    </button>
                </div>
                <!--Product 3-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/f1.png"/>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        Megaman
                    </h5>
                    <h4 class="p-price">
                        9.99$
                    </h4>
                    <button class="buy-btn">
                        Buy now
                    </button>
                </div>
                <!--Product 4-->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/f1.png"/>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name">
                        Megaman
                    </h5>
                    <h4 class="p-price">
                        9.99$
                    </h4>
                    <button class="buy-btn">
                        Buy now
                    </button>
                </div>
            </div>
      </section>

    <!--Footer-->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto  pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/1.png"/>
                <p class="pt-3">
                    We provide the best services with the best prices
                </p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">
                    Feature
                </h5>
                <ul class="text-uppercase">
                    <li><a href="#">men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">boys</a></li>
                    <li><a href="#">girls</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">clothes</a></li>
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
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/1.png" class="img-fluid w-25 h-100 m-2"/>
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
    <script>

        var mainImg = document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for(let i=0; i<4; i++){
            smallImg[i].onclick = function(){
                mainImg.src = smallImg[i].src;
            }
        }
    </script>
</body>
</html>