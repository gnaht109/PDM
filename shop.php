<?php

include('server/connection.php');

//use the search section
if(isset($_POST['search'])){

    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT*FROM products where product_category = ? ");

    $stmt->bind_param("s",$category);

    $stmt-> execute();
    
    $products = $stmt->get_result();    




    //return all products
}else{

    $stmt = $conn->prepare("SELECT*FROM products");

    $stmt-> execute();
    
    $products = $stmt->get_result();

}


?>

    <?php include('layouts/header.php');?>


    <!--Search-->
    <section id="search" class="my-5 py-5 ms-2">
        <div class="container mt-5 py-5">
        </div>

        <form action="shop.php" method="POST">
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">



                    <p>Category</p>
                    <div class="form-check">
                        <input class="form-check-input" value="mirror" type="radio" name="category" id="category_one" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Mirrors
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="light" name="category" id="category_two" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Lights
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="hand" name="category" id="category_two" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Handles
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="break" name="category" id="category_two" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Breaks
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn book-btn">
            </div>

        </form>

    </section>


    <!--Shop-->
    <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our products</h3>
            <hr>
            <p>Here you can check out our products </p>
        </div>
        <div class="row mx-auto container">

        <?php while($row = $products->fetch_assoc()){ ?>

            <!--Product 1-->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image'] ?>"/>
                
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>

                </div>
                <h5 class="p-name">
                    <?php echo $row['product_name']; ?>
                </h5>

                <h4 class="p-price">
                    $<?php echo $row['product_price']; ?>
                </h4>
                
                <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"> 
                    Buy Now
                </a>
                
            </div>
            
        <?php } ?>


        </div>


      </section>
    
      
    <?php include('layouts/footer.php'); ?>