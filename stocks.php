<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Music Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .content {
            margin-left: 260px;
            padding: 20px;
        }
       
    </style>
</head>
<body>
<?php
 include'sidebar.php';
 ?>
    <div class="content">
        <h2>Manage Stocks</h2>
        <form class="mt-4" id="stocks" method="post">
            <div class="mb-3">
                <label for="productid" class="form-label">Product ID</label>
                <input type="text" class="form-control"name="productid" id="productid" placeholder="Enter product ID" required>
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter product name" required>
            </div>
            <div class="mb-3">
                <label for="stockQuantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" name="stockQuantity" id="stockQuantity" placeholder="Enter stock quantity" required>
            </div>
            <div class="mb-3">
                <label for="stockStatus" class="form-label">Stock Status</label>
                <select class="form-select" name="stockStatus" id="stockStatus" required>
                    <option value="Available">Available</option>
                    <option value="Out of Stock">Out of Stock</option>
                    <option value="Limited Stock">Limited Stock</option>
                </select>
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
            $stockquantity=$_POST["stockQuantity"];
            $stockstatus=$_POST["stockStatus"];
           

            $sql="insert into stocks(product_id,product_name,stock_quantity,stock_status ) values('$productid','$name','$stockquantity','$stockstatus')";
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