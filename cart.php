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

/* REMOVE ITEM */
if(isset($_GET['remove'])){
    $id=$_GET['remove'];
    mysqli_query($con,"DELETE FROM cart WHERE id='$id' AND user_id='$mid'");
    header("Location: cart.php");
    exit();
}

/* INCREASE QUANTITY */
if(isset($_GET['inc'])){
    $id=$_GET['inc'];
    mysqli_query($con,"UPDATE cart SET quantity = quantity + 1 WHERE id='$id' AND user_id='$mid'");
    header("Location: cart.php");
    exit();
}


if(isset($_GET['dec'])){
    $id=$_GET['dec'];
    mysqli_query($con,"UPDATE cart SET quantity = quantity - 1 
                       WHERE id='$id' AND quantity > 1 AND user_id='$mid'");
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f8f9fa; font-family:'Segoe UI'; }

.navbar { background:#2a6099; }
.navbar-brand { color:white; font-weight:bold; }

.cart-card {
    background:white;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.cart-img {
    width:100px;
    height:80px;
    object-fit:cover;
}

.qty-btn {
    border:none;
    padding:5px 10px;
    background:#2a6099;
    color:white;
    text-decoration:none;
}

.remove-btn {
    background:#e63946;
    color:white;
    border:none;
    padding:5px 10px;
    text-decoration:none;
}

.total-box {
    background:white;
    padding:20px;
    border-radius:10px;
}
</style>
</head>

<body>


<nav class="navbar">
<div class="container">
<a class="navbar-brand" href="userfirstpage.php">MusicMasters</a>
</div>
</nav>
<div class="container mt-3">
    <a href="userfirstpage.php" class="btn btn-primary">
        ← Continue Shopping
    </a>
</div>

<div class="container mt-4">
<h2>Your Cart</h2>

<div class="row">


<div class="col-lg-8">

<?php
$total = 0;

$res = mysqli_query($con,"SELECT * FROM cart WHERE user_id='$mid'");

if(mysqli_num_rows($res) == 0){
    echo "<h4>Your cart is empty</h4>";
}

while($row = mysqli_fetch_assoc($res)){

    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
?>

<div class="cart-card row align-items-center">

    <div class="col-md-2">
        <img src="media/<?php echo $row['image']; ?>" class="cart-img">
    </div>

 
    <div class="col-md-3">
        <h5><?php echo $row['product_name']; ?></h5>
    </div>

   
    <div class="col-md-2">
        ₹<?php echo $row['price']; ?>
    </div>

    
    <div class="col-md-2">
        <a href="?dec=<?php echo $row['id']; ?>" class="qty-btn">-</a>
        <span class="mx-2"><?php echo $row['quantity']; ?></span>
        <a href="?inc=<?php echo $row['id']; ?>" class="qty-btn">+</a>
    </div>

    <!-- SUBTOTAL -->
    <div class="col-md-2">
        ₹<?php echo $subtotal; ?>
    </div>

    <!-- REMOVE -->
    <div class="col-md-1">
        <a href="?remove=<?php echo $row['id']; ?>" class="remove-btn">X</a>
    </div>

</div>

<?php } ?>

</div>


<div class="col-lg-4">
<div class="total-box">

<h4>Total</h4>
<hr>

<h3 class="text-success">₹<?php echo $total; ?></h3>

<a href="checkout.php" class="btn btn-danger w-100">Checkout</a>

</div>
</div>

</div>
</div>

</body>
</html>