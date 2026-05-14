<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-1 border-dark">
    <thead class="table-dark text-light text-center">
        <tr>
            <th>Sl no.</th>
            <th>category title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        $select_cat="select * from `Brands`";
        $result=mysqli_query($con,$select_cat);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $Brands_id=$row['Brands_id'];
            $Brands_title=$row['Brands_title'];
            $number++;
            echo "<tr>
            <td>$number</td>
            <td>$Brands_title</td>
            <td><a href='indax.php?edit_Brands=$Brands_id' class=''><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='indax.php?delete_Brands=$Brands_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?view_brands" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_Brands=<?php echo $Brands_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>