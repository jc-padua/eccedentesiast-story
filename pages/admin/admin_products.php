<?php

include '../../includes/admin/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['add_product'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $category = $_POST['category'];
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../../assets/images/admin/uploaded_img/' . $image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already added';
   } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, category, price, description, image) VALUES('$name', '$category', '$price', '$description', '$image')") or die('query failed');

      if ($add_product_query) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      } else {
         $message[] = 'product could not be added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('../../assets/images/admin/uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` 
   SET name = '$update_name', price = '$update_price' 
   WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = '../../assets/images/admin/uploaded_img/' . $update_image;
   $update_old_image = $_POST['update_old_image'];

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image file size is too large';
      } else {
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('../../assets/images/admin/uploaded_img/' . $update_old_image);
      }
   }

   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="../../assets/css/admin/admin_style.css">
   <link rel="stylesheet" href="../../assets/lib/hystmodal/dist/hystmodal.min.css">

</head>

<body>

   <?php include '../../includes/admin/admin_header.php'; ?>
   <!-- product CRUD section starts  -->
   <div class="hystmodal" id="myModal" aria-hidden="true" style="margin-top: 4rem;">
      <div class="hystmodal__wrap">
         <div class="hystmodal__window" role="dialog" aria-modal="true">
            <button data-hystclose class="hystmodal__close">Закрыть</button>
            <section class="add-products">
               <!-- <h1 class="title">shop products</h1> -->
               <form action="" method="post" enctype="multipart/form-data">
                  <h3>add product</h3>
                  <input type="text" name="name" class="box" placeholder="Enter product name" required>
                  <input type="text" name="category" class="box" placeholder="Enter product category" required>
                  <input type="number" min="0" name="price" class="box" placeholder="Enter product price" required>
                  <textarea name="description" id="description" cols="30" rows="10" class="product-description" required></textarea>
                  <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                  <input type="submit" value="add product" name="add_product" class="btn">
               </form>

            </section>
         </div>
      </div>
   </div>

   <!-- product CRUD section ends -->

   <!-- show products  -->

   <section class="show-products" style="margin-top: 2rem;">
      <h1 class="title">Products</h1>
      <div class="box-container">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <img src="../../assets/images/admin/uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <p style="font-size: 1.4rem; color: #74642f;">
                     <?php echo $fetch_products['category']; ?>
                  </p>
                  <div class="price">₱<?php echo $fetch_products['price']; ?>/-</div>
                  <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                  <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

   </section>

   <section class="edit-product-form">
      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                  <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                  <div class="form-wrapper" style="display: flex; align-items: center; justify-content: center;">
                     <div class="">
                        <img src="../../assets/images/admin/uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                     </div>
                     <div class="">
                        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter product name">
                        <input type="text" name="update_category" value="<?php echo $fetch_update['category']; ?>" class="box" required placeholder="Enter product category">
                        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter product price">
                        <textarea name="description" id="description" cols="30" rows="10" class="product-description" required><?php echo $fetch_update['description'] ?></textarea>
                        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                     </div>
                  </div>
                  <input type="submit" value="update" name="update_product" class="btn">
                  <input type="reset" value="cancel" id="close-update" class="option-btn">
               </form>
      <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>

   </section>

   <a href="#" data-hystmodal="#myModal">
      <div class="addProduct" style="position: fixed;
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
         <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-cart-plus" viewBox="0 0 16 16">
            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
         </svg>
      </div>
   </a>

   <script src="../../assets/lib/hystmodal/dist/hystmodal.min.js"></script>
   <script>
      const myModal = new HystModal({
         linkAttributeName: "data-hystmodal",
         //settings (optional). see API
      });
      document.querySelector('.addProduct').addEventListener('click', () => {
         MicroModal.init();
      })
   </script>
   <!-- custom admin js file link  -->
   <script src="../../assets/js/admin/admin_script.js"></script>

</body>

</html>