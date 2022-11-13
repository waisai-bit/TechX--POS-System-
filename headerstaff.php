<?php  
session_start(); 
include('connect.php');

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TechX</title>
    <link rel="icon" href="img/__online_store.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="Customer_Home.php"> <img src="img/logoTechX.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                   <a class="dropdown-item" href="headerstaff.php">Staff Home</a>
                                </li>
                                   <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Product Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       

    <a class="dropdown-item" href="category.php">Category</a>
    <a class="dropdown-item" href="brand.php">Brand</a>
    <a class="dropdown-item" href="color.php">Color</a>
    <a class="dropdown-item" href="specification.php">Specification</a>
    <a class="dropdown-item" href="model.php">Model</a>
    <a class="dropdown-item" href="Product.php">Product</a>
    <a class="dropdown-item" href="Supplier.php">Supplier Register</a>


    
                                    </div>
                                </li>
                                <li class="nav-item">
                                   <a class="dropdown-item" href="Purchase_Order.php">Purchase</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Search & Report
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       
    
    
    <a class="dropdown-item" href="PurchaseSearch.php">Purchase Search & Report</a>
    <a class="dropdown-item" href="OrderSearch.php">Order Search & Report</a>
    
                                    </div>
                                </li>
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Delivery Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       
    <a class="dropdown-item" href="Region.php">Region</a>
    <a class="dropdown-item" href="Delivery.php">Delivery</a>
    
                                    </div>
                                
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

 <!--    <body>
        <div class="text-center staffdiv">
            <h1>Welcome Staff <b>|<?php if(isset($_SESSION['StaffName'])) {echo" [ " ; echo $_SESSION['StaffID']; echo"</b>"; echo" " ; echo"<span>"; echo $_SESSION['StaffName']; echo"</span>"; echo"<b> ]</b>"; } else{echo"Guest";}?></h1>
        </div>
    </body>
<style type="text/css">
.staffdiv{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: -1;
  
}
.staffdiv h1{
    font-size: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
}
.staffdiv h1 span{
    text-transform: uppercase;
}
</style> -->