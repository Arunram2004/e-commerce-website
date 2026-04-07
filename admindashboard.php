<?php
$con=mysqli_connect("localhost","root","","musical_instrument");


$p=mysqli_query($con,"SELECT COUNT(*) as total FROM add_product");
$p=mysqli_fetch_assoc($p);

$o=mysqli_query($con,"SELECT COUNT(*) as total FROM orders");
$o=mysqli_fetch_assoc($o);

$u=mysqli_query($con,"SELECT COUNT(*) as total FROM user_registerform");
$u=mysqli_fetch_assoc($u);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Admin Dashboard - Music Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"/>

<style>
body {
    background-color: #f8f9fa;
    overflow-x: hidden;
}


.content {
    margin-left: 250px;
    padding: 20px;
}

@media (max-width: 991px) {
    .content {
        margin-left: 0;
    }
}

.card {
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.card-header {
    font-weight: bold;
    background-color: #007bff;
    color: white;
}

.card-body {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="content">
<div class="container-fluid">

<h2 class="my-4">Welcome to Admin Panel</h2>

<div class="row g-4">


<div class="col-md-4">
<div class="card text-dark">
<div class="card-header">Total Products</div>
<div class="card-body">
<?php echo $p['total']; ?>
</div>
</div>
</div>


<div class="col-md-4">
<div class="card text-dark">
<div class="card-header">Total Orders</div>
<div class="card-body">
<?php echo $o['total']; ?>
</div>
</div>
</div>


<div class="col-md-4">
<div class="card text-dark">
<div class="card-header">Total Users</div>
<div class="card-body">
<?php echo $u['total']; ?>
</div>
</div>
</div>

</div>

</div>
</div>

</body>
</html>