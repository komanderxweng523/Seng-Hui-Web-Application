
<link href="users/css/purchase_history.css" rel="stylesheet" />

<style>
 .order_item a{
     text-decoration:none;
     color:rgba(0,0,0,0.8);
 }  
 .download{
     float:right;
     margin:30px 15px 30px 0;
     font-size:18px;
 }
 .receipt_info_container{
     width:100%;
     float:left;
     border-bottom:0.01px solid rgba(0,0,0,0.2);
     padding:15px 0;
     margin-bottom:15px;
 }
 .receipt_info_box{
     width:100%;
     float:left;
 }
 .receipt_info_container p{
     margin:5px 0;
 }
 .receipt_info_left{
     width:50%;
     float:left;
 }
 .receipt_info_right{
     width:50%;
     float:left;
 }
 .receipt_info_right_box{
     float:right;
     text-align:right;
 }
</style>

<?php 
 $purchase_result = mysqli_query($con,"select * from payments where invoice_id='$_GET[invoice_id]' ");
 
 $fetch_payment = mysqli_fetch_array($purchase_result);
  
  
  
  $select_buyer = mysqli_query($con,"select * from users where id ='$fetch_payment[buyer_id]' ");
  
  $fetch_buyer = mysqli_fetch_array($select_buyer);
 ?>

<div class="purchase_history_container">

<h2>Invoice # <?php echo $fetch_payment['invoice_id']; ?></h2>
<hr />

<div class="receipt_info_container">
    
  <div class="receipt_info_box">
   
   <div class="receipt_info_left">
       
    <div class="receipt_info_left_box">
     <p><strong>Owner Information</strong></p> 
     <p><?php echo $fetch_buyer['email']; ?></p>
     <p><?php echo $fetch_buyer['name']; ?></p>
     <p><?php echo $fetch_buyer['user_address']; ?></p>
     <p><?php echo $fetch_buyer['IC']; ?></p>
    </div><!-- /.receipt_info_left_box -->  
       
   </div><!---/.receipt_info_left -->
    
   <div class="receipt_info_right">
       
    <div class="receipt_info_right_box">
        
     <p><strong>Pay To</strong></p> 
     <p>SengHui Co</p>
     <p><strong>Payment Method</strong></p>
     <p><?php echo $fetch_payment['payment_type'].'<br>'.$fetch_payment['type']; ?></p>
     
    </div><!-- /.receipt_info_right_box -->  
       
   </div><!---/.receipt_info_right --> 
      
  </div><!--- /.receipt_info_box -->  
  
  <div class="receipt_info_box">
   <p><strong>Invoice Date</strong></p>   
   <p><?php echo $fetch_payment['date']; ?></p>
  
  </div><!--- /.receipt_info_box -->  
  
</div><!-------/.receipt_info_container -->

<table>
    
 <thead>
   <tr>
     <th colspan="2">Item</th>
     <th>Transaction ID</th>
     <th>Ordered</th>
     <th>Quantity</th>
     <th>Price</th>
     <th>Subtotal</th>
   </tr>
 </thead> 
 
 <tr><th colspan="8"><div class="border_bottom"></div></th></tr>
 
 <?php 
 
 $total_paid = 0;
 
 $select_payment_by_invoice_id = mysqli_query($con,"select * from payments where invoice_id='$fetch_payment[invoice_id]' ");
 
 while($fetch_multi_payments = mysqli_fetch_array($select_payment_by_invoice_id)){
  
 $select_product = mysqli_query($con, "select * from products where product_id='$fetch_multi_payments[product_id]' ");
  
  $fetch_product = mysqli_fetch_array($select_product);
  
  $array_price = array($fetch_multi_payments['product_price']);
  
  $values = array_sum($array_price);
  
  $value_quantity = $values * $fetch_multi_payments['quantity'];
  
  $total_paid += $value_quantity;
  
  
 ?>
 
 <tbody>
  <tr>
    <td colspan="2" width="35%">
     <p class="order_item">
      <a href="details.php?pro_id=<?php echo $fetch_product['product_id']; ?>">
      <?php echo $fetch_product['product_title']; ?>
      </a>
     </p>
        
    </td>   
    <td><?php echo $fetch_multi_payments['tx_id']; ?></td>
    <td><?php echo $fetch_multi_payments['date']; ?></td>
    <td><?php echo $fetch_multi_payments['quantity']; ?></td>
    <td>RM<?php echo $fetch_multi_payments['product_price']; ?></td>
    <td>RM<?php echo $fetch_multi_payments['product_price'] * $fetch_multi_payments['quantity']; ?></td>
  </tr>
  
 
  
 </tbody>
 
 <?php } // End While loop ?>
 
  <tr><td colspan="8"><br></td></tr>
 
  <tr>
   <td></td>  
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td><h3>Total Paid</h3></td>
   <td><h3>RM<?php echo $total_paid ; ?></h3></td>
  </tr>
  
  <tr>
   <td colspan="7"><a href="#" class="download">Download</a></td>
  </tr>
  
  <tr><td colspan="8"><div class="border_bottom"></div></td></tr>
  
</table>
</div><!-- /.purchase_history_container -->
