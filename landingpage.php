<?php
session_start();

$con=mysqli_connect("localhost","root","","musical_instrument");

if(!$con){
    die("Connection failed");
}

/* USER REGISTER  */
if(isset($_POST['user_register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];

    $check=mysqli_query($con,"SELECT * FROM user_registerform WHERE email='$email'");

    if(mysqli_num_rows($check)>0){
        echo "<script>alert('Email already registered');</script>";
    } else {
        mysqli_query($con,"INSERT INTO user_registerform
        (name,email,password,phone,gender,dob,address)
        VALUES
        ('$name','$email','$pass','$phone','$gender','$dob','$address')");

        echo "<script>alert('Registration Successful');</script>";
    }
}


if(isset($_POST['user_login'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $res=mysqli_query($con,"SELECT * FROM user_registerform WHERE email='$email' AND password='$pass'");

    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);

        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['role']="user";

        header("Location: userfirstpage.php");
        exit();
    } else {
        echo "<script>alert('Invalid login');</script>";
    }
}


if(isset($_POST['employee_login'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $res=mysqli_query($con,"SELECT * FROM add_employee WHERE email='$email' AND password='$pass'");

    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);

        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['role']="employee";

        header("Location: delivery-employeedashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid employee login');</script>";
    }
}


if(isset($_POST['admin_login'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $res=mysqli_query($con,"SELECT * FROM admin WHERE email='$email' AND pass='$pass'");

    if(mysqli_num_rows($res)>0){
        $_SESSION['role']="admin";
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid admin login');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>TPC MUSICALS</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
body { background:#f8f9fa; }

.navbar { padding:15px; }

.carousel img {
    height:500px;
    object-fit:cover;
}

.carousel-caption {
    background: rgba(0,0,0,0.6);
    padding:20px;
    border-radius:10px;
}

.feature-box {
    padding:20px;
    transition:0.3s;
}

.feature-box:hover {
    transform:scale(1.05);
}

footer {
    background:#343a40;
    color:white;
    padding:30px;
}
</style>
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
<h3 class="text-white">🎵 TPC MUSICALS</h3>

<div class="ml-auto">
<button class="btn btn-outline-light mr-2" data-toggle="modal" data-target="#userLoginModal">👤 User</button>
<button class="btn btn-outline-light mr-2" data-toggle="modal" data-target="#employeeLoginModal">👨‍🔧 Employee</button>
<button class="btn btn-outline-light mr-2" data-toggle="modal" data-target="#adminLoginModal">🛠 Admin</button>
</div>
</nav>


<div id="carouselExample" class="carousel slide" data-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active position-relative">
<img src="DIVE INTO THE (1).png" class="d-block w-100">
</div>

<div class="carousel-item">
<img src="2.png" class="d-block w-100">
</div>

<div class="carousel-item">
<img src="3.png" class="d-block w-100">
</div>

</div>

</div>


<div class="container mt-5">

<h2 class="text-center mb-4">Why Choose Us</h2>

<div class="row text-center">

<div class="col-md-4 feature-box">
<h4>🎸 Quality Instruments</h4>
<p>Best instruments for beginners & professionals</p>
</div>

<div class="col-md-4 feature-box">
<h4>🚚 Fast Delivery</h4>
<p>Quick and reliable delivery service</p>
</div>

<div class="col-md-4 feature-box">
<h4>💰 Best Prices</h4>
<p>Affordable prices for everyone</p>
</div>

</div>

</div>


<div class="container mt-5">
<h2 class="text-center">About TPC MUSICALS</h2>

<p class="text-center">
Music is emotion, creativity, and passion.  
TPC MUSICALS helps you explore and experience music through premium instruments.
</p>

</div>


<footer class="text-center mt-5">
<h5>🎵 TPC MUSICALS</h5>
<p>Your music journey starts here</p>
<p>© 2026 All Rights Reserved</p>
</footer>

<div class="modal fade" id="userLoginModal">
<div class="modal-dialog">
<div class="modal-content p-3">
<h4>User Login</h4>
<form method="POST">
<input type="email" name="email" class="form-control mb-2" required>
<input type="password" name="password" class="form-control mb-2" required>
<button name="user_login" class="btn btn-primary w-100">Login</button>
</form>
</div>
</div>
</div>


<div class="modal fade" id="registerModal">
<div class="modal-dialog">
<div class="modal-content p-3">
<h4>Register</h4>
<form method="POST">
<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
<select name="gender" class="form-control mb-2" required>
<option value="">Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
<input type="date" name="dob" class="form-control mb-2" required>
<textarea name="address" class="form-control mb-2" placeholder="Address" required></textarea>
<button name="user_register" class="btn btn-success w-100">Register</button>
</form>
</div>
</div>
</div>


<div class="modal fade" id="employeeLoginModal">
<div class="modal-dialog">
<div class="modal-content p-3">
<h4>Employee Login</h4>
<form method="POST">
<input type="email" name="email" class="form-control mb-2" required>
<input type="password" name="password" class="form-control mb-2" required>
<button name="employee_login" class="btn btn-warning w-100">Login</button>
</form>
</div>
</div>
</div>


<div class="modal fade" id="adminLoginModal">
<div class="modal-dialog">
<div class="modal-content p-3">
<h4>Admin Login</h4>
<form method="POST">
<input type="email" name="email" class="form-control mb-2" required>
<input type="password" name="password" class="form-control mb-2" required>
<button name="admin_login" class="btn btn-danger w-100">Login</button>
</form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>