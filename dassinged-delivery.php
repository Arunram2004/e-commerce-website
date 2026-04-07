<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: landingpage.php");
    exit();
}

$con=mysqli_connect("localhost","root","","musical_instrument");

$emp_name = $_SESSION['name'];


if(isset($_GET['deliver'])){
    $id=$_GET['deliver'];

    mysqli_query($con,"UPDATE orders SET status='Completed' WHERE id='$id'");

    header("Location: dassinged-delivery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Assigned Deliveries</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.content {
    margin-left: 250px;
    padding: 30px;
}
</style>
</head>

<body>

<?php include "delvsidebar.php"; ?>

<div class="content">

<h2 class="mb-4">Assigned Deliveries</h2>

<div class="table-responsive">
<table class="table table-bordered table-hover align-middle">

<thead class="table-dark">
<tr>
<th>Order ID</th>
<th>Date</th>
<th>Customer</th>
<th>Address</th>
<th>Phone</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
$res=mysqli_query($con,"SELECT * FROM orders 
WHERE assigned_employee='$emp_name' AND status='Assigned'");

if(mysqli_num_rows($res)==0){
    echo "<tr><td colspan='6'>No Assigned Orders</td></tr>";
}

while($row=mysqli_fetch_assoc($res)){
?>

<tr>
<td>#ORD-<?php echo $row['id']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['phone']; ?></td>

<td>
<a href="?deliver=<?php echo $row['id']; ?>" 
   class="btn btn-success btn-sm"
   onclick="return confirm('Mark this order as delivered?')">
   Mark Delivered
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>
</div>

</div>

</body>
</html>