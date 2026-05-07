<?php
session_start();
include('connectdb.php');
if(isset($_POST['login'])){
    $user_name = htmlentities(mysqli_real_escape_string($conn, $_POST["user_name"]));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));

    $select_user = "select * from register where user_n = '$user_name' AND password = '$password'";
    $query = mysqli_query($conn, $select_user);
    $check_user = mysqli_num_rows($query);

    if($check_user == 1){
        $_SESSION["user_name"] = $user_name;  
        $_SESSION["password"] = $password;
        $user_n = $_SESSION['user_name'];
        $pass = $_SESSION['password'];
        echo "<script>window.open('index.php', '_self')</script>";
    }else{
        echo "<script>alert('incorrect username or password, try again')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
    }
}
if(!isset($_SESSION['user_name'])){
    echo "<script>window.open('login.php', '_self')</script>";
}
$user_n = $_SESSION['user_name'];

$select_session = mysqli_query($conn, "SELECT * FROM register WHERE user_n ='$user_n'");
$run_select_session = mysqli_fetch_assoc($select_session);
$check_select = mysqli_num_rows($select_session);

if($check_select == 1){
if($user_n == $run_select_session['user_n']){
$u_name = $run_select_session['user_n'];
}


if($_SESSION['user_name'] == $u_name){


$user = $_SESSION['user_name'];
$get_user = "select * from register where user_n = '$user'";
$run_get_user = mysqli_query($conn, $get_user);
$row = mysqli_fetch_assoc($run_get_user);

$user_id = $row['register_id'];
$user_name = $row['user_n'];
$password = $row['password'];
$full_name = $row['full_n'];
$phone_number = $row['phone_n'];





if(isset($_POST["order"])){
$name = $_POST["name"];
$p_number = $_POST["p_number"];
$location = 0;
$address = 'carry out';
$discrib_h = 'carry out';
$takeaway = 200 * $_POST['takeaway'];
$num_takeaway = $_POST['takeaway'];
$w_number = $_POST['w_number'];

$cart_guery = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'");
$total_item_price = 0;
if(mysqli_num_rows($cart_guery) > 0){
while($fetch_itme = mysqli_fetch_assoc($cart_guery)){
     $item_name = $fetch_itme["cart_name"];
     $item_price = $fetch_itme["cart_price"];
     $item_quantity = $fetch_itme["quantity"];
     $name_price[] = $item_name.'('. $item_quantity. ')' ;
     $tota_item_price_display = $item_quantity * $item_price;
     $total_item_price += $tota_item_price_display;
     $total_item_price_takeaway = $total_item_price; //* $_POST['takeaway'];
     $allcost = $total_item_price_takeaway + $location + $takeaway;
}

$satus = 'pendding';
$total_item = implode(', ',$name_price);
$details_insert = mysqli_query($conn, "INSERT INTO 
check_out(name, phone_number, location, address, discrib_house, total_item, total_price, user_id, status, num_plate, w_num)
VALUE('$name','$p_number','$location','$address','$discrib_h','$total_item','$allcost','$user_id','$satus','$num_takeaway','$w_number')");
if($details_insert){
    mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
}
if($cart_guery && $details_insert){
    $select_account_details = mysqli_query($conn, "SELECT * FROM account_number WHERE acct_num_id = 1");
    $acct_details = mysqli_fetch_assoc($select_account_details);
    $acc_number = $acct_details['acct_num'];
    $acct_name = $acct_details['acct_name'];
    $bank_name = $acct_details['bank_name'];
    $location_total_price = mysqli_query($conn, "SELECT * FROM check_out WHERE user_id='$user_id'");
    while($run_location_total_price = mysqli_fetch_assoc($location_total_price)){
        $all_cost = number_format($run_location_total_price['total_price']);
    }
    echo "
    <selection class='edit-form-container'>
               <div class='container bg-dark divselect'>
               <h3 style='color:white;'>Payment method: Bank transfer</h>
               <div class='container bg-white divselect'>
               <h5 style='color:dake;'>Bank name: <small style='color: blue;'>$bank_name</small></h5>
               <h5 style='color:dake;'>Bank account name: <small style='color: blue;'>$acct_name</small></h5>
               <h5 style='color:dake;'>Bank account number: <small style='color: blue;'>$acc_number</small></h5>
               <h5 style='color:dake;'>Total cost: <small style='color: blue;'>&#8358;$all_cost</small></h5>
               <a href='carryout.php' class='paymentlink'>Payment sent</a>
               </div>
               </div>
           </selection>
    ";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bukolary's Kitchin</title>
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

    <style>
select {
  width: 100%;
  padding: 9px 15px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.edit-form-container{
    position: fixed;
    top:0; left:0; 
    z-index: 1100;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
}
.divselect{
    padding: 25px;
}
.paymentlink{
  background-color: blue;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 2px;
  margin-top: 10px;
}

.paymentlink:hover, a:active {
  background-color: blue;
  border-radius: 2px;
  color: white;

}
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <form action="" method="post">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="main.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Bukolary's</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <div class="navbar" >
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <?php 
                    $select_cart_row = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'");
                    $run_select_cart = mysqli_num_rows($select_cart_row);  
                    ?>
                <a href="cart.php" class="nav-item nav-link">Cart 
                    <span class="bg-primary"  style=" padding: 2px; border-radius: 2px;"><?php echo $run_select_cart  ?></span>
                </a>
                </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="main.php" class="nav-item nav-link">Home</a>
                        <a href="history.php" class="nav-item nav-link">Tracker</a>
                        <!--<a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>-->
                        <a href="menu.php" class="nav-item nav-link active">Menu</a>
                        <!--<div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>-->
                       <!-- <a href="contact.html" class="nav-item nav-link">Contact</a>-->
                    </div>
                    <a href="checkout.php" class="btn btn-primary py-2 px-4">DELIVERY</a>
                </div>
            </nav>
            
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Confirm your order</h1>
                    <?php
                    $display_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'");
                    $total = 0;
                    $grand_total = 0;
                    if(mysqli_num_rows($display_cart) > 0){
                        while($fetch_display = mysqli_fetch_assoc($display_cart)){
                            $tota_price_display = $fetch_display["cart_price"] * $fetch_display["quantity"];
                            $grand_total_display = $total += $tota_price_display;
                    ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#"><?php echo $fetch_display["cart_name"] ?>/<span> Quantity:</span> <a href="#"><?php echo $fetch_display["quantity"] ?></a></li>                            
                        </ol>
                    </nav>
                    <?php };?> 
                    <li class="breadcrumb-item"><a href="#" style="color: white;">Total cost: &#8358;<?php echo $grand_total_display; ?></a></li>                            
                    <?php }else{ ?>
                        <li class="breadcrumb-item"><a href="#">your cart is empty</a></li>
                  <?php  }; ?>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


       

        <!-- Reservation Start -->
        <div class="container py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <!--<div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div> -->
                <div class="col-md-12 bg-dark d-flex align-items-center ">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Order now</h5>
                        <h6 class="text-white mb-4" style="font-size:12px;">Order with your bank account name, Ensure your phone is available, Off DND and hold your phone close.</h6>
                        <h6 class="text-white mb-4"></h6>                        
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-floating date" data-target-input="nearest">
                                        <input type="number" name="p_number" min="0" class="form-control"  placeholder="Phone number" required>
                                        <label for="phone_number">Phone number</label>
                                    </div>
                                </div>
                                <!-- u -->
                                <div class="col-md-6">
                                    <div class="form-floating date" data-target-input="nearest">
                                        <input type="number" name="w_number" min="0" class="form-control"  placeholder="WhatsApp number" required>
                                        <label for="phone_number">WhatsApp number</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="takeaway" placeholder="Number of takeway" min="1" value='1'  required>
                                        <label for="email">Number of plate</label>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="location" required>
                                            <option value="">Select location</option>
                                            <option value="300">Phase2 - &#8358;300</option>
                                            <option value="400">School gate(Osekita, Unity) - &#8358;400</option>
                                            <option value="800">Waterhouse - &#8358;800</option>
                                            <option value="500">Yemkem(Iworoko, Gadaphy) - &#8358;500</option>
                                            <option value="600">Rd8-motif - &#8358;600</option>
                                            <option value="700">Dbar arana - &#8358;700</option>
                                            <option value="1500">ilokun - &#8358;1500</option>
                                            <option value="2000">barwa-fajuyi - &#8358;2000</option>
                                            <option value="2500">Ekute - &#8358;2500</option>
                                            <option value="3000">Abuad - &#8358;3000</option>
                                            <option value="4000">FMC ido - &#8358;4000</option>
                                        </select>
                                        <label for="select1">Location</label>
                                      </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Address" name="address" style="height: 100px" required></textarea>
                                        <label for="message">Address</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Discrib your house" name="discrib_h" style="height: 100px" required></textarea>
                                        <label for="message">Discrib your house</label>
                                    </div>
                                </div>-->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="order">Order now</button>
                                </div>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
     </form>

        <!-- <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                        16:9 aspect ratio -->
                       <!--<div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         Reservation Start -->


        <!-- Team Start -->
       <!-- <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Team Members</h5>
                    <h1 class="mb-5">Our Master Chefs</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="img/team-1.jpg" alt="">
                            </div>
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="img/team-2.jpg" alt="">
                            </div>
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="img/team-3.jpg" alt="">
                            </div>
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="img/team-4.jpg" alt="">
                            </div>
                            <h5 class="mb-0">Full Name</h5>
                            <small>Designation</small>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --> 
        <!-- Team End -->


        <!-- Testimonial Start -->
        <!--<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Testimonial</h5>
                    <h1 class="mb-5">Our Clients Say!!!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Client Name</h5>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Client Name</h5>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Client Name</h5>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-4.jpg" style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Client Name</h5>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Testimonial End -->
        

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
							Designed By <a class="border-bottom" href="http://wa.me/2348103226226" target="_blank">ASKWEB</a><br><br>
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
    <script src="script.js"></script>
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
            echo "<script>location.href='login.php'</script>";
    } }else{
        echo "<script>location.href='login.php'</script>";
}?>