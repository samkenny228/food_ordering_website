<?php 
include('../user_id.php');
include('../overall_link.php');
   if(isset($_POST['pack_num'])){
   $pack_num = htmlentities(mysqli_real_escape_string($conn, $_POST['pack_num']));
   $select_takeaway = htmlentities(mysqli_real_escape_string($conn, $_POST['select_takeaway']));
   $num_takeaway = htmlentities(mysqli_real_escape_string($conn, $_POST['num_takeaway']));
   $pack_uniquieid = rand(111, 9999);
   $save_pack = mysqli_query($conn, "insert into packs(pack_num, select_takeaway, num_takeaway, user_id, pack_uniquieid)
   values('$pack_num', '$select_takeaway', '$num_takeaway', '$user_id', '$pack_uniquieid')");
   }

   if(isset($_POST['pack_num2'])){
      $pack_num2 = htmlentities(mysqli_real_escape_string($conn, $_POST['pack_num2']));
      $select_takeaway2 = htmlentities(mysqli_real_escape_string($conn, $_POST['select_takeaway2']));
      $num_takeaway2 = htmlentities(mysqli_real_escape_string($conn, $_POST['num_takeaway2']));
      $pack_uniquieid2 = rand(111, 9999);
      $save_pack2 = mysqli_query($conn, "insert into packs(pack_num, select_takeaway, num_takeaway, user_id, pack_uniquieid)
      values('$pack_num2', '$select_takeaway2', '$num_takeaway2', '$user_id', '$pack_uniquieid2')");
   }

   if(isset($_POST['pack_num3'])){
      $pack_num3 = htmlentities(mysqli_real_escape_string($conn, $_POST['pack_num3']));
      $select_takeaway3 = htmlentities(mysqli_real_escape_string($conn, $_POST['select_takeaway3']));
      $num_takeaway3 = htmlentities(mysqli_real_escape_string($conn, $_POST['num_takeaway3']));
      $pack_uniquieid3 = rand(111, 9999);
      $save_pack3 = mysqli_query($conn, "insert into packs(pack_num, select_takeaway, num_takeaway, user_id, pack_uniquieid)
      values('$pack_num3', '$select_takeaway3', '$num_takeaway3', '$user_id', '$pack_uniquieid3')");
   }

   if(isset($_POST['pack_num4'])){
      $pack_num4 = htmlentities(mysqli_real_escape_string($conn, $_POST['pack_num4']));
      $select_takeaway4 = htmlentities(mysqli_real_escape_string($conn, $_POST['select_takeaway4']));
      $num_takeaway4 = htmlentities(mysqli_real_escape_string($conn, $_POST['num_takeaway4']));
      $pack_uniquieid4 = rand(111, 9999);
      $save_pack4 = mysqli_query($conn, "insert into packs(pack_num, select_takeaway, num_takeaway, user_id, pack_uniquieid)
      values('$pack_num4', '$select_takeaway4', '$num_takeaway4', '$user_id', '$pack_uniquieid4')");
   }

   if(isset($_POST['pack_num5'])){
      $pack_num5 = htmlentities(mysqli_real_escape_string($conn, $_POST['pack_num5']));
      $select_takeaway5 = htmlentities(mysqli_real_escape_string($conn, $_POST['select_takeaway5']));
      $num_takeaway5 = htmlentities(mysqli_real_escape_string($conn, $_POST['num_takeaway5']));
      $pack_uniquieid5 = rand(111, 9999);
      $save_pack5 = mysqli_query($conn, "insert into packs(pack_num, select_takeaway, num_takeaway, user_id, pack_uniquieid)
      values('$pack_num5', '$select_takeaway5', '$num_takeaway5', '$user_id', '$pack_uniquieid5')");
   }

   if($save_pack or $save_pack2 or $save_pack3 or $save_pack4 or $save_pack5){ ?>

      <selection class='edit-form-container'>
      <div class='container bg-dark divselect'>
      <h5 class='h_confirm_num'>PROCEED TO</h5>
      <h5></h5><br>
      <a href="menu.php?puid=<?=$pack_uniquieid?>" class='delivery_or_pickup'>DELIVERY</a> or <a href="pickup_menu.php" class='delivery_or_pickup'>PICK UP</a><br><br>
      </div>
      </selection>
    <?php 
    }
?>