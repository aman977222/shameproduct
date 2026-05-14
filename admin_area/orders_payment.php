<h3 class="text-center text-success">All payment</h3>
<table class="table table-bordered mt-3 border-dark">
<thead class="table-dark text-light text-center">
<!--php code-->
<?php
$get_payment="select * from `user_payments`";
$result=mysqli_query($con,$get_payment);
$row_count=mysqli_num_rows($result);
echo "<tr>
        <th>Sl no.</th>
        <th>Invoice number</th>
        <th>Amount</th>
        <th>payment_mode</th>
        <th>Order Date</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class='text-center'>";
if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No payment received yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $payment_id=$row_data['payment_id'];
        $invoice_number=$row_data['invoice_number'];
        $amount=$row_data['amount'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$invoice_number/-</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
        <td><a href='indax.php?delete_payment=$payment_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?orders_payment" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_payment=<?php echo $payment_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>