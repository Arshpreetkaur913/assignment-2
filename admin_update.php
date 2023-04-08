<?php
require 'config.php';

// $id = $_GET['edit'];
// $message = '';
$id = isset($_GET['edit']) ? $_GET['edit'] : 0;


if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];

   if(empty($product_name) || empty($product_price)){
      $message = 'Please fill out all fields!';
   } else {

      $product_image = $_FILES['product_image']['name'];
      $product_image_tmp_name = $_FILES['product_image']['tmp_name'];

      if(!empty($product_image)){

         $product_image_folder = 'uploaded_img/'.$product_image;
         $upload = move_uploaded_file($product_image_tmp_name, $product_image_folder);

         if(!$upload){
            $message = 'Failed to upload product image!';
         }
      }

      $update_data = "UPDATE products SET name='$product_name', price='$product_price'";
      
      if(!empty($product_image)){
         $update_data .= ", image='$product_image'";
      }

      $update_data .= " WHERE id = '$id'";

      $update_query = mysqli_query($conn, $update_data);

      if($update_query){
         header('location: admin_page.php');
         exit();
      } else {
         $message = 'Failed to update product!';
      }

   }
};

$select_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");

$row = mysqli_fetch_assoc($select_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Update Product</title>
</head>
<body>

<?php if(!empty($message)): ?>
   <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<div class="container">
   <div class="admin-product-form-container centered">
      <form action="" method="post" enctype="multipart/form-data">
         <h3 class="title">Update Product</h3>
         <input type="text" class="box" name="product_name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" placeholder="Enter the product name">
         <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Enter the product price">
         <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
         <input type="submit" value="Update Product" name="update_product" class="btn">
         <a href="admin_page.php" class="btn">Go back!</a>
      </form>
   </div>
</div>

</body>
</html>
