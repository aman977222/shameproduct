<?php

include('../includes/connect.php');
include('../function/common_function.php');

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    
}

//getting total items and total price of all items
$get_ip_add=getIPAddress();
$total_price=0;
$cart_query_price="Select * from `cart_detalis` where ip_address='$get_ip_add'";
$result_cart_price=mysqli_query($con,$cart_query_price);
$invoke_number=mt_rand();
$status='pending';
$count_products=mysqli_num_rows($result_cart_price);
while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_product="Select * from `products` where product_id='$product_id'";
    $run_price=mysqli_query($con,$select_product);
    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['product_price']);
        $product_values=array_sum($product_price);
        $total_price+=$product_values;
    }
}

//getting quantity from cart
$get_cart="Select * from `cart_detalis`";
$run_cart=mysqli_query($con,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quanthy'];
if($quantity==0){
    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}

$insert_order="Insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$subtotal,$invoke_number,$count_products,NOW(),'$status')";
$result_query=mysqli_query($con,$insert_order);
if($result_query){
    echo "<script>alert('order successfully placed')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

// order pending
$insert_pending_order="Insert into `order_pending` (user_id,invoice_number,product_id,quanthy,order_status) values ($user_id,$invoke_number,$product_id,$quantity,'$status')";
$result_pending=mysqli_query($con,$insert_pending_order);

//delete items from cart
$empty_cart="Delete from `cart_detalis` where ip_address='$get_ip_add'";
$result_empty=mysqli_query($con,$empty_cart);
?>