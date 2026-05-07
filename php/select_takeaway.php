<?php 
include('../user_id.php');
include('../overall_link.php'); ?>
<script src="js/select_takeaway.js" crossorigin="anonymous"></script>
<?php
if(isset($_POST["takeaway_id"])){
    $select_takeaway = $_POST["takeaway_id"];
    $pack_uniquieid = $_POST["pack_uniquieid"];
    echo $select_takeaway;
    $update_pack =  mysqli_query($conn, "UPDATE packs SET select_takeaway = '$select_takeaway' WHERE pack_uniquieid ='$pack_uniquieid'");
}



                            $select_pack = mysqli_query($conn, "SELECT * FROM packs WHERE user_id ='$user_id'");
                            $pack_num = mysqli_num_rows($select_pack);
                            if($pack_num < 1){
                                echo "<script>window.open('pack.php', '_self')</script>";
                            }
                            $id = 1;
                            while($fetch_pack = mysqli_fetch_assoc($select_pack)){
                              $pack_uniquieid =  $fetch_pack['pack_uniquieid'];
                              $num_takeaway = $fetch_pack['num_takeaway']; 	
                              $select_takeawayid = $fetch_pack['select_takeaway']; 	

                              $select_takeaway = mysqli_query($conn, "SELECT * FROM takeaway WHERE takeaway_uniquieid = '$select_takeawayid'");
                              $fetch_takeaway = mysqli_fetch_assoc($select_takeaway);

                              $select_cart =  mysqli_query($conn, "SELECT * FROM cart WHERE pack_uniquieid = '$pack_uniquieid'");
                              $num_cart = mysqli_num_rows($select_cart);
                            ?>
                            <form action="" method="GET"  enctype="multipart/form-data">
<div class="pask_div" style="background-color: rgba(255, 255, 255, 0.03); color:black; border:1px solid rgba(255, 255, 255, 0.205)">
<p class="pack_para1" style="color:white; padding-top:10px;">
<span><a href="cart.php?puid=<?=$pack_uniquieid?>"><i class="fa-solid fa-eye"></i></a></span>
<span style="float:right;"><a href="menu.php?puid=<?=$pack_uniquieid?>"><i class="fa-solid fa-cart-plus"></i></a></span>
</p>

<p style="color:rgba(255, 255, 255, 0.71); margin-top:10px;">
<span>PACK <?=$id++?></span>
<span style="float:right; color:rgba(255, 255, 255, 0.518); font-size:10px; padding-top:6px;">
<?php if($num_cart > 0){echo 'Loaded';}else{echo 'Empty';}  ?>
</span> <br>
<p style="background-color:rgba(255, 255, 255, 0.12); color:rgba(255, 255, 255, 0.71); border-radius:10px; padding:10px; font-size:12px;">
<span>
<?php
while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    echo $fetch_cart['quantity'].'x '. $fetch_cart['cart_name'];
    ?>
<span style="float:right; font-size: 11px;">
&#8358;<?=$fetch_cart['cart_price']; ?>
</span><br>
    <?php
};
?>
</span>
</p>
<span style="color:rgba(255, 255, 255, 0.71);">Pack options</span>
<p style="background-color:rgba(255, 255, 255, 0.12); color:rgba(255, 255, 255, 0.71); border-radius:10px; padding:10px; font-size:12px;"> 
    <span>
    <?php 
    $select_takeaway = mysqli_query($conn, "SELECT * FROM takeaway");
    if(mysqli_num_rows($select_takeaway) > 0){
        while($takeaway = mysqli_fetch_assoc($select_takeaway)){ ?>

       <button name="takeaway_id" class="takeaway_id" value="<?=$takeaway['takeaway_uniquieid']?>" style="background-color:rgba(255, 255, 255, 0.6); border:1px solid rgba(255, 255, 255, 0.6); border-radius:15px; margin-bottom:8px; width:120px;">
        <?= $takeaway['dis_takeaway']?> <span style="font-size:8px">&#8358;<?= $takeaway['takeaway_price']; ?> </span>
       </button>
        <span style="float:right; color: white; font-size: 10px; padding-top:5px;">
            <?php
            if($select_takeawayid == $takeaway['takeaway_uniquieid']){
            ?>
            <i class="fa-solid fa-check"></i>
            <?php } ?>
        </span><br>
        <?php }
    }
    ?>
    </span>

</p>
<span style="color:rgba(255, 255, 255, 0.71);">Delete</i></span>
<span style="float:right; margin-top:4px;">
<a href="checkout.php?puid=<?=$pack_uniquieid?>&premove=premove" onclick="return confirm('remove item from cart');">
<i class="fa-solid fa-trash"></i>
</a>
</span>
</p>

</div>
                            </form>
                             <?php } ?>