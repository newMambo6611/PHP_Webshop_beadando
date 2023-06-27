<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- bootsrap css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <style>
        body{
            overflow:hidden;
        }
    </style> -->
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/adminreg.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username", placeholder="Enter your username" required="required" class="form-control w-50">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email", placeholder="Enter your email" required="required" class="form-control w-50">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password", placeholder="Enter your password" required="required" class="form-control w-50">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password", placeholder="Confirm your password" required="required" class="form-control w-50">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
    if (isset($_POST['admin_registration'])){
        $admin_name=$_POST['username'];
        $admin_email=$_POST['email'];
        $admin_password=$_POST['password'];
        $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
        $confirm_password=$_POST['confirm_password'];

        //select query

        $select_query="Select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo "<script>alert('Username or email already exist')</script>";
        }elseif($admin_password!=$confirm_password){
            echo "<script>alert('Passwords do not match')</script>";
        }else{

        //insert query
        $insert_query="insert into `admin_table` (admin_name, admin_email, admin_password) values('$admin_name', '$admin_email','$hash_password')";
        $sql_execute=mysqli_query($con, $insert_query);
        if($sql_execute){
            echo "<script>alert('Data inserted successfully')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        }else{
            die(mysqli_error($con));
        }
    }
    }
    ?>