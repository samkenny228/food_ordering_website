<?php 
session_start();
include('connectdb.php');
include('overall_link.php');
if(!isset($_SESSION['phone_number'])){
    echo "<script>window.open('index.php', '_self')</script>";
}
$ph_num = $_SESSION['phone_number'];

$select_session = mysqli_query($conn, "SELECT * FROM register WHERE phone_n ='$ph_num'");
$run_select_session = mysqli_fetch_assoc($select_session);
$check_select = mysqli_num_rows($select_session);

if($check_select == 1){
if($ph_num == $run_select_session['phone_n']){
$ph_num = $run_select_session['phone_n'];
}


if($_SESSION['phone_number'] == $ph_num){


$ph_num = $_SESSION['phone_number'];
$get_user = "select * from register where phone_n = '$ph_num'";
$run_get_user = mysqli_query($conn, $get_user);
$row = mysqli_fetch_assoc($run_get_user);

$user_id = $row['register_id'];

if(!isset($_GET['puid'])){
    $select_pack = mysqli_query($conn, "SELECT * FROM packs WHERE user_id ='$user_id'");
    $fetch_pack_for_cart = mysqli_fetch_assoc($select_pack);
    $pack_for_cart = $fetch_pack_for_cart['pack_uniquieid'];
    }elseif(isset($_GET['puid'])){
    $pack_for_cart = $_GET['puid'];
    }

if(isset($_POST["submit_udate_quantity"])){
    $update_value = $_POST["new_cart_quantity"];
    $update_id=$_POST["update_cart_id"];
    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$update_value' WHERE cart_id ='$update_id'");
    if($update_quantity_query){
        echo "<script>alert('updated successfull')</script>";
        echo "<script>window.open('cart.php', '_self')</script>";
    };
};


if(isset($_GET["remove"])){
    $rmove_id = $_GET["remove"];
    mysqli_query($conn, "DELETE FROM cart WHERE cart_id ='$rmove_id'");
    echo "<script>window.open('cart.php?puid=$pack_for_cart', '_self')</script>";
};
if(isset($_GET["delete_all"])){
    $rmove_id = $_GET["delete_all"];
    mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
    echo "<script>window.open('cart.php', '_self')</script>";
}
?>
<?php 
$select_pack = mysqli_query($conn, "SELECT * FROM packs WHERE user_id ='$user_id'");
$num_pack_fetch = mysqli_num_rows($select_pack);
if($num_pack_fetch == 0){
    echo "<script>window.open('pack.php', '_self')</script>";
}

            while($fetch_pack = mysqli_fetch_assoc($select_pack)){ 
            $pack_uniquieid = $fetch_pack["pack_uniquieid"];

            $select_cart_pack = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' and pack_uniquieid = '$pack_uniquieid'");
            $select_cart_pack_num = mysqli_num_rows($select_cart_pack);
            
            if($select_cart_pack_num == 0){
            }
            }
            ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bukolary's</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
        <script src="https://kit.fontawesome.com/f1e65f5572.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="jquery-3.7.1.js"></script>
<script type="text/javascript" src="js/cart_quantity_update.js"></script>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: 30px;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
select {
  width: 100%;
  padding: 9px 15px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.checkout_btn a.disable{
    pointer-events: none;
    opacity: 5;
    user-select: none;
    
}
</style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="main.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Bukolary's</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="main.php" class="nav-item nav-link active">Home</a>
                        <a href="history.php" class="nav-item nav-link">Tracker</a>
                        <a href="pack.php" class="nav-item nav-link">ADD TO PACK</a>
                        <!--<a href="service.html" class="nav-item nav-link">Service</a>-->
                        <a href="pickup_menu.php" class="nav-item nav-link">PICK UP</a>
                        <!--<div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>-->
                    </div>
                    <a href="menu.php" class="btn btn-primary py-2 px-4">DELIVERY</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header">
            </div>
        </div>

<div class="bg-dark hero-header" style="position: sticky; top: 0; margin-bottom:25px;" >

<div  style="border-radius:13px; color:white; padding:25px;">
<form  id="form_nav" action="" method="GET">
<a href="cart.php?puid=<?=$pack_for_cart?>" class="bg-dark" style="color:white; float: right; padding:6px; border-radius:15px; font-size:13px;">
<i class="fa-solid fa-cart-shopping"></i>
<?php 
$select_cart = mysqli_query($conn, "SELECT * FROM cart where user_id = '$user_id' and pack_uniquieid = '$pack_for_cart'");
$fetch_num_cart = mysqli_num_rows($select_cart);
?>
<span id="message" style="padding: 2px; border-radius: 2px;"><?=$fetch_num_cart?></span>
</a>

<p class="p_menu_list">
<?php 
$select_pack = mysqli_query($conn, "SELECT * FROM packs WHERE user_id ='$user_id'");
$id = 1;
while($fetch_cart = mysqli_fetch_assoc($select_pack)){
    if($fetch_cart['pack_uniquieid'] == $pack_for_cart){
    $activ = 'activ';
    }else{
    $activ = '';
    }
?>
<button name="puid" value="<?= $fetch_cart['pack_uniquieid'] ?>" class="btn_menu_list <?=$activ?>">PACK <?=$id++?></button>
<?php } ?>
</p>

</form> 
</div>

</div>
        <!-- Navbar & Hero End -->
        
         <?php
    $menu = "SELECT * from menu";
    $menu_query = mysqli_query($conn, $menu);
    $row_menu = mysqli_fetch_assoc($menu_query);
    $menu_state = $row_menu['menu_status'];
    if($menu_state == 0){
?>
        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Cart Not Available</h5>
                    <h1 class="mb-5">Sorry We Are Not Available To Take Order Yet</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                       <!-- <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <i class="fa fa-coffee fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Popular</small>
                                    <h6 class="mt-n1 mb-0">Breakfast</h6>
                                </div>
                            </a>
                        </li>-->
                       <!-- <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <i class="fa fa-utensils fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Lovely</small>
                                    <h6 class="mt-n1 mb-0">Dinner</h6>
                                </div>
                            </a>
                        </li>-->
                    </ul>
                    <div class="tab-content">
                       <!-- <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-5.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-6.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-7.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                      <?php 
                      /*   $query = "SELECT * from input_item where status='Avalable' ORDER BY item_id DESC";
                         $sql = mysqli_query($conn, $query);
                        if(mysqli_num_rows($sql) > 0){
                                 while($row_run_select = mysqli_fetch_array($sql)){
                                       $item = $row_run_select['item'];
                                       $price = $row_run_select['price']; 
                                       $image = $row_run_select['image'];
                                      $section =  $row_run_select['section'];
                                        if($item == ""){

                                  }else{
                              */?>
                      <!--  <div id="tab-2" class="tab-pane fade show p-0 active" style="margin: 15px;">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="uploaded_img/<?php //echo $image ?>" alt="" style="width: 35px; height:40px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span><?php //echo $item; ?></span>
                                                <span class="text-primary">&#8358;<?php // echo  $price; ?></span>
                                            </h5>
                                            </div>
                                    </div>
                                </div>
                                </div>
                            </div> -->
                    
                        <?php // }} }?>
                       <!-- <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-5.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-6.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-7.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
<?php }else{ ?>

        
                <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <!-- <h5 class="section-title ff-secondary text-center text-primary fw-normal">Continue Your Order</h5> -->
                    <h1 class="mb-5">Orders</h1>
                </div>
        <div class="container-xxl bg-white p-0">
        <div class="col-md-12">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            <!--<table>
            <tr>
                <th class="bg-primary">S/N</th>
                <th class="bg-primary">Images</th>
                <th class="bg-primary">Item</th>
                 <th class="bg-primary">Quantity</th> 
                <th class="bg-primary">Total price</th>
                <th class="bg-primary">Action</th>
            </tr>-->
            
<div id="cart_quantity_update_message">
            <?php
            $i = 1;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $sub_total = $fetch_cart['cart_price'] * $fetch_cart['quantity']; ?>
                <div id="tab-2" class="tab-pane fade show p-0 active" style="margin-bottom: 15px;">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="uploaded_img/<?php echo $fetch_cart['cart_image']; ?>" alt="" style="width: 35px; height: 60px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            
                                            <form method="POST" action="" id="cart_update_quantity">
                                            <h6 style="font-size:13px;" class="d-flex justify-content-between border-bottom pb-2">
                                                <span>
                                                <?php echo $fetch_cart['cart_name'];?><br>
                                                <small style="font-size:10px;">
                                                &#8358;<?php echo number_format($fetch_cart['cart_price'] * $fetch_cart['quantity']);?>
                                                </small>
                                                </span>
                                                <span class="text-primary"><a href="cart.php?remove=<?=$fetch_cart['cart_id'];?>&puid=<?=$pack_for_cart?>" onclick="return confirm('remove item from cart');" class="btn btn-primary"><i class="fa-solid fa-trash"></i></a></span>
                                            </h6>
                                            
                                            <h6 class="d-flex justify-content-between border-bottom pb-2">
                                            <div class="div_qt">
                                            <input type="hidden" value="<?php echo $fetch_cart['cart_id'];?>" name="update_cart_id" class="update_cart_id">
                                            <input type="hidden" value="<?php echo $fetch_cart['quantity'];?>" name="quantity" class="quantity">
                                            <input type="hidden" value="<?php echo $pack_for_cart;?>" name="pack_for_cart" class="pack_for_cart">
                                            <small style="background-color: rgba(0, 0, 0, 0.03); border:1px solid rgba(0, 0, 0, 0.2); border-radius:10px;">
                                            <button style="color:black; background-color: transparent; border:none;"  name="minus_cart_quantity" class="minus_cart_quantity" value="minus">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <?=$fetch_cart['quantity'];?>
                                            <button style="color:black; background-color: transparent; border:none;" name="plus_cart_quantity" class="plus_cart_quantity" value="plus">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                            <!--<input type="number" value="<?php //echo  $fetch_cart['quantity'];?>" name="new_cart_quantity" class="new_cart_quantity" style="width: 65px; height:30px;" max=4> -->
                                            </small>
                                            
                                            </div>
                                           <?php 
                                            $item_name =  $fetch_cart['cart_name'];
                                            $select_inputitem = mysqli_query($conn, "SELECT * FROM input_item Where item='$item_name'");
                                            $fetch_inputitem = mysqli_fetch_assoc($select_inputitem);
                                            if($fetch_inputitem['pot'] == 2){ 
                                                echo "Portion";
                                            }else{
                                           
                                           }
                                            ?>
                                            </small>
                                            </h6>
                                            </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
             <?php  
             $grand_total += $sub_total;
             }
            }
            ?>
            </div>
            <hr>
<div id="tab-2" class="tab-pane fade show p-0 active" style="margin-bottom: 15px;">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                           </div>
                                    </div>
                                </div>
                            </div>
                        </div>
           <!--  <tr>
                <td><a href="menu.php" class="btn btn-primary">Continue Shopping</a></td>
                <td colspan="1"><strong>Grade total</strong></td>
                <td>&#8358;<?php //echo number_format($grand_total); ?></td>
                <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all');" class="btn btn-primary">Delete all</a></td>
            </tr>
            </table>-->
            
            <div class="checkout_btn" style="text-align: center; margin-top: 10px;">
            <a href="checkout.php" class="btn btn-primary <?= ($grand_total > 1)?'':'disable'; ?>" style="margin-bottom: 7px;">proceed to checkout</a>
            <br><br>
            <a href="menu.php?puid=<?=$pack_for_cart?>" class="btn btn-primary">Continue order</a>
            </div>
            </div>
            </div>
        </div>            
        </div>
        </div>
<?php } ?>


                <!-- Footer Start -->
                <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">Delivery</a>
                        <a class="btn btn-link" href="">Pick up</a>
                        <a class="btn btn-link" href="">Menu</a>
                        <!--<a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>-->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>God is good hostel at Phase 2 Ado-Ekiti, Ekiti</p>
                        <p class="mb-2"><i class="fa-brands fa-whatsapp"></i>&nbsp; &nbsp; &nbsp;08122622321</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>09064386541</p>
                        <!--<p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>-->
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <!--<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>-->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Open hours</h4>
                        <h5 class="text-light fw-normal">Monday - Sunday</h5>
                        <p>11AM - 11PM</p>
                    </div>
                    <!--<div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="">Bukolary's</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="http://wa.me/2348103226226">ASKWEB</a><br><br>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

                <!-- Back to Top -->
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
      <script>
 $(document).ready(function(){
            $('.new_cart_quantity ').on('change', function(){
				var $el = $(this).closest('.div_qt');
				var new_cart_quantity = $el.find(".new_cart_quantity").val();
                var update_cart_id = $el.find(".update_cart_id").val();
                
                $.ajax({
                url: "load_cart.php",
                method: "post",
                cache: false,
                data: {update_cart_id:update_cart_id,new_cart_quantity:new_cart_quantity},
                success:function(response){
                   
                    console.log(response);    
                }
            });   
            });  

        });
</script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<?php }else{
            echo "<script>location.href='index.php'</script>";
    } }else{
        echo "<script>location.href='index.php'</script>";
}?>