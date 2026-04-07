<?php
$con = new mysqli("localhost","root","","musical_instrument");

if(!$con){
    die("Connection failed");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Users - Music Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.content {
    margin-left: 260px;
    padding: 20px;
}

.table {
    margin-top: 20px;
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="content">

<h3>USER DETAILS</h3>

<div class="card shadow-sm rounded border-0 mb-4">
<div class="card-body">

<div class="table-responsive">

<table class="table table-striped table-bordered">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Gender</th>
<th>DOB</th>
<th>Address</th>
</tr>
</thead>

<tbody>

<?php
$res = mysqli_query($con,"SELECT * FROM user_registerform");

if(mysqli_num_rows($res)==0){
    echo "<tr><td colspan='7'>No users found</td></tr>";
}

while($row = mysqli_fetch_assoc($res)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>

<td>
<?php echo $row['phone'] ; ?>
</td>

<td>
<?php echo $row['gender'] ; ?>
</td>

<td>
<?php echo $row['dob'] ; ?>
</td>

<td>
<?php echo $row['address'] ; ?>
</td>

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