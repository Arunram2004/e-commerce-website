<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: landingpage.php");
    exit();
}

$con=mysqli_connect("localhost","root","","musical_instrument");

$emp_id = $_SESSION['id'];

$res=mysqli_query($con,"SELECT * FROM add_employee WHERE id='$emp_id'");
$data=mysqli_fetch_assoc($res);


if(isset($_POST['sub'])){

    $name=$_POST["employeeName"];
    $email=$_POST["employeeEmail"];
    $phone=$_POST["employeePhone"];
    $street=$_POST["street"];
    $area=$_POST["area"];
    $city=$_POST["city"];
    $district=$_POST["district"];
    $state=$_POST["state"];
    $country=$_POST["country"];
    $pass=$_POST["password"];

    /* HANDLE IMAGE UPLOAD */
    if(!empty($_FILES['profile']['name'])){
        $img=$_FILES['profile']['name'];
        $tmp=$_FILES['profile']['tmp_name'];

        move_uploaded_file($tmp,"media/".$img);

        mysqli_query($con,"UPDATE add_employee SET profile='$img' WHERE id='$emp_id'");
    }

    mysqli_query($con,"UPDATE add_employee SET 
    name='$name',
    email='$email',
    phone='$phone',
    street='$street',
    area='$area',
    city='$city',
    district='$district',
    state='$state',
    country='$country',
    password='$pass'
    WHERE id='$emp_id'");

    echo "<script>alert('Profile Updated Successfully'); window.location='dprofileupdate.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.content {
    margin-left: 250px;
    padding: 30px;
}

.profile-box {
    text-align: center;
    margin-bottom: 30px;
}

.profile-box img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #333;
}

.upload-btn {
    margin-top: 10px;
}
</style>
</head>

<body>

<?php include "delvsidebar.php"; ?>

<div class="content">


<div class="profile-box">

<img src="media/<?php echo $data['profile']; ?>" alt="Profile">

<h4 class="mt-2"><?php echo $data['name']; ?></h4>

</div>


<form method="post" enctype="multipart/form-data">

<label>Change Profile Image</label>
<input type="file" name="profile" class="form-control mb-3">

<input type="text" name="employeeName" class="form-control mb-2" placeholder="Enter Name" required>

<input type="email" name="employeeEmail" class="form-control mb-2" placeholder="Enter Email" required>

<input type="text" name="employeePhone" class="form-control mb-2" placeholder="Enter Phone" required>

<input type="text" name="street" class="form-control mb-2" placeholder="Street" required>

<input type="text" name="area" class="form-control mb-2" placeholder="Area" required>

<input type="text" name="city" class="form-control mb-2" placeholder="City" required>

<input type="text" name="district" class="form-control mb-2" placeholder="District" required>

<input type="text" name="state" class="form-control mb-2" placeholder="State" required>

<input type="text" name="country" class="form-control mb-2" placeholder="Country" required>

<input type="password" name="password" class="form-control mb-2" placeholder="New Password">

<button name="sub" class="btn btn-primary w-100">
Update Profile
</button>

</form>

</div>

</body>
</html>