<?php 
if(isset($_POST["btn_add_pack"])){
    $takeaway_num =  1 + $_POST['num_takeaway']; ?>
    <input type="hidden" class="num_takeaway" value="<?= $takeaway_num ?>"><?= $takeaway_num; ?>
    <?php
}
?>


<?php 
if(isset($_POST["btn_minus_pack"])){
    if($_POST['num_takeaway'] > 1){
    $takeaway_num = $_POST['num_takeaway'] - 1  ?>
    <input type="hidden" name="num_takeaway" class="num_takeaway" value="<?= $takeaway_num ?>"><?= $takeaway_num; ?>
    <?php
    }else{ ?>
    <input type="hidden" name="num_takeaway" class="num_takeaway" value="1">1
    <?php }
}
?>
<!-- 2 takeaway -->
<?php 
if(isset($_POST["btn_add_pack2"])){
    $takeaway_num =  1 + $_POST['num_takeaway2']; ?>
    <input type="hidden" name="num_takeaway2" class="num_takeaway2" value="<?= $takeaway_num ?>"><?= $takeaway_num; ?>
    <?php
}
?>


<?php 
if(isset($_POST["btn_minus_pack2"])){
    if($_POST['num_takeaway2'] > 1){
    $takeaway_num2 = $_POST['num_takeaway2'] - 1  ?>
    <input type="hidden" name="num_takeaway2" class="num_takeaway2" value="<?= $takeaway_num2 ?>"><?= $takeaway_num2; ?>
    <?php
    }else{ ?>
    <input type="hidden" name="num_takeaway2" class="num_takeaway2" value="1">1
    <?php }
}
?>

<!-- 3 takeaway -->
<?php 
if(isset($_POST["btn_add_pack3"])){
    $takeaway_num =  1 + $_POST['num_takeaway3']; ?>
    <input type="hidden" name="num_takeaway3" class="num_takeaway3" value="<?= $takeaway_num ?>"><?= $takeaway_num; ?>
    <?php
}
?>


<?php 
if(isset($_POST["btn_minus_pack3"])){
    if($_POST['num_takeaway3'] > 1){
    $takeaway_num3 = $_POST['num_takeaway3'] - 1  ?>
    <input type="hidden" name="num_takeaway3" class="num_takeaway3" value="<?= $takeaway_num3 ?>"><?= $takeaway_num3; ?>
    <?php
    }else{ ?>
    <input type="hidden" name="num_takeaway3" class="num_takeaway3" value="1">1
    <?php }
}
?>


<!-- 4 takeaway -->
<?php 
if(isset($_POST["btn_add_pack4"])){
    $takeaway_num =  1 + $_POST['num_takeaway4']; ?>
    <input type="hidden" name="num_takeaway4" class="num_takeaway4" value="<?= $takeaway_num ?>"><?= $takeaway_num; ?>
    <?php
}
?>


<?php 
if(isset($_POST["btn_minus_pack4"])){
    if($_POST['num_takeaway4'] > 1){
    $takeaway_num4 = $_POST['num_takeaway4'] - 1  ?>
    <input type="hidden" name="num_takeaway4" class="num_takeaway4" value="<?= $takeaway_num4 ?>"><?= $takeaway_num4; ?>
    <?php
    }else{ ?>
    <input type="hidden" name="num_takeaway4" class="num_takeaway4" value="1">1
    <?php }
}
?>

<!-- 5  takeaway -->
<?php 
if(isset($_POST["btn_add_pack5"])){
    $takeaway_num5 =  1 + $_POST['num_takeaway5']; ?>
    <input type="hidden" name="num_takeaway5" class="num_takeaway5" value="<?= $takeaway_num5 ?>"><?= $takeaway_num5; ?>
    <?php
}
?>


<?php 
if(isset($_POST["btn_minus_pack5"])){
    if($_POST['num_takeaway5'] > 1){
    $takeaway_num5 = $_POST['num_takeaway5'] - 1  ?>
    <input type="hidden" name="num_takeaway5" class="num_takeaway5" value="<?= $takeaway_num5 ?>"><?= $takeaway_num5; ?>
    <?php
    }else{ ?>
    <input type="hidden" name="num_takeaway5" class="num_takeaway5" value="1">1
    <?php }
}
?>