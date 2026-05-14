<h3 class="text-center text-success">contact list</h3>
<table class="table table-bordered mt-3 border-dark">
<thead class="table-dark text-light text-center">
<!--php code-->
<?php
$get_users="select * from `contact_from`";
$result=mysqli_query($con,$get_users);
$row_count=mysqli_num_rows($result);
echo "<tr>
        <th>Sl no.</th>
        <th>user name</th>
        <th>user email</th>
        <th>user mobile no.</th>
        <th>messages</th>
        <th>delete</th>
    </tr>
</thead>
<tbody class='text-center'>";
if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No contact list yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $contact_id=$row_data['contact_id'];
        $username=$row_data['username'];
        $email=$row_data['email'];
        $user_mobile=$row_data['user_mobile'];
        $messages=$row_data['messages'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td>$username</td>
        <td>$email</td>
        <td>$user_mobile</td>
        <td>$messages</td>
        <td><a href='indax.php?delete_cont_mess=$contact_id' type='button' class='' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./indax.php?contact_list" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="indax.php?delete_cont_mess=<?php echo $contact_id; ?>" class="text-light text-decoration-none">yes</a></button>
      </div>
    </div>
  </div>
</div>