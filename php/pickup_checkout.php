<?php
include('../user_id.php');
include('../overall_link.php');
if(isset($_POST["name"])){   
$name = $_POST["name"];
$p_number = $_POST["p_number"];
$location_id = 0;
$location = 0;
$address = "PICK UP";
$discrib_h = $_POST["discrib_h"];
$takeaway = 300 * $_POST['takeaway'];
$num_takeaway = $_POST['takeaway'];
$w_number = $_POST['w_number'];
$pay_method = $_POST['pay_method'];


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
     $total_item_price_takeaway = $total_item_price; // *$_POST['takeaway'];
     $allcost = $total_item_price_takeaway + $takeaway;
}
$satus = 'pendding';
$total_item = implode(', ',$name_price);


$select_account_details = mysqli_query($conn, "SELECT * FROM account_number WHERE acct_num_id = 1");
$acct_details = mysqli_fetch_assoc($select_account_details);
$acc_number = $acct_details['acct_num'];
$acct_name = $acct_details['acct_name'];
$bank_name = $acct_details['bank_name'];
$all_cost = number_format($total_item_price_takeaway + $takeaway);

/*if($pay_method == "transfer"){
echo "
<selection class='edit-form-container'>
           <div class='container bg-dark divselect'>
           <h3 style='color:white;'>Payment method: Bank transfer</h>
           <div class='container bg-white divselect'>
           <h5 style='color:dake;'>Bank name: <small style='color: blue;'>$bank_name</small></h5>
           <h5 style='color:dake;'>Bank account name: <small style='color: blue;'>$acct_name</small></h5>
           <h5 style='color:dake;'>Bank account number: <small style='color: blue;'>$acc_number</small></h5>
           <h5 style='color:dake;'>Total cost: <small style='color: blue;'>&#8358;$all_cost</small></h5>
           <a href='history.php' class='paymentlink'>Payment sent</a>
           </div>
           </div>
       </selection>
";
}elseif($pay_method == "cash"){
    echo "
<selection class='edit-form-container'>
           <div class='container bg-dark divselect'>
           <h3 style='color:white;'>Payment method: Cash</h>
           <div class='container bg-white divselect'>
           <h5 style='color:dake;'>Note that: <small style='color: blue;'>Rider won't be holding any cash for change</small></h5>
           <h5 style='color:dake;'>Total cost: <small style='color: blue;'>&#8358;$all_cost</small></h5>
           <a href='history.php' class='paymentlink'>Payment sent</a>
           </div>
           </div>
       </selection>
";
}
*/



$details_insert = mysqli_query($conn, "INSERT INTO 
check_out(name, phone_number, location, address, discrib_house, total_item, total_price, user_id, status, num_plate, w_num, location_id, payment_method)
VALUE('$name', '$p_number','$location','$address','$discrib_h','$total_item','$allcost','$user_id','$satus','$num_takeaway','$w_number','$location_id','$pay_method')");
if($details_insert){
   $order_sent = mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
   if($order_sent){
   echo "<script>alert('Order sent successfull')</script>";
   echo "<script>window.open('history.php', '_self')</script>";
   }
}else{
    echo "<script>alert('Something went wrong, try again')</script>";
    exit();
}

}
}

?>