<?php

session_start();

include("server/connection.php");

//if user has already registered, take user to account page
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;

}

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    //if password dont match
    if($password !== $confirmPassword){
        header('location: register.php?error=passwords did not match');
    
    //if password is too short
    }else if(strlen($password) < 6){
        header('location: register.php?error=password must be at least 6 characters');
    
    //if there is no error
    }else{
        //check whether there is a user with this email or not?
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        //if there is a user already registered with this email
        if($num_rows != 0){
            header('location: register.php?error=user with this email already exists');

        //if no user registered with this email before
        }else{   
            $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password)
                        VALUES(?,?,?)");

            $stmt -> bind_param('sss',$name,$email,md5($password));

            //if account was created successfully
            if($stmt -> execute()){
                
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Your registation successfully');

            //account could not be created
            }else{
                header('location: register.php?error=could not create an account at the moment');

            }

        }

    }

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
                <a class="nav-link" href="shop.html">Shop</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item ">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>

              <li class="nav-item ">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="account.html"><i class="fa-solid fa-user"></i></a>             
              </li>

            </ul>

          </div>
        </div>
      </nav>

    <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
                <p style="color:red">
                    <?php if(isset($_GET['error'])) {
                        echo $_GET['error'];
                        }?>
                </p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
                </div>
                
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>

                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn" href="login.html">Already have an a account?</a>
                </div>
                
            </form>
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