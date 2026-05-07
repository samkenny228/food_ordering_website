<?php
include('../user_id.php');
include('../overall_link.php');
if(isset($_POST["plus_cart_quantity"])){
    $update_id = $_POST["update_cart_id"];
    $new_quantity = $_POST["quantity"] + 1;
    $pack_for_cart = $_POST["pack_for_cart"];
    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$new_quantity' WHERE cart_id ='$update_id'");
};

if(isset($_POST["minus_cart_quantity"])){
    $pack_for_cart = $_POST["pack_for_cart"];
    if($_POST["quantity"] > 1){
    $update_id = $_POST["update_cart_id"];
    $new_quantity = $_POST["quantity"] - 1;
    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity = '$new_quantity' WHERE cart_id ='$update_id'");
}
};
?>



<?php 
$select_cart = mysqli_query($conn, "SELECT * FROM cart where user_id = '$user_id' and pack_uniquieid = '$pack_for_cart'");
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
                                <small style="color:black; background-color: rgba(0, 0, 0, 0.03); border:1px solid rgba(0, 0, 0, 0.2); border-radius:10px;">
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
<script type="text/javascript" src="js/cart_quantity_update.js"></script>