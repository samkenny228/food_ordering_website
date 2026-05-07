<?php
session_start();
include('overall_link.php');



if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
  $url="https://";
}else{
  $url="https://";
  $url.=$_SERVER['HTTP_HOST'];
  $url.=$_SERVER['REQUEST_URI'];
  $_url;

}
$page=$url;
$sec="180";
if(isset($_POST['logout'])){
    session_destroy();
    echo "<script>location.href='adminlogin.php'</script>";
  }
include_once('connectdb.php');
if(isset($_POST['login'])){
    if($_POST['user_name'] == 'Bukolarys' && $_POST['password'] == 'Admin0000'){
        $_SESSION['user_name']= $_POST["user_name"];
        $_SESSION['pass']=$_POST['password'];
        echo "<script>location.href='admindisplayorder.php'</script>";
    }
}?>

    <?php 
    if(!isset($_SESSION['user_name'])){
        echo "<script>location.href='adminlogin.php'</script>";
    }
    if($_SESSION['user_name'] == 'Bukolarys' && $_SESSION['pass'] == 'Admin0000'){

        if(isset($_GET['view_more'])){
            $order_id = $_GET['view_more'];
            $select_checkout_detailes = mysqli_query($conn, "SELECT * FROM check_out WHERE order_id = '$order_id'");
            $fetch_checkout_detailes = mysqli_fetch_assoc($select_checkout_detailes);
            $name = $fetch_checkout_detailes['name'];
            $phone_number  = $fetch_checkout_detailes['phone_number'];
            $location = $fetch_checkout_detailes['location'];
            $address = $fetch_checkout_detailes['address'];
            $note = $fetch_checkout_detailes['discrib_house'];
            $total_item = $fetch_checkout_detailes['total_item'];
            $total_price = $fetch_checkout_detailes['total_price'];
            $datetime = $fetch_checkout_detailes['datetime'];
            $status = $fetch_checkout_detailes['status'];
            $takeaway_size = $fetch_checkout_detailes['takeaway_size'];
            $payment_method = $fetch_checkout_detailes['payment_method'];
            ?>
<form>
      <selection class='edit-form-container_admin'>
      <div class='container bg-dark indiv_admin'>
      <a href="admindisplayorder.php" class='delivery_or_pickup'>cancle</a><br><br>
      <h5 class='h_confirm_num'>Order Detailes</h5><br>
      <div style="overflow-x: auto; height: 400px; font-size:11px; padding-right: 40px; padding-right: 20px;">
      <p style="color:white; margin:0px;"><span>Name:</span><span style="float:right;"><?=$name?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Phone Number:</span><span style="float:right;"><?=$phone_number?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Location price:</span><span style="float:right;">&#8358;<?= number_format($location)?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Address:</span><span style="float:right;"><?=$address?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Note:</span><span style="float:right;"><?=$note?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Total item:</span><span style="float:right;"><?=$total_item?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Total price:</span><span style="float:right;">&#8358;<?= number_format($total_price)?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Date time:</span><span style="float:right;"><?=$datetime?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Pack:</span><span style="float:right;"><?=$takeaway_size?></span></p><hr>
      <p style="color:white; margin:0px;"><span>Payment method:</span><span style="float:right;"><?=$payment_method?></span></p>
      </div>
      </div>
      </selection> 
</form>
    <?php }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="<?php echo $sec; ?>" URL="<?php echo $page; ?>">
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var commentCount = 5;
            $("button").click(function() {
                commentCount = commentCount + 5;
                $("#loadComment").load("commentFile.php", {
                    commentNewCount : commentCount
                });
            });
        });
    </script>

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
.edit-form-container form{
    width: 30rem;
    border-radius: .5rem;
    background-color: white;
    text-align: center;
    padding: 1rem;
}
.edit-form-container form .box{
    width: 100%;
    background-color: var(--bg-color);
    border-radius: .5rem;
    margin: 1rem 0;
    font-size: 0.9rem;
    color: var(--black);
}

</style>
</head>

<body>

    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
 
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Bukolary's Admin</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <form action="" method="post">
                    <button type="submit" name="logout" class="btn btn-primary nav-item nav">Logout</button>
                </form>
                    <div class="navbar-nav ms-auto py-0 pe-4">
                         <a href="admininputitem.php" class="nav-item nav-link">Items</a>
                        <a href="items.php" class="nav-item nav-link">Input Items</a>
                        <!--<a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>-->
                        <!--<a href="menu.html" class="nav-item nav-link">Menu</a>-->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                            <a href="account.php" class="dropdown-item">Account</a>
                            <a href="location.php" class="dropdown-item">Location</a>
                            <a href="menustatus.php" class="dropdown-item">Menu</a>
                            <a href="takeaway.php" class="dropdown-item">Takeaway</a>
                               <!-- <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a> -->
                            </div>
                        </div>
                        <!--<a href="contact.html" class="nav-item nav-link active">Contact</a>-->
                    </div>
                    <a href="admindisplayorder.php" class="btn btn-primary py-2 px-4">Display order</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark mb-5">
                <!--<div class="container text-center my-5 pt-5 pb-4">
                   <h1 class="display-3 text-white mb-3 animated slideInDown">Contact Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>--> 
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Contact Start -->
        <div class="container-fluid py-5">
            <div class="container-fluid">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Order Items</h5>
                    <h1 class="mb-5">Orders</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                        <?php 
    
    $query = "SELECT * FROM check_out ORDER BY order_id DESC LIMIT 9";
    $sql = mysqli_query($conn, $query);

    if(isset($_GET['order_id']) && isset($_GET['status'])){
      $order_id = $_GET['order_id'];
      $status = $_GET['status'];

      mysqli_query($conn, "update check_out set status='$status' where order_id='$order_id'");
      echo "<script>window.open('admindisplayorder.php', '_self')</script>";

    }


    ?>
            <div class="col-md-12">
            <div class="wow fadeInUp" data-wow-delay="0.2s" id="loadComment">
                <div style="overflow-x: auto;">
            <table>
                <tr>
                <!--<th>Number of plate</th> -->
                <th>Buyer name</th>
                <th>Phone numbe</th>
                <th>WhatsAapp number</th>
                <th>Location</th>
                <th>Address</th>
                <th>Add note</th>
                <th>Items</th>
                <th>Pack</th>
                <th>Total Price</th>
                <th>Payment method</th>
                <th>Status</th>
                <th>Status</th>
                <th>Print</th>
                <th>Date and time</th>
                <th>View more</th>
                <!--<th>Delete</th>
                <th>Edit</th>-->
            </tr>
            <?php
            $i = 1;
if(mysqli_num_rows($sql) > 0){
        while($row_run_select = mysqli_fetch_assoc($sql)){ ?>
        
<form action="print.php" method="post">
    <?php
            $order_id = $row_run_select['order_id'];
            $name = $row_run_select['name'];
            $phone_number = $row_run_select['phone_number'];
            $location = $row_run_select['location'];
            $address = $row_run_select['address'];
            $discrib_house = $row_run_select['discrib_house'];
            $total_item = $row_run_select['total_item'];
            $takeaway_size = $row_run_select['takeaway_size'];
            $total_price = $row_run_select['total_price'];
            $status = $row_run_select['status'];
            $user_id = $row_run_select['user_id'];
            $num_plate = $row_run_select['num_plate'];
            $w_num = $row_run_select['w_num'];
            $location_id = $row_run_select['location_id'];
            $payment_method = $row_run_select['payment_method'];
            $date = $row_run_select['datetime'];

            ?>
            
            <tr>
       
                
                <!--<td><?php // echo $num_plate; ?></td> -->
                <td><?php echo $name ; ?></td>
                <td><?php echo $phone_number; ?></td>
                <td><?php echo $w_num; ?></td>
               
                <td><?php
                if($location_id == "0"){
                    echo 'Pick up';
                 }

                 if($location_id != 0){
                 $select_location = mysqli_query($conn, "SELECT * FROM location WHERE id_location = '$location_id'");
                 $fetch_location = mysqli_fetch_assoc($select_location);
                 if($fetch_location > 0){
                 $location_name = $fetch_location['place'];
                 echo $location_name;
                 }else {
                    echo 'Location delelted';
                 }
                 }
                 ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $discrib_house; ?></td>
                <td><?php echo $total_item; ?></td>
                <td><?php echo $takeaway_size; ?></td>
                <td>&#8358;<?php echo number_format($total_price); ?></td>
                <td><?php echo $payment_method; ?></td>
                <td><?php
                 if($status == 'payment_recived'){
                    echo '<span style="color:white; background-color:rgb(255, 145, 0); border-radius:5px; padding:10px;">confirmed</span>';
                 } 
                 if($status == 'order_sent'){
                    echo '<span style="color:white; background-color:blue; border-radius:5px; padding:10px;">OrderSent</span>';
                 } 
                 if($status == 'pendding'){
                    echo '<span style="color:white; background-color:red; border-radius:5px; padding:10px;">Pending</span>';
                 } 
                 if($status == 'cancle'){
                    echo '<span style="color:white; background-color:red; border-radius:5px; padding:10px;">Canceled</span>';
                 }
                 if($status == '1'){
                    echo '<span style="color:red;">Order Recieved</span>';
                 } 
                 if($status == '2'){
                    echo '<span style="color:green;">Payment confirmed</span>';
                 } 
                 if($status == '3'){
                    echo '<span>Order Is Being Processed</span>';
                 } 
                 if($status == '4'){
                    echo '<span style="color:orange;">Waitting For Rider</span>';
                 } 
                 if($status == '5'){
                    echo '<span style="color:blue;">Rider Picked Up Order</span>';
                 } 
                 ?></td>
                <td>
                <?php  if($status == 'cancle'){
                echo '<span style="color:white; background-color:red; border-radius:5px; padding:10px;">Canceled</span>';
                 }else{ ?>
 <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $order_id ?>')">
    <option value="">Status</option>
    <option value="1">Order Recieved</option>
    <option value="2">Payment confirmed</option>
    <option value="3">Order Is Being Processed</option>
    <option value="4">Waitting For Rider</option>
    <option value="5">Rider Picked Up Order</option>
  </select>
  <?php  } ?>
 </td>

    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
 <td><button class="btn btn-success py-2 px-4" name="print_order">Print</button></td>
 <!-- <td><a href="admininputitem.php?delete=<?php // echo $item_id ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this');">Delete</a></td>
 <td><a href="admininputitem.php?edit=<?php // echo $item_id ?>" class="btn btn-info">Edit</a></td>-->
            <td><?=$date?></td>
            <td><a href="admindisplayorder.php?view_more=<?=$order_id?>">View more</a></td>
            </tr></form>
            <?php } ?>
            </table>
            </div>
            </div>
            </div> 
        
         <button class="btn btn-success py-2 px-4">SHOW MORE ORDERS</button>
<script type="text/javascript">
  function status_update(value,order_id){
     //alert(item_id);
     let url = "admindisplayorder.php"
     window.location.href = url+"?order_id="+order_id+"&status="+value;
  }
</script>
   <?php 
   };
?> 
                            <!--<div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Booking</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>book@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">General</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Technical</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>tech@example.com</p>
                            </div>-->
                        </div>
                    </div>
                    <!--<div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>-->
                    <!--<div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="item" placeholder="Name" required>
                                            <label for="name">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="price" placeholder="Price" min="1" required>
                                            <label for="email">Price</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="file" class="form-control" name="image" placeholder="Picture" required accept="image/png, image/jpg, image/jpeg">
                                            <label for="subject">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Upload item</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>-->
                 
                </div>
            </div>
        </div>
        <!-- Contact End -->


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
							Designed By <a class="border-bottom" href="">ASKWEB</a><br><br>
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
<?php 
 }else{ 
    echo "<script>location.href='adminlogin.php'</script>";
} ?>