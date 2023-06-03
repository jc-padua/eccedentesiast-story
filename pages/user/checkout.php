<?php

include('../../includes/admin/config.php');


if (isset($_POST['order_btn'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, $_POST['street'] . ', ' . 'Barangay ' .  $_POST['brgy'] . ', ' . $_POST['city'] . ', ' . $_POST['state']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = mysqli_real_escape_string($conn, $cart_item['name']) . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
      echo "
      <script>alert('Cart is Empty');</script>";
   } else {
      if (mysqli_num_rows($order_query) > 0) {
         $message[] = 'order already placed!';
      } else {
         mysqli_query($conn, "INSERT INTO `orders`(name, number, email, method, address, total_products, total_price, placed_on) VALUES( '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart`") or die('query failed');
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:checkout.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Checkout | Eccedentesiast Story</title>
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
   <!-- EmailJS -->
   <script src="../../assets/js/user/userNotif.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
   </script>
   <script type="text/javascript">
      (function() {
         emailjs.init("D3BeG9S63k40E_WB8");
      })();
   </script>
</head>

<body>

   <?php
   include('../../includes/user/header.php');
   ?>

   <div class="heading" style="padding: 0 2rem;">
      <h1>checkout</h1>
      <p> <a href="../../index.php">Home</a> / Checkout </p>
   </div>

   <div class="section-wrapper">
      <section class="display-order" style="padding: 2rem;">
         <div class="display-wrapper">
            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
               while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                  $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total += $total_price;
            ?>
                  <div class="order-card">
                     <img src="../../assets/images/admin/uploaded_img/<?php echo $fetch_cart['image'] ?>" alt="" style="width: 5rem;">
                     <p><?php echo $fetch_cart['name']; ?></p>
                     <p><?php echo '₱' . $fetch_cart['price'] . ' - ' . ' x' . $fetch_cart['quantity']; ?></p>
                     <a href="checkout.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('delete this from cart?');">Delete</a>
                  </div>
            <?php
               }
            } else {
               echo '<h4 class="empty">Your cart is empty</h4>';
            }
            ?>
            <div class="order-card">
               <a href="./books.php">Add More</a>
            </div>
         </div>
         <div class="grand-total">
            <h1> Grand Total : ₱<?php echo $grand_total; ?> </h1>
         </div>

      </section>

      <section class="checkout" style="padding: 2rem;">
         <form action="" class="form" target="frame" method="post">
            <h3>Place your order</h3>
            <div class="flex-container">
               <div class="col-1">
                  <div class="inputBox">
                     <span>Your name :</span>
                     <input type="text" name="name" id="name" required placeholder="Enter your name">
                  </div>
                  <div class="inputBox">
                     <span>Your number :</span>
                     <input type="number" name="number" id="number" required placeholder="Enter your number">
                  </div>
                  <div class="inputBox">
                     <span>Your email :</span>
                     <input type="email" name="email" id="email" required placeholder="Enter your email">
                  </div>
                  <div class="inputBox">
                     <span>Payment method :</span>
                     <select name="method">
                        <option value="gcash">GCASH</option>
                        <option value="paymaya">Paymaya</option>
                     </select>
                  </div>
               </div>
               <div class="col-2">
                  <div class="inputBox">
                     <span>Street Address :</span>
                     <input type="text" name="street" id="street" required placeholder="e.g. street name">
                  </div>
                  <div class="inputBox">
                     <span>Barangay :</span>
                     <input type="text" name="brgy" id="brgy" required placeholder="e.g. Bagumbayan">
                  </div>
                  <div class="inputBox">
                     <span>City :</span>
                     <input type="text" name="city" id="city" required placeholder="e.g. Sta. Cruz">
                  </div>
                  <div class="inputBox">
                     <span>State :</span>
                     <input type="text" name="state" id="state" required placeholder="e.g. Laguna">
                  </div>
               </div>
            </div>
            <input type="submit" value="order now" class="btn order" onsubmit="sendMail();" name="order_btn">
         </form>
      </section>
   </div>
   <iframe name="frame" style="display: none;"></iframe>


   <?php include('../../includes/user/footer.php'); ?>


   <!-- JS file link  -->
   <script>
      function sendMail() {
         let params = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
         };

         const serviceID = "service_ux63io4";
         const templateID = "template_t4vw3ql";

         emailjs
            .send(serviceID, templateID, params)
            .then((res) => {
               document.getElementById('name').value = "";
               document.getElementById('email').value = "";
               document.getElementById('street').value = "";
               document.getElementById('brgy').value = "";
               document.getElementById('city').value = "";
               document.getElementById('state').value = "";
               document.getElementById('number').value = "";
            })
            .catch((err) => console.log(err))
      }

      document.querySelector('.order').addEventListener('click', () => {
         sendMail();
         setTimeout(() => {
            document.querySelector('.form').submit()
            window.location = window.location;
         }, 2500)
      })
   </script>
   <script src="../../assets/js/user/jquery-1.11.0.min.js"></script>
   <script src="../../assets/js/user/plugins.js"></script>
   <script src="../../assets/js/user/script.js"></script>

</body>

</html>