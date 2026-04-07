<?php
$con=mysqli_connect("localhost","root","","musical_instrument");
?>

<!DOCTYPE html>
<html>
<head>
<title>Completed Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.content {
    margin-left: 260px;
    padding: 20px;
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="content">

<h3>Completed Orders</h3>

<table class="table table-bordered">

<tr>
<th>Order ID</th>
<th>User</th>
<th>Date</th>
<th>Total</th>
<th>Status</th>
</tr>

<?php
$res=mysqli_query($con,"SELECT * FROM orders WHERE status='Completed' ORDER BY id DESC");

while($row=mysqli_fetch_assoc($res)){
?>

<tr>
<td>#ORD-<?php echo $row['id']; ?></td>
<td>User ID: <?php echo $row['user_id']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td>₹<?php echo $row['total_amount']; ?></td>
<td><span class="badge bg-success">Delivered</span></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>