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

    <?php include('layouts/header.php');?>
    
    <!--Single Product-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

       <?php while($row = $products->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>" id="mainImg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image1']; ?>" width="100%" height="150px" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image2']; ?>" width="100%" height="150px" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image3']; ?>" width="100%" height="150px" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image4']; ?>" width="100%" height="150px" class="small-img"/>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
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
                    Product details: 
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

        <script>
            var mainImg = document.getElementById("mainImg")
            var smallImg = document.getElementsByClassName("small-img");

            for(let i=0; i<4; i++){
                smallImg[i].onclick = function(){
                mainImg.src=smallImg[i].src;
                }
            }
        </script>


    <?php include('layouts/footer.php'); ?>