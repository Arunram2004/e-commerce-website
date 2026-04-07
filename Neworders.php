<?php
$con=mysqli_connect("localhost","root","","musical_instrument");

/*  HANDLE ASSIGN */
if(isset($_POST['assign'])){
    $order_id = $_POST['order_id'];
    $employee = $_POST['employee'];

    mysqli_query($con,"UPDATE orders 
        SET assigned_employee='$employee', status='Assigned' 
        WHERE id='$order_id'");

    header("Location: Neworders.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>New Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

<h3>New Orders</h3>

<table class="table table-bordered">

<tr>
<th>Order ID</th>
<th>User</th>
<th>Name</th>
<th>Phone</th>
<th>Address</th>
<th>Date</th>
<th>Total</th>
<th>Assigned</th>
<th>Action</th>
</tr>

<?php
$res=mysqli_query($con,"SELECT * FROM orders WHERE status='New' ORDER BY id DESC");

while($row=mysqli_fetch_assoc($res)){
?>

<tr>
<td>#ORD-<?php echo $row['id']; ?></td>
<td>User ID: <?php echo $row['user_id']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td>₹<?php echo $row['total_amount']; ?></td>

<td>
<?php 
echo $row['assigned_employee'] ? $row['assigned_employee'] : "Not Assigned";
?>
</td>

<td>
<button class="btn btn-primary btn-sm" 
onclick="openAssignModal(<?php echo $row['id']; ?>)">
Assign
</button>
</td>

</tr>

<?php } ?>

</table>

</div>

<!--  ASSIGN MODAL -->
<div class="modal fade" id="assignModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Assign Employee</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<form method="POST">

<input type="hidden" name="order_id" id="order_id">

<select name="employee" class="form-control" required>

<option value="">Select Employee</option>

<?php
$emp=mysqli_query($con,"SELECT * FROM add_employee");

while($e=mysqli_fetch_assoc($emp)){
    echo "<option value='".$e['name']."'>".$e['name']."</option>";
}
?>

</select>

<br>

<button type="submit" name="assign" class="btn btn-success w-100">
Assign
</button>

</form>

</div>

</div>
</div>
</div>

<script>
function openAssignModal(id){
    document.getElementById("order_id").value = id;

    var modal = new bootstrap.Modal(document.getElementById('assignModal'));
    modal.show();
}
</script>

</body>
</html>