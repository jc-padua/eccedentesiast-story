<?php
$active = 'contact';

include '../../includes/admin/config.php';

if (isset($_POST['send'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$number = $_POST['number'];
	$msg = mysqli_real_escape_string($conn, $_POST['message']);

	$select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

	if (mysqli_num_rows($select_message) > 0) {
		$message[] = 'message sent already!';
	} else {
		mysqli_query($conn, "INSERT INTO `message`(name, email, number, message) VALUES('$name', '$email', '$number', '$msg')") or die('query failed');
		$message[] = 'message sent successfully!';
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Contact | Eccedentesiast Story</title>
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

	<?php
	include('../../includes/user/header.php');
	?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title">Contact us</h1>
					<div class="breadcrumbs">
						<span class="item"><a href="../../index.php">Home /</a></span>
						<span class="item">Contact us</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-information padding-large mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-0 mb-3">

					<h2>Get in Touch</h2>

					<div class="contact-detail d-flex flex-wrap mt-4">
						<div class="detail mr-6 mb-4">
							<p>Have a question, feedback, or simply want to connect? We would love to hear from you! At
								Eccedentesiast Story, we value our readers and community. Your thoughts and
								contributions are important to us.
							<p>Whether you want to share your own stories, inquire about [Author's Name]'s books, or
								discuss the power of words, we're here to listen and engage. Drop us a message, and
								we'll get back to you as soon as possible.
							<p>Join us in the vibrant world of storytelling and let your voice be heard. Reach out today
								and become a part of the Eccedentesiast Story community.</p>
							<ul class="list-unstyled list-icon">
								<li><i class="icon icon-phone"></i>+1650-243-0000</li>
								<li><i class="icon icon-envelope-o"></i><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></li>
								<li><i class="icon icon-location2"></i>Pagsanjan, Laguna</li>
							</ul>
						</div><!--detail-->
						<div class="detail mb-4">
							<h3>Social Links</h3>
							<div class="social-links flex-container">
								<a href="#" class="icon icon-facebook"></a>
								<a href="#" class="icon icon-twitter"></a>
								<a href="#" class="icon icon-pinterest-p"></a>
								<a href="#" class="icon icon-youtube"></a>
								<a href="#" class="icon icon-linkedin"></a>
							</div><!--social-links-->
						</div><!--detail-->

					</div><!--contact-detail-->
				</div><!--col-md-6-->

				<div class="col-md-6 p-0">

					<div class="contact-information">
						<h2>Send A Message</h2>
						<form name="contactform" action="" method="post" class="contact-form d-flex flex-wrap mt-4">
							<div class="row">
								<div class="col-md-6">
									<input type="text" minlength="2" name="name" placeholder="Name" class="u-full-width" required>
								</div>
								<div class="col-md-6">
									<input type="email" name="email" placeholder="E-mail" class="u-full-width" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<input type="number" name="number" required placeholder="Number" class="box u-full-width">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<textarea class="u-full-width" name="message" placeholder="Message" style="height: 150px;" required></textarea>
									<label>
										<input type="checkbox" required>
										<span class="label-body">I agree all the <a href="#">terms and conditions</a></span>
									</label>
									<input type="submit" value="Send Message" name="send" class="btn btn-full btn-rounded">
								</div>
							</div>
						</form>
					</div><!--contact-information-->
				</div><!--col-md-6-->

			</div>
		</div>
	</section>
	<!-- 
	<section class="google-map">
		<div class="mapouter">
			<div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://getasearch.com/fmovies"></a><br>
				<style>
					.mapouter {
						position: relative;
						text-align: right;
						height: 500px;
						width: 100%;
					}
				</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
				<style>
					.gmap_canvas {
						overflow: hidden;
						background: none !important;
						height: 500px;
						width: 100%;
					}
				</style>
			</div>
		</div>
	</section> -->

	<?php
	include('../../includes/user/footer.php');
	?>

	<script src="../../assets/js/user/jquery-1.11.0.min.js"></script>
	<script src="../../assets/js/user/plugins.js"></script>
	<script src="../../assets/js/user/script.js"></script>

</body>

</html>