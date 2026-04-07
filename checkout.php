<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: landingpage.php");
    exit();
}

$mid = $_SESSION['id'];

$con=mysqli_connect("localhost","root","","musical_instrument");
$res = mysqli_query($con,"SELECT * FROM cart WHERE user_id='$mid'");

$total = 0;
$items = [];

while($row=mysqli_fetch_assoc($res)){
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    $items[] = $row;
}


if(isset($_POST['place_order'])){

    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    
    mysqli_query($con,"INSERT INTO orders(user_id,total_amount,customer_name,phone,address,status)
    VALUES('$mid','$total','$name','$phone','$address','New')");

    $order_id = mysqli_insert_id($con);

   
    foreach($items as $item){
        mysqli_query($con,"INSERT INTO order_items(order_id,product_id,product_name,price,quantity)
        VALUES('$order_id','".$item['product_id']."','".$item['product_name']."','".$item['price']."','".$item['quantity']."')");
    }

   
    mysqli_query($con,"DELETE FROM cart WHERE user_id='$mid'");

    echo "<script>alert('Order placed successfully'); window.location='userfirstpage.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#f8f9fa;}
.box{background:white;padding:20px;border-radius:10px;}
</style>
</head>

<body>

<div class="container mt-5">

<h2>Checkout</h2>

<div class="row">

<div class="col-md-6 box">

<h4>Order Summary</h4>
<hr>

<?php foreach($items as $item){ ?>
<div class="d-flex justify-content-between">
    <div><?php echo $item['product_name']; ?> (x<?php echo $item['quantity']; ?>)</div>
    <div>₹<?php echo $item['price'] * $item['quantity']; ?></div>
</div>
<?php } ?>

<hr>
<h4>Total: ₹<?php echo $total; ?></h4>

</div>


<div class="col-md-6 box">

<h4>Delivery Details</h4>

<form method="POST">

<input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
<input type="text" name="phone" class="form-control mb-2" placeholder="Phone Number" required>
<textarea name="address" class="form-control mb-2" placeholder="Full Address" required></textarea>

<button name="place_order" class="btn btn-success w-100">Place Order</button>

</form>

</div>

</div>

</div>

</body>
</html>