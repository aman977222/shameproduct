<h3 class="text-center text-success">All orders</h3>
<table class="table table-bordered mt-3 border-dark">
<thead class="table-dark text-light text-center">
<!--php code-->
<?php
$get_orders="select * from `user_orders`";
$result=mysqli_query($con,$get_orders);
$row_count=mysqli_num_rows($result);
echo "<tr>
        <th>Sl no.</th>
        <th>Due Amount</th>
        <th>Invoice number</th>
        <th>Total products</th>
        <th>Order Date</th>
        <th>status</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class='text-center'>";
if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No order yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$amount_due/-</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$order_status</td>
        <td><a href='indax.php?delete_order=$order_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
        }
    }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?orders_list" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_order=<?php echo $order_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>