    <?php include('layouts/header.php');?>
    

    <!--Home-->
    <section id="home">
        <div class="container">
            <h5>
                NEW ARRIVALS
            </h5>
            <h1>
                <span>
                    Best Prices
                </span>
                this season
            </h1>
            <p>
                Eshop offer the best product for the most affordable prices
            </p>
            <button>
                Shop now
            </button>

        </div>
      </section>


    <!--Brand-->
    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png"/>
        </div>
      </section>


    <!--New-->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">

            <!--One-->
            <div class="one col-lg-4 col-md-12 col-sm-12">
                <img class="img-fluid" src="assets/imgs/1.png"/>
                <div class="details">
                    <h2>
                        Description
                    </h2>
                    <button class="text-uppercase">
                        Shop now
                    </button>
                </div>
            </div>
            <!--Two-->
            <div class="one col-lg-4 col-md-12 col-sm-12">
                <img class="img-fluid" src="assets/imgs/2.png"/>
                <div class="details">
                    <h2>
                        Description
                    </h2>
                    <button class="text-uppercase">
                        Shop now
                    </button>
                </div>
            </div>
            <!--Three-->
            <div class="one col-lg-4 col-md-12 col-sm-12">
                <img class="img-fluid" src="assets/imgs/3.png"/>
                <div class="details">
                    <h2>
                        Description
                    </h2>
                    <button class="text-uppercase">
                        Shop now
                    </button>
                </div>
            </div>

        </div>
      </section>


    <!--Featured-->
    <section id="featured" class="my-5 pd-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr>
            <p>Here you can check out our featured </p>
        </div>
        <div class="row mx-auto container-fluid">

            <!--Product 1-->
            <?php include 'server/get_featured_products.php' ;?>

            <?php while($row = $featured_products->fetch_assoc()){ ?>

                
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>"/>
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
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">
                        Buy now
                    </button></a>
                </div>

            <?php } ?>
                
            </div>
      </section>
      
    <!--Banner-->
    <section id="banner" class="my-5 pd-5">
        <div class="container">
            <h4>
                MID SEASON'S SALE
            </h4>
            <h1>
                Autumn Collection
                <br>
                Up to 30% OFF
            </h1>
            <button class="text-uppercase">
                Shop now
            </button>
        </div>
      </section>

    <!--Clothes-->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Motorbike</h3>
            <hr>
            <p>Here you can check out our brand new motorbike</p>
        </div>
        <div class="row mx-auto container-fluid">


        <!--Product 1-->
        <?php include 'server/get_motorbikes.php' ;?>

        <?php while($row = $motorbikes_products->fetch_assoc()){ ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/Products/<?php echo $row['product_category']; ?>/<?php echo $row['product_image']; ?>"/>
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
                <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">
                        Buy now
                    </button></a>
            </div>

        <?php } ?>
            
        </div>
      </section>

    <?php include('layouts/footer.php'); ?>

    