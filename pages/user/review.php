<?php
$active = 'review';
include('../../includes/admin/config.php');

if (isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$msg = mysqli_real_escape_string($conn, $_POST['message']);
	$date = date('d-M-Y');

	// $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

	// if (mysqli_num_rows($select_message) > 0) {
	// 	$message[] = 'message sent already!';
	// } else {
	mysqli_query($conn, "INSERT INTO `review`(name, email, message, date) VALUES('$name', '$email', '$msg', '$date')") or die('query failed');
	// }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Review | Eccedentesiast Story</title>
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
	<!-- <script src="../../assets/lib/paginationjs/dist/pagination"></script> -->
	<!-- script================================================== -->
	<script src="../../assets/js/user/modernizr.js"></script>
</head>

<body>

	<!-- Start Header-->
	<?php
	include('../../includes/user/header.php');
	?>
	<!-- End Header -->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title">Reviews</h1>
					<div class="breadcrumbs">
						<span class="item"><a href="../../index.php">Home /</a></span>
						<span class="item">Reviews</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="padding-large">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<section class="comments-wrap mb-4">
						<div id="data-container">
							<div class="comment-list mt-4">
								<?php
								$select_review = mysqli_query($conn, "SELECT * FROM `review`") or die('query failed');
								if (mysqli_num_rows($select_review) > 0) {
									while ($fetch_review = mysqli_fetch_assoc($select_review)) {
								?>
										<article class="flex-container d-flex mb-3">
											<div class="author-post">
												<div class="comment-meta d-flex">
													<h4><?php echo $fetch_review['name']; ?></h4>
													<span class="meta-date"><?php echo $fetch_review['date']; ?></span>
													<!-- <small class="comments-reply"><a href="#"><i class="icon icon-mail-reply"></i>Reply</a></small> -->
												</div><!--meta-tags-->
												<p><?php echo $fetch_review['message']; ?></p>
											</div>
										</article>
								<?php
									}
								} else {
									echo '<h4 class="empty">No review yet</h4>';
								}
								?>
							</div>
						</div>
						<div id="pagination-container"></div>
					</section>

					<section class="comment-respond  mb-5">
						<h3>Leave a Comment</h3>
						<form method="POST" class="form-group mt-3">

							<div class="row">
								<div class="col-md-6">
									<input class="u-full-width" type="text" name="name" id="author" class="form-control mb-4 mr-4" placeholder="Your full name">
								</div>
								<div class="col-md-6">
									<input class="u-full-width" type="email" name="email" id="email" class="form-control mb-4" placeholder="E-mail Address">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<textarea class="u-full-width" id="message" class="form-control mb-4" name="message" placeholder="Write your comment here" rows="20"></textarea>
								</div>
								<div class="col-md-12">
									<input class="btn btn-rounded btn-large btn-full" type="submit" name="submit" value="Submit">
								</div>
							</div>

						</form>
					</section>

				</div>
			</div>

		</div>
	</section>

	<?php
	include('../../includes/user/footer.php');
	?>

	<script src="../../assets/js/user/jquery-1.11.0.min.js"></script>
	<script src="../../assets/js/user/plugins.js"></script>
	<script src="../../assets/js/user/script.js"></script>
	<script src="../../assets/lib/paginationjs/dist/pagination.js"></script>


</body>

</html>