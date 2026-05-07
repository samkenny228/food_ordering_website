<?php 
include_once('connectdb.php');
$commentNewCount = $_POST["commentNewCount"];
$query = "SELECT * FROM check_out ORDER BY order_id DESC LIMIT $commentNewCount";
$sql = mysqli_query($conn, $query);
?>
<div style="overflow-x: auto;">
            <table>
                <tr>
                <!-- <th>Number of plate</th> -->
                <th>Buyer name</th>
                <th>Phone numbe</th>
                <th>WhatsAapp number</th>
                <th>Location</th>
                <th>Address</th>
                <th>Add note</th>
                <th>Items</th>
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
        

    <?php
            $order_id = $row_run_select['order_id'];
            $name = $row_run_select['name'];
            $phone_number = $row_run_select['phone_number'];
            $location = $row_run_select['location'];
            $address = $row_run_select['address'];
            $discrib_house = $row_run_select['discrib_house'];
            $total_item = $row_run_select['total_item'];
            $total_price = $row_run_select['total_price'];
            $status = $row_run_select['status'];
            $user_id = $row_run_select['user_id'];
            $num_plate = $row_run_select['num_plate'];
            $w_num = $row_run_select['w_num'];
            $location_id = $row_run_select['location_id'];
            $date = $row_run_select['datetime'];
            $payment_method = $row_run_select['payment_method'];

            ?>
            
            <tr>
       
                <!-- <td><?php //echo $num_plate; ?></td>-->
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
                <td><?php echo $total_price; ?></td>
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
 
 </td><td>
<form action="print.php" method="post">
    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
 <button type="submite" class="btn btn-success py-2 px-4" name="print_order">Print</button></form></td>
 <!-- <td><a href="admininputitem.php?delete=<?php // echo $item_id ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this');">Delete</a></td>
 <td><a href="admininputitem.php?edit=<?php // echo $item_id ?>" class="btn btn-info">Edit</a></td>-->
 <td><?=$date?></td>
 <td><a href="admindisplayorder.php?view_more=<?=$order_id?>">View more</a></td>
            </tr>
            
            <?php } ?>
            </table>
            <div style="overflow-x: auto;">
            </div>
            </div> 
        
   <?php 
   };
?>