<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <style>
    .content {
      margin-left: 260px;
      padding: 20px;
    }
  .content {
    margin-left:20 ;
    padding: 20px;
    transition: margin-top 0.3s ease;
  }

  .content.shifted {
    margin-top: 20px; 
  }
  </style>
</head>
<body>
<?php
 include'sidebar.php';
 ?>
    
    <div class="content">
        <h2>Add New Product</h2>
        <form class="mt-4" id="product" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productid" class="form-label">Product Id</label>
                <input type="text" class="form-control" name="productid" id="productid" placeholder="Enter product Id" required>
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter product name" required>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Category</label>
                <select class="form-select" name="productCategory" id="productCategory" required>
                    <option value="">Select a category</option>
                    <option value="String">String Instruments</option>
                    <option value="Percussion">Percussion Instruments</option>
                    <option value="Woodwind">Woodwind Instruments</option>
                    <option value="Brass">Brass Instruments</option>
                    <option value="Keyboard">Keyboard Instruments</option>
                    <option value="Electronic">Electronic Instruments</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" name="productPrice" id="productPrice" placeholder="Enter price" required>
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control" name="productDescription" id="productDescription" rows="3" placeholder="Enter product description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control" id="productImage" >
            </div>
            <input type="submit" name="sub" class="btn btn-primary"></input>
        </form>
    </div>

    <?php
        $servername="localhost";
        $user="root";
        $password="";
        $db="musical_instrument";

        $con=mysqli_connect($servername,$user,$password,$db);
        if($con){
        if(isset($_POST["sub"])){
            $productid=$_POST["productid"];
            $name=$_POST["productName"];
            $category=$_POST["productCategory"];
            $price=$_POST["productPrice"];
            $description=$_POST["productDescription"];

            $image=$_FILES["image"]["name"];
            $tmp_image=$_FILES["image"]["tmp_name"];
            $ip="./media/".$image;
            move_uploaded_file($tmp_image,$ip);
            

            $sql="insert into add_product(product_id,product_name,category,price,description,image) values('$productid','$name','$category','$price','$description','$image')";
            $sql=mysqli_query($con,$sql);
            print("
            <script>
            alert('info added succesfully')
            </script>");

        }
    }
    ?>
</body>
</html>