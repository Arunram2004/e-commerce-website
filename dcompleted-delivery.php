<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: landingpage.php");
    exit();
}

$con=mysqli_connect("localhost","root","","musical_instrument");

$emp_name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Completed Deliveries</title>

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

<h2 class="mb-4">Completed Deliveries</h2>

<div class="card">
<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered align-middle text-center">

<thead class="table-dark">
<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Date</th>
<th>Address</th>
<th>Status</th>
</tr>
</thead>

<tbody>

<?php
$res=mysqli_query($con,"SELECT * FROM orders 
WHERE assigned_employee='$emp_name' AND status='Completed'");

if(mysqli_num_rows($res)==0){
    echo "<tr><td colspan='5'>No Completed Orders</td></tr>";
}

while($row=mysqli_fetch_assoc($res)){
?>

<tr>
<td>#ORD-<?php echo $row['id']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><span class="badge bg-success">Delivered</span></td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>
</div>

</div>

</body>
</html>