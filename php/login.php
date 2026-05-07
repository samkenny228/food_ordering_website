<?php 
session_start();
include('../overall_link.php');
?>
<script src="js/yn_con_number.js"></script>
<?php
include('../connectdb.php');
if(isset($_POST['phone_number'])){
    
    if(empty($_POST["phone_number"])){
        echo "<script>alert('All input field are required!')</script>";
        exit();
    }

    $ph_num = htmlentities(mysqli_real_escape_string($conn, $_POST["phone_number"]));

    if(!preg_match('/^[0-9]*$/',$ph_num)){
        echo "<script>alert('Phone number be number!')</script>";
        exit();
    }

    if(strlen($ph_num) < 11 or strlen($ph_num) > 11){
        echo "<script>alert('Invalid phone number')</script>";
        exit();
    }

    $select_user = "select * from register where  phone_n = '$ph_num'";
    $query = mysqli_query($conn, $select_user);
    $check_user = mysqli_num_rows($query);

    if($check_user == 1){
        $_SESSION["phone_number"] = $ph_num;  
        $ph_num = $_SESSION['phone_number'];
        echo "<script>window.open('main.php', '_self')</script>";
    }else{ 
        $insert = "insert into register(phone_n)
        values('$ph_num')";
        $query = mysqli_query($conn, $insert);
        $_SESSION["phone_number"] = $ph_num;  
        echo "<script>alert('register successfull')</script>"; 
        echo "<script>window.open('main.php', '_self')</script>";
        ?>
        
       <!-- <selection class='edit-form-container'>
        <div class='container bg-dark divselect'>

        <h5 class='h_confirm_num'>Confirm your phone number: </h5>
        <p class='p_con_number'><?= $ph_num ?></p>

        <form method="post" action="" id="yn_login_form" enctype="multipart/form-data">
        <input type="hidden" name="y_phone_number" class="y_phone_number" value="<?= $ph_num ?>">
        <button type="submit" name="y_con_number" class='ans_con_number y_con_number'>Yes</button> 
        <button type="submit" name="n_con_number" class='ans_con_number n_con_number'>No</button>
        </form>

        </div>
        </selection> -->

    <?php
      /*  $insert = "insert into register(phone_n)
        values('$ph_num')";
        $query = mysqli_query($conn, $insert);
        if($query){
            $_SESSION["phone_number"] = $ph_num;  
            $ph_num = $_SESSION['phone_number'];
            echo "<script>alert('register successfull')</script>";
            echo "<script>window.open('main.php', '_self')</script>";  
        }else{
            echo "<script>alert('insert unsuccessfull, try again')</script>";
            echo "<script>window.open('index.php', '_self')</script>";  
        } */
    }
}

if(isset($_POST["y_con_number"])){
    echo "<script>alert('Phone number be number!')</script>";
}
?>