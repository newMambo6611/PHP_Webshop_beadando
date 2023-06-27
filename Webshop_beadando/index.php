<!-- connect file  -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
    <!--bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            overflow-x:hidden;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"      aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <?php
                            if(isset($_SESSION['usernname'])){
                                echo "<li class='nav-item'>
                                <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                            </li>";
                            }else{
                               echo "<li class='nav-item'>
                                <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                            </li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="false"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total price:<?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn text-center btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>


        <!-- calling cart function  -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li> -->
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a></li>";
                    }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a></li>";
                    }

                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                    }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                    }
                ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="./users_area/user_login.php">Login</a>
                </li> -->
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- fourth child -->
        <div class="row px-3">
            <!-- main content -->
            <div class="col-md-10">
                <div class="row">
                    <!-- fetching products -->
                    <?php
                        // calling function to get products
                        getproducts();
                        get_unique_categories();
                        get_unique_brands();
                        // $ip = getIPAddress();  
                        // echo 'User Real IP Address - '.$ip;  
                    ?>
                </div>
                <!-- end of products row -->
            </div>
            <!-- end of main content column -->

            <!-- sidebar -->
            <div class="col-md-2 bg-secondary p-0">
                <!-- brands section -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery brands</h4>
                        </a>
                    </li>
                    <?php
                        // calling function to get brands
                        getbrands();
                    ?>
                </ul>
                <!-- end of brands section -->

                <!-- categories section -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                        // calling function to get categories
                        getcategories();
                    ?>
                </ul>
                <!-- end of categories section -->
            </div>
            <!-- end of sidebar column -->
        </div>
        <!-- end of fourth child row -->

        <!-- last child -->
        <!-- include footer -->
        <?php
        include("./includes/footer.php")
        ?>







<!-- bootstrap js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>