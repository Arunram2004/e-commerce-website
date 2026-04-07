<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Music Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
<?php
 include'sidebar.php';
 ?>
    <div class="content">
        <h2>Existing Employee Details</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
        $servername="localhost";
        $user="root";
        $password="";
        $db="musical_instrument";

        $con = new mysqli($servername,$user,$password,$db);
        if($con){
            $sq="select*from add_employee";
            $sql= mysqli_query($con,$sq);
            while($ro=mysqli_fetch_row($sql)){
                print("
                <tr>
                    <td>$ro[25]</td>
                    <td>$ro[1]</td>
                    <td>$ro[3]</td>
                    <td>$ro[4]</td>
                    <td>$ro[6]</td>
                    <td>
                        <button class='btn btn-danger btn-sm'>Delete</button>
                    </td>
                </tr>
                ");
                

            }
        }
        ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
    </html>
