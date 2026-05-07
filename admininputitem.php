<?php
session_start();
if(isset($_POST['logout'])){
    session_destroy();
    echo "<script>location.href='login.php'</script>";
  }
?>

    <?php 
    if(!isset($_SESSION['user_name'])){
        echo "<script>location.href='adminlogin.php'</script>";
    }
    if($_SESSION['user_name'] == 'Bukolarys' && $_SESSION['pass'] == 'Admin0000'){
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
<?php 
include ('connectdb.php');

if(isset($_GET["remove_section"])){
    $rmove_id = $_GET["remove_section"];
    mysqli_query($conn, "DELETE FROM section WHERE section_uniquieid ='$rmove_id'");
    echo "<script>window.open('admininputitem.php', '_self')</script>";
};

if(isset($_GET['status_section'])){
    $section_status = $_GET['status_section'];
    $section_uniquieid = $_GET['section_uniquieid'];
    $update_section = mysqli_query($conn, "UPDATE section SET status = '$section_status'
    WHERE section_uniquieid = '$section_uniquieid'");
    if($update_section){
        echo "<script>alert('Edit successfull')</script>";
        echo "<script>window.open('admininputitem.php', '_self')</script>";
    }
   }
   
   if(isset($_POST['update_section'])){
    $section_name = $_POST['section_name'];
    $section_uniquieid = $_POST['section_uniquieid'];
    $update_section = mysqli_query($conn, "UPDATE section SET section_name = '$section_name'
    WHERE section_uniquieid = '$section_uniquieid'");
    if($update_section){
        echo "<script>alert('Edit successfull')</script>";
        echo "<script>window.open('admininputitem.php', '_self')</script>";
    }
   }
   
if(isset($_POST['update_menu'])){
    $menu_status = $_POST['menu_status'];
    echo $menu_status;
    $menu_status_query = mysqli_query($conn, "UPDATE menu SET menu_status = '$menu_status' WHERE menu_id = 1");
    if($menu_status_query){
        echo "<script>alert('menu updated successfull')</script>";
        echo "<script>window.open('admininputitem.php', '_self')</script>";
    }
}

if(isset($_POST['update_item'])){

    $update_item_id = $_POST['update_item_id'];
    $update_item_name = $_POST['update_item_name'];
    $update_price = $_POST['update_price'];
    $update_img = $_FILES['update_img']['name'];
    if($update_img == ""){
        $update_query = mysqli_query($conn, "UPDATE input_item SET item = '$update_item_name', price = '$update_price' WHERE item_id ='$update_item_id'");
        if($update_query){
            echo "<script>alert('updated successfull')</script>";
            echo "<script>window.open('admininputitem.php', '_self')</script>";
        
        }   
    }else{
    $update_img_tmp_name = $_FILES['update_img']['tmp_name'];
    $update_img_folder = 'uploaded_img/'.$update_img;

    $update_query = mysqli_query($conn, "UPDATE input_item SET item = '$update_item_name', price = '$update_price', image = '$update_img' WHERE item_id ='$update_item_id'");
    if($update_query){
        move_uploaded_file($update_img_tmp_name, $update_img_folder);
        echo "<script>alert('updated successfull')</script>";
        echo "<script>window.open('admininputitem.php', '_self')</script>";
    
    }
    }
};


            if(isset($_GET['edit'])){?>
              <selection class="edit-form-container">
              <?php $edit_id = $_GET['edit'];
              $edit_query = mysqli_query($conn, "SELECT * FROM input_item WHERE item_id = $edit_id");
              if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                  ?>
                  <form action="" method="post" enctype="multipart/form-data">
                    <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="100" alt="food">
                    <input type="hidden" name="update_item_id" value="<?php echo $fetch_edit['item_id']; ?>">
                    <input type="text" class="form-control box" required name="update_item_name" value="<?php echo $fetch_edit['item']; ?>">
                    <input type="number" min="0" class="form-control box" required name="update_price" value="<?php echo $fetch_edit['price']; ?>">
                    <input type="file" class="form-control box"  name="update_img" accept="image/png, image/jpg, image/jpeg">
                    <input type="submit" class="form-control box" required name="update_item" value="Update this">
                    <input type="reset" value="Cancle" id="close_edit" class="btn btn-info">                    
                  </form>
                  <?Php 
                };

              }; ?></selection>
           <?php };

if(isset($_GET['edit_section'])){?>
    <selection class="edit-form-container">
    <?php $edit_id = $_GET['edit_section'];
    $edit_query = mysqli_query($conn, "SELECT * FROM section WHERE section_uniquieid = '$edit_id'");
    if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="section_uniquieid" value="<?php echo $fetch_edit['section_uniquieid']; ?>">
          <input type="text" class="form-control box" required name="section_name" value="<?php echo $fetch_edit['section_name']; ?>">    
          <input type="submit" class="form-control box" required name="update_section" value="Update this">
          <input type="reset" value="Cancle" id="close_edit" class="btn btn-info">                    
        </form>
        <?Php 
      };

    }; ?></selection>
 <?php };
 ?>

    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
         <!--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        Spinner End -->


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
                        <!--<a href="menu.html" class="nav-item nav-link">Menu</a> -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                            <a href="input_section.php" class="dropdown-item">Sections</a>
                            <a href="account.php" class="dropdown-item">Account</a>
                            <a href="location.php" class="dropdown-item">Location</a>
                            <a href="menustatus.php" class="dropdown-item">Menu</a>
                            <a href="takeaway.php" class="dropdown-item">Takeaway</a>
                            </div>
                        </div>
                      <!--  <a href="contact.html" class="nav-item nav-link active">Contact</a>-->
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
        <div class="container-xxl py-5">
            <div class="container">
                
                
              
                
              
                <!--<div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>-->
                    <div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="row g-3">
                        
                            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">items</h5>
                    <h1 class="mb-5">Items</h1>
                </div>
                           <?php include('inputitem.php'); ?>
                        </div>
                    </div>
                  <?php include('functions.php');  display_item() ?>
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
<?php }else{
    echo "<script>location.href='adminlogin.php'</script>";
}
?>