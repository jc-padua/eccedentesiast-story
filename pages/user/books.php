<?php

$active = 'books';

include('../../includes/admin/config.php');

if (isset($_GET['add-to-cart'])) {

	$name = mysqli_real_escape_string($conn, $_GET['name']);
	$price = $_GET['price'];
	$image = $_GET['image'];
	$quantity = $_GET['quantity'];

	// Check if the product is already in the cart
	$check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name'") or die('query failed');

	// If the product is already in the cart, update the quantity
	if (mysqli_num_rows($check_cart_numbers) > 0) {
		$row = mysqli_fetch_assoc($check_cart_numbers);
		$new_quantity = $row['quantity'] + $quantity;

		mysqli_query($conn, "UPDATE `cart` SET quantity = '$new_quantity' WHERE name = '$name'") or die('query failed');
	} else {
		// If the product is not in the cart, insert it
		mysqli_query($conn, "INSERT INTO `cart`(name, price, quantity, image) VALUES('$name', '$price', '$quantity', '$image')") or die('query failed');
	}

	header('location:checkout.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Book | Eccedentesiast Story</title>
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
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

</head>

<body>

	<!-- Start Header-->
	<?php
	include('../../includes/user/header.php');
	?>
	<!-- End Header -->

	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="colored">
						<h1 class="page-title">Books</h1>
						<div class="breadcum-items">
							<span class="item"><a href="../../index.php">Home /</a></span>
							<span class="item colored">Books</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="padding-large">
		<div class="container">
			<div class="row">

				<div class="products-grid">

					<?php
					include('../../includes/admin/config.php');
					$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
					while ($fetch_products = mysqli_fetch_assoc($select_products)) {
					?>
						<figure class="product-style">
							<form id="form" action="" method="GET">
								<!-- FIXME: Click Image not working -->
								<a href="../../pages/user/single-book.php?book=<?php echo $fetch_products['id'] ?>">
									<img src="../../assets/images/admin/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Books" class="product-item">
								</a>
								<figcaption>
									<h3><?php echo $fetch_products['name']; ?></h3>
									<p><?php echo $fetch_products['category']; ?></p>
									<div class="item-price">₱<?php echo $fetch_products['price']; ?></div>
									<input type="hidden" name="id" value="<?php echo $fetch_products['id'] ?>">
									<input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
									<input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">
									<input type="hidden" name="image" value="<?php echo $fetch_products['image']; ?>">
									<input type="number" min="1" name="quantity" value="1" class="qty" style="margin: 0 .5rem;">
									<!-- <a href="./checkout.php">Avail Now</a> -->
									<br>
									<input type="submit" value="Avail Now" name="add-to-cart" class="btn">
								</figcaption>
							</form>
						</figure>
					<?php
					}
					?>

					<!-- TODO:  -->



				</div>

			</div>
		</div>
	</section>




	<a href="./checkout.php">
		<div class="checkout-btn" style="position: fixed;
			bottom: 20px;
			right: 20px;
			width: 70px; 
			height: 70px;
		border-radius: 100%;
		z-index: 1000;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
			background-color: #7284a8;">
			<svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
				<path d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z" fill="white"></path>
			</svg>
		</div>
	</a>

	<?php include('../../includes/user/footer.php'); ?>


	<script src="../../assets/js/user/jquery-1.11.0.min.js"></script>
	<script src="../../assets/js/user/plugins.js"></script>
	<script src="../../assets/js/user/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>