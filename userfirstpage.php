<?php
session_start();

/*  AUTH CHECK */
if(!isset($_SESSION['id']) || $_SESSION['role'] != "user"){
    header("Location: landingpage.php");
    exit();
}

$mid = $_SESSION['id'];

$servername="localhost";
$user="root";
$password="";
$db="musical_instrument";

$con=mysqli_connect($servername,$user,$password,$db);

if(!$con){
    die("Connection failed");
}

/*  ADD TO CART */
if(isset($_POST['addcart'])){

    $pid   = $_POST['pid'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $image = $_POST['image'];

   

    $check = mysqli_query($con,"SELECT * FROM cart WHERE product_id='$pid' AND user_id='$mid'");

    if(mysqli_num_rows($check) > 0){
        mysqli_query($con,"UPDATE cart 
                           SET quantity = quantity + 1 
                           WHERE product_id='$pid' AND user_id='$mid'");
    } else {
        $insert=mysqli_query($con,"INSERT INTO cart(product_id,product_name,price,image,quantity,user_id)
                           VALUES('$pid','$pname','$price','$image',1,'$mid')");

        if(!$insert){
            die("ERROR: ".mysqli_error($con)); 
        }
    }

    echo "<script>alert('Added to cart');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>

<style>
:root {
    --primary: #2a6099;
    --secondary: #f8f9fa;
}

body {
    margin:0;
    font-family:'Segoe UI';
    background:var(--secondary);
}

header {
    background:var(--primary);
    color:white;
    padding:15px;
}

.header-container {
    max-width:1200px;
    margin:auto;
    display:flex;
    justify-content:space-between;
}

.nav-links {
    list-style:none;
    display:flex;
    gap:20px;
}

.nav-links a {
    color:white;
    text-decoration:none;
}

.products-section {
    max-width:1200px;
    margin:30px auto;
}

.products-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    gap:20px;
}

.product-card {
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.product-image {
    width:100%;
    height:200px;
    object-fit:cover;
}

.product-info {
    padding:15px;
}

.product-price {
    color:green;
    font-weight:bold;
}

.add-to-cart {
    background:var(--primary);
    color:white;
    border:none;
    padding:8px;
    margin-top:10px;
    width:100%;
}

.logout-btn {
    background:red;
    color:white;
    padding:5px 10px;
}
</style>
</head>

<body>

<header>
<div class="header-container">
    <h2>MusicMasters</h2>

    <ul class="nav-links">
        <li>Welcome, <?php echo $_SESSION['name']; ?></li>
        <li><a href="cart.php">🛒 Cart</a></li>
        <li><a href="landingpage.php" class="logout-btn">Logout</a></li>
    </ul>
</div>
</header>

<section class="products-section">

<h2>Available Instruments</h2>

<div class="products-grid">

<?php

$sql = mysqli_query($con,"SELECT * FROM add_product");

while($row = mysqli_fetch_row($sql)){
?>

<div class="product-card">


<img src="media/<?php echo $row[6]; ?>" class="product-image">

<div class="product-info">

<p><?php echo $row[3]; ?></p>
<h3><?php echo $row[2]; ?></h3>
<div class="product-price">₹<?php echo $row[4]; ?></div>

<form method="POST">

<input type="hidden" name="pid" value="<?php echo $row[0]; ?>">
<input type="hidden" name="pname" value="<?php echo $row[2]; ?>">
<input type="hidden" name="price" value="<?php echo $row[4]; ?>">
<input type="hidden" name="image" value="<?php echo $row[6]; ?>">

<button type="submit" name="addcart" class="add-to-cart">
Add to Cart
</button>

</form>

</div>
</div>

<?php } ?>

</div>
</section>

</body>
</html>