<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Employee</title>

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

<h2>Add New Employee</h2>

<form method="post" enctype="multipart/form-data">

<input type="text" name="employeeName" class="form-control mb-2" placeholder="Name" required>

<select name="gender" class="form-control mb-2" required>
<option value="">Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

<select name="employeeDepartment" class="form-control mb-2" required>
<option value="">Department</option>
<option value="delivery">Delivery</option>
</select>

<input type="email" name="employeeEmail" class="form-control mb-2" placeholder="Email" required>

<input type="text" name="employeePhone" class="form-control mb-2" placeholder="Phone" required>

<input type="text" name="altemployeePhone" class="form-control mb-2" placeholder="Alternate Phone" required>

<input type="date" name="dob" class="form-control mb-2" required>

<input type="number" name="expyears" class="form-control mb-2" placeholder="Experience Years" required>

<input type="text" name="companyName" class="form-control mb-2" placeholder="Company Name" required>

<input type="text" name="accountHolder" class="form-control mb-2" placeholder="Account Holder" required>

<input type="text" name="accountNumber" class="form-control mb-2" placeholder="Account Number" required>

<input type="text" name="bankName" class="form-control mb-2" placeholder="Bank Name" required>

<input type="text" name="branch" class="form-control mb-2" placeholder="Branch" required>

<input type="text" name="ifscCode" class="form-control mb-2" placeholder="IFSC Code" required>

<select name="accountType" class="form-control mb-2" required>
<option value="">Account Type</option>
<option value="savings">Savings</option>
<option value="current">Current</option>
</select>

<input type="text" name="street" class="form-control mb-2" placeholder="Street" required>
<input type="text" name="area" class="form-control mb-2" placeholder="Area" required>
<input type="text" name="city" class="form-control mb-2" placeholder="City" required>
<input type="text" name="district" class="form-control mb-2" placeholder="District" required>
<input type="text" name="state" class="form-control mb-2" placeholder="State" required>
<input type="text" name="country" class="form-control mb-2" placeholder="Country" required>

<label>Proof</label>
<input type="file" name="image" class="form-control mb-2" required>

<label>Photo</label>
<input type="file" name="img" class="form-control mb-2" required>

<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<button name="sub" class="btn btn-success w-100">Add Employee</button>

</form>

</div>

<?php
$con=mysqli_connect("localhost","root","","musical_instrument");

if(isset($_POST["sub"])){

$name=$_POST["employeeName"];
$gender=$_POST["gender"];
$department=$_POST["employeeDepartment"];
$email=$_POST["employeeEmail"];
$phone=$_POST["employeePhone"];
$altphone=$_POST["altemployeePhone"];
$dob=$_POST["dob"];
$expyears=$_POST["expyears"];
$companyname=$_POST["companyName"];
$accountholder=$_POST["accountHolder"];
$accountnumber=$_POST["accountNumber"];
$bankname=$_POST["bankName"];
$branch=$_POST["branch"];
$ifsccode=$_POST["ifscCode"];
$accounttype=$_POST["accountType"];
$street=$_POST["street"];
$area=$_POST["area"];
$city=$_POST["city"];
$district=$_POST["district"];
$state=$_POST["state"];
$country=$_POST["country"];
$pass=$_POST["password"];

/*  GENERATE EMPLOYEE CODE */
$res=mysqli_query($con,"SELECT MAX(id) as maxid FROM add_employee");
$row=mysqli_fetch_assoc($res);

$next = $row['maxid'] ? $row['maxid'] + 1 : 1;
$emp_code = "EMP".str_pad($next,3,'0',STR_PAD_LEFT);

/* FILE UPLOAD */
$image=$_FILES["image"]["name"];
$tmp=$_FILES["image"]["tmp_name"];
move_uploaded_file($tmp,"media/".$image);

$img=$_FILES["img"]["name"];
$tmp2=$_FILES["img"]["tmp_name"];
move_uploaded_file($tmp2,"media/".$img);


$sql="INSERT INTO add_employee(
employee_code,
name,gender,department,email,phone,alt_phone,dob,
years_of_experience,company_name,account_holdername,
account_number,bank_name,branch,ifsc_code,account_type,
street,area,city,district,state,country,proof,profile,password
) VALUES(
'$emp_code',
'$name','$gender','$department','$email','$phone','$altphone','$dob',
'$expyears','$companyname','$accountholder',
'$accountnumber','$bankname','$branch','$ifsccode','$accounttype',
'$street','$area','$city','$district','$state','$country','$image','$img','$pass'
)";

mysqli_query($con,$sql);

echo "<script>alert('Employee Added Successfully');</script>";
}
?>

</body>
</html>