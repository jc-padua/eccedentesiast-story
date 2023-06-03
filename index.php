<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eccedentesiast Story</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./assets/css/user/normalize.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/user/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/user/vendor.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/user/style.css">
    <!-- script
		================================================== -->
    <script src="./assets/js/user/modernizr.js"></script>
</head>

<body>

    <!-- Start Header -->
    <div id="header-wrap">
        <header id="header">
            <div class="container">
                <div class="row">

                    <div class="col-md-3">
                        <div class="main-logo">
                            <a href="index.html"><img src="./assets/images/user/main-logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-md-13">
                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item active"><a href="./index.php" data-effect="Home">Home</a></li>
                                    <li class="menu-item"><a href="./pages/user/about.php " class="nav-link" data-effect="About">About</a></li>
                                    <li class="menu-item"><a href="./pages/user/books.php" class="nav-link" data-effect="Shop">Books</a></li>
                                    <li class="menu-item"><a href="./pages/user/review.php" class="nav-link" data-effect="Articles">Reviews</a></li>
                                    <li class="menu-item"><a href="./pages/user/contact.php" class="nav-link" data-effect="Contact">Contact</a></li>
                                </ul>
                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

    </div>
    <!-- End Header -->

    <section id="billboard">

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>

                    <div class="main-slider pattern-overlay">
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Franz Mherryon Robles</h2>
                                <p>Welcome to Eccedentesiast Story its a space dedicated to showcasing the unique perspectives, stories, and talents of Franz Mherryon Robles.</p>
                                <div class="btn-wrap">
                                    <a href="./pages/user/about.php" class="btn btn-outline-accent btn-accent-arrow">Read More<i class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="./assets/images/user/Franz.png" alt="banner" class="banner-image">
                        </div><!--slider-item-->

                    </div><!--slider-->

                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>

    </section>

    <section id="client-holder" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="logo-wrap ">
                        <div class="grid">
                            <img src="./assets/images/user/pic1.png" alt="client">
                            <img src="./assets/images/user/pic2.png" alt="client">
                            <img src="./assets/images/user/pic3.png" alt="client">
                            <img src="./assets/images/user/pic4.png" alt="client">
                        </div>
                    </div><!--image-holder-->
                </div>
            </div>
        </div>
    </section>

    <section id="featured-books">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Featured Books</h2>
                    </div>

                    <div class="product-list" data-aos="fade-up">
                        <div class="row">

                            <!-- Get Books from Database -->
                            <?php
                            include('./includes/admin/config.php');
                            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
                            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                            ?>
                                <div class="col-md-3">
                                    <figure class="product-style">
                                        <!-- <img src="./assets/images/admin/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Books" class="product-item"> -->
                                        <a href="./pages/user/single-book.php?book=<?php echo $fetch_products['id'] ?>">
                                            <img src="./assets/images/admin/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Books" class="product-item">
                                        </a>
                                        <!-- TODO: Link Single-Book  -->
                                        <!-- FIXME: Get BookID  -->
                                        <a href="./pages/user/single-book.php?book=<?php echo $fetch_products['id'] ?>" style="padding: .3rem 1rem; text-decoration: none; border-radius: 15px;" class="add-to-cart btn" data-product-tile="add-to-cart">View Book</a>
                                        <figcaption>
                                            <h3><?php echo $fetch_products['name']; ?></h3>
                                            <p><?php echo $fetch_products['category']; ?></p>
                                            <div class="item-price">₱<?php echo $fetch_products['price']; ?></div>
                                        </figcaption>
                                    </figure>
                                </div>

                            <?php
                            }
                            ?>
                            <!--  End Get Books From DB -->

                        </div><!--ft-books-slider-->
                    </div><!--grid-->
                </div><!--inner-content-->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="btn-wrap align-right">
                        <a href="./pages/user/books.php" class="btn-accent-arrow">View all Books <i class="icon icon-ns-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="best-selling" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-9 col-md-offset-2">

                    <div class="row">

                        <div class="col-md-6">
                            <figure class="products-thumb">
                                <!-- TODO: Get the data from the database -->
                                <img src="./assets/images/admin/uploaded_img/product-item2.png" alt="book" class="single-image">
                            </figure>
                        </div>

                        <div class="col-md-6">
                            <div class="product-entry">
                                <h2 class="section-title divider">Best Selling Book</h2>
                                <div class="products-content">
                                    <div class="author-name">By Franz Mherryon Robles</div>
                                    <h3 class="item-title">Me and the Universe</h3>
                                    <p>Some pieces will entertain you and some will let you have time to reflect. Pieces
                                        are literally inspired by universe in general.</p>
                                    <div class="item-price">₱ 455.00</div>
                                    <div class="btn-wrap">
                                        <a href="./pages/user/books.php" class="btn-accent-arrow">See More <i class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / row -->

                </div>

            </div>
        </div>
    </section>



    <section id="quotation" class="align-center">
        <!-- TODO: Make this dynamic. Everyday change the Qoute if possible  -->
        <div class="inner-content">
            <h2 class="section-title divider">Quote of the day</h2>
            <blockquote data-aos="fade-up">
                <q>“The things we once thought are falling into pieces will eventually fall into places.”</q>
                <div class="author-name">Franz Mherryon Robles</div>
            </blockquote>
        </div>
    </section>





    <footer id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4">

                    <div class="footer-item">
                        <div class="company-brand">
                            <img src="./assets/images/user/main-logo.png" alt="logo" class="footer-logo">
                            <p>A dimension for deepest emotions and self fulfillment.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>Discover</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="menu-item">
                                <a href="./pages/user/books.php">Books</a>
                            </li>
                            <li class="menu-item">
                                <a href="./pages/user/review.php">Reviews</a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>Help</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="./pages/user/contact.php">Contact us</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <!-- / row -->

        </div>
    </footer>

    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="copyright">
                        <div class="row">

                            <div class="col-md-6">
                                <p>© 2023 All rights reserved.</p>
                            </div>

                            <div class="col-md-6">
                                <div class="social-links align-right">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon icon-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-youtube-play"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon icon-behance-square"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div><!--grid-->

                </div><!--footer-bottom-content-->
            </div>
        </div>
    </div>

    <script src="./assets/js/user/jquery-1.11.0.min.js"></script>
    <script src="./assets/js/user/plugins.js"></script>
    <script src="./assets/js/user/script.js"></script>

</body>

</html>