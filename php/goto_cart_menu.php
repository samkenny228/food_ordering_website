<?php
include('../user_id.php');
include('../overall_link.php');
if(isset($_POST['cart_btn'])){
        $select_pack = mysqli_query($conn, "SELECT * FROM packs WHERE user_id ='$user_id'");
        while($fetch_pack = mysqli_fetch_assoc($select_pack)){ 
                $pack_uniquieid = $fetch_pack["pack_uniquieid"];
    
                $select_cart_pack = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' and pack_uniquieid = '$pack_uniquieid'");
                $select_cart_pack_num = mysqli_num_rows($select_cart_pack);
                
                if($select_cart_pack_num == 0){
                    echo "<input value='$pack_uniquieid'>";
                }
                }
}
?>