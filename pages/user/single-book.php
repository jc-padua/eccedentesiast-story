<?php
$active = 'books';

include('../../includes/admin/config.php');

if (isset($_GET['add-to-cart'])) {

    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $price = $_GET['price'];
    $image = $_GET['image'];
    // $quantity = $_GET['quantity'];
    $quantity = 1;

    // $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name'") or die('query failed');
    // Notify the customer that the Product is added to cart!
    mysqli_query($conn, "INSERT INTO `cart`(name, price, quantity, image) VALUES('$name', '$price', '$quantity', '$image')") or die('query failed');
    header('location:checkout.php');
    // $message[] = 'product added to cart!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Books | Eccedentesiast Story</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="../../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../assets/css/user/normalize.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/user/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/user/vendor.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/user/style.css">
    <!-- script================================================== -->
    <script src="../../assets/js/user/modernizr.js"></script>
</head>

<body>

    <!-- Start Header-->
    <?php
    include('../../includes/user/header.php');
    ?>
    <!-- End Header -->

    <section class="bg-sand padding-large">
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET['book'])) {
                    $book_id = $_GET['book'];
                    $book_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$book_id' ") or die('query failed');
                    if (mysqli_num_rows($book_query) > 0) {
                        while ($fetch_book = mysqli_fetch_assoc($book_query)) {
                ?>
                            <div class="col-md-6">
                                <a href="#" class="product-image"><img src="../../assets/images/admin/uploaded_img/<?php echo $fetch_book['image']; ?>"></a>
                            </div>

                            <div class="col-md-6 pl-5">
                                <div class="product-detail">
                                    <h1><?php echo $fetch_book['name'] ?></h1>
                                    <p style="transform: translateY(-20px);"><?php echo $fetch_book['category'] ?></p>
                                    <p style="font-size: 1.5rem; font-weight: 700;">₱<?php echo $fetch_book['price'] ?></p>
                                    <p style="text-align: justify;"><?php echo $fetch_book['description'] ?></p>
                                    <form action="" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $fetch_book['id'] ?>">
                                        <input type="hidden" name="name" value="<?php echo $fetch_book['name']; ?>">
                                        <input type="hidden" name="price" value="<?php echo $fetch_book['price']; ?>">
                                        <input type="hidden" name="image" value="<?php echo $fetch_book['image']; ?>">
                                        <input type="submit" value="Avail Now" name="add-to-cart" class="btn">
                                    </form>

                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </section>


    <?php
    include('../../includes/user/footer.php');
    ?>

    <script src="../../assets/js/user/jquery-1.11.0.min.js"></script>
    <script src="../../assets/js/user/plugins.js"></script>
    <script src="../../assets/js/user/script.js"></script>

</body>

</html>