<?php
session_start();
include('../connectdb.php');

if(isset($_POST["y_con_number"])){

    if(empty($_POST["y_phone_number"])){
        echo "<script>alert('All input field are required!')</script>";
        exit();
    }

    $ph_num = htmlentities(mysqli_real_escape_string($conn, $_POST["y_phone_number"]));
    $insert = "insert into register(phone_n)
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
    }
}

?>