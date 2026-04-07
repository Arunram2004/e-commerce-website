<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: landingpage.php");
    exit();
}

$con=mysqli_connect("localhost","root","","musical_instrument");

$emp_name = $_SESSION['name'];

/*  COUNT ASSIGNED */
$assigned = mysqli_fetch_assoc(mysqli_query($con,
"SELECT COUNT(*) as total FROM orders 
WHERE assigned_employee='$emp_name' AND status='Assigned'"));

/*  COUNT COMPLETED */
$completed = mysqli_fetch_assoc(mysqli_query($con,
"SELECT COUNT(*) as total FROM orders 
WHERE assigned_employee='$emp_name' AND status='Completed'"));

/*  TOTAL */
$total = $assigned['total'] + $completed['total'];

/* GET PROFILE */
$emp = mysqli_fetch_assoc(mysqli_query($con,
"SELECT * FROM add_employee WHERE name='$emp_name'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
.content {
    margin-left: 250px;
    padding: 30px;
}

.profile-box {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.profile-box img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
</head>

<body>

<?php include "delvsidebar.php"; ?>

<div class="content">


<div class="profile-box">
<img src="media/<?php echo $emp['profile']; ?>" alt="Profile">
<div>
<h4><?php echo $emp_name; ?></h4>
<small>Delivery Employee</small>
</div>
</div>

<h2>Welcome, <?php echo $emp_name; ?> </h2>


<div class="row mt-4">


<div class="col-md-4">
<div class="card text-dark  shadow">
<div class="card-body text-center">
<i class="bi bi-box-seam fs-2"></i>
<h5 class="mt-2">Assigned Orders</h5>
<h2><?php echo $assigned['total']; ?></h2>
</div>
</div>
</div>


<div class="col-md-4">
<div class="card text-dark  shadow">
<div class="card-body text-center">
<i class="bi bi-check-circle fs-2"></i>
<h5 class="mt-2">Completed Orders</h5>
<h2><?php echo $completed['total']; ?></h2>
</div>
</div>
</div>


<div class="col-md-4">
<div class="card text-dark  shadow">
<div class="card-body text-center">
<i class="bi bi-truck fs-2"></i>
<h5 class="mt-2">Total Deliveries</h5>
<h2><?php echo $total; ?></h2>
</div>
</div>
</div>

</div>

</div>

</body>
</html>