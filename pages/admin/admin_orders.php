<?php

include '../../includes/admin/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../../assets/css/admin/admin_style.css">
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
   </script>
   <script type="text/javascript">
      (function() {
         emailjs.init("D3BeG9S63k40E_WB8");
      })();
   </script>
</head>

<body>

   <?php include '../../includes/admin/admin_header.php'; ?>

   <section class="orders">
      <h1 class="title">placed orders</h1>
      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
         ?>
               <div class="box">
                  <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> Total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                  <p> Total price : <span>₱<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                  <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                  <form action="" target="frame" class="form" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <input type="hidden" name="email" id="email" value="<?php echo $fetch_orders['email']; ?>">
                     <select name="update_payment" class="payment">
                        <!-- <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option> -->
                        <option value="pending" <?php echo $fetch_orders['payment_status'] == "pending" ? "selected" : "" ?>>pending</option>
                        <option value="completed" <?php echo $fetch_orders['payment_status'] == "completed" ? "selected" : "" ?>>completed</option>
                     </select>
                     <input type="submit" value="update" name="update_order" class="order option-btn">
                     <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
                  </form>
                  <iframe name="frame" style="display: none;"></iframe>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>
   <!-- EmailJS -->
   <script>
      // FIXME: Email Fix Last


      function sendMail(email) {

         let params = {
            email: email
         };

         const serviceID = "service_ux63io4";
         const templateID = "template_o3tqliz";

         emailjs.send(serviceID, templateID, params).then((res) => {
               document.getElementById('email').value = "";
            })
            .catch((err) => console.log(err))
      }

      const forms = document.querySelectorAll('.form');

      forms.forEach(form => {
         form[3].addEventListener('click', () => {
            let email = form[1].value;
            if (form[2].value === 'completed') {
               sendMail(email);
            }
         })
      })
   </script>
   <!-- custom admin js file link  -->
   <script src="../../assets/js/admin/admin_script.js"></script>

</body>

</html>