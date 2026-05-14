<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view products</title>
    <style>
      .poduct_img{
    width: 100px;
    height: 100px;
}
      </style>
</head>
<body>
    <h3 class="text-center text-success">All products</h3>
    <table class="table table-bordered border-dark">
        <thead class="table-dark text-light">
            <tr>
                <th>Product ID</th>
                <th>Product title</th>
                <th>Product Image</th>
                <th>Product price</th>
                <th>Total sold</th>
                <th>status</th>
                <th>date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-light text-black">
            <?php
            $get_products="select * from `products`";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_Image1=$row['product_Image1'];
                $product_price=$row['product_price'];
                $date=$row['date'];
                $status=$row['status'];
                $number++;
                ?>
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $product_title; ?></td>
                <td><img src='./product_images/<?php echo $product_Image1; ?>' class='poduct_img'></td>
                <td><?php echo $product_price; ?>/-</td>
                <td><?php
                $get_count="select * from `order_pending` where product_id=$product_id";
                $result_count=mysqli_query($con,$get_count);
                $rows_count=mysqli_num_rows($result_count);
                echo $rows_count;
                ?>
                </td>
                <td><?php echo $status; ?></td>
                <td><?php echo $date; ?></td>
                <td><a href='indax.php?edit_product=<?php echo $product_id ?>' class=''><i class='fa-solid fa-pen-to-square'></i></a></td>
               <td><a href='indax.php?delete_product=$product_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?view_products" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_product=<?php echo $product_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>
    
</body>
</html>