<?php  
header("Content-Type: application/json");


// Requiring the connection
require("../includes/conn.php");


// Action
if(isset($_POST["action"]) || !empty($_POST["action"]))
{
$action = $_POST["action"];

if(function_exists($action))
{
      $action($conn);    
}
else
{
    echo json_encode(['status'=>'error','message'=>"action is invalid! $action"]);
      
}
}
else
{
    echo json_encode(['status'=>'error','message'=>'action is required!']);
}


// insert
function permessionInsert($conn)
{
    // extract the form data
    extract($_POST);
    // Form Validation
  if (empty($dName) || empty($permession)) {
    echo json_encode(['status'=>'error','message'=>'Display Name and Permission are required!']);
    return;
}
else
{
    // Old One
    $select = mysqli_query($conn, "SELECT * FROM `permissions` WHERE display_name = '$dName' OR name = '$permession'");
    if($select->num_rows > 0)
    {
            echo json_encode(['status'=>'error','message'=>"$dName Permission AlReady Inserted!"]);
    }
    else
    {
        $insert = mysqli_query($conn,"INSERT INTO `permissions`( `name`, `display_name`, `description`) VALUES('$permession','$dName','$description')");
        
        if($insert)
        {
            echo json_encode(['status'=>'success','message'=>"SuccessFully Added!"]);

        }
    }
}

}


// Read
function permessionRead($conn)
{
$select = mysqli_query($conn,"SELECT * FROM `permissions`");
if($select->num_rows > 0)
{
        while($row = mysqli_fetch_assoc($select))
        {
            ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['display_name']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td class="d-flex">
        <div style="display: felx;"></div>
        <button id="deleteP" userId = "<?php echo $row['id'] ;?>" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        <br>
        <button class="btn btn-primary editP" 
        data-id="<?php echo $row['id'];?>"
        data-name="<?php echo $row['name'];?>"
        data-dname="<?php echo $row['display_name'];?>"
        data-description="<?php echo $row['description'];?>"
>
    <i class="fas fa-edit"></i>
</button>

    </td>
</tr>

<?php
        }
}
else
{
    ?>
<tr><td colspan="5" class="text-center text-danger">No Data Found!</td></tr>
    <?php
}
}

// Read
function permessionDelete($conn)
{
  $id = $_POST['id'];
  $delete = mysqli_query($conn , "DELETE FROM `permissions` WHERE id='$id'");
  if($delete)
  {
    echo json_encode(["status"=> "success","message"=> "successfully deleted!"]);
  }
}


// Update
function permessionUpdate($conn)
{
    $id = $_POST['id'];
    $dName = $_POST['dName'];
    $permession = $_POST['permession'];
    $description = $_POST['description'];

    if (empty($id) || empty($dName) || empty($permession)) {
        echo json_encode(['status'=>'error','message'=>'All required fields must be filled!']);
        return;
    }

    $update = mysqli_query(
        $conn,
        "UPDATE `permissions` SET 
            name='$permession',
            display_name='$dName',
            description='$description'
        WHERE id='$id'"
    );

    if ($update) {
        echo json_encode(['status'=>'success','message'=>'Permission updated successfully!']);
    } else {
        echo json_encode(['status'=>'error','message'=>'Database error: '.$conn->error]);
    }
}




?>