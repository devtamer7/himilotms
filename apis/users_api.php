<?php 
header("Content-Type: Application/json");

// Include connection
include("../includes/conn.php");

// Making Action
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (function_exists($action)) {
        $action($conn);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Action Failed. Action is Required']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Action is Required']);
}

// Action End Here

//Insert Start Here
function insertF($conn){
        if (isset($_POST['insertF']) && $_POST['insertF'] == 'nuurdiin') {
        extract($_POST);

        // Form Validitions
        if(empty($name) || empty($number) || empty($email) || empty($password) || empty($status)){
            echo json_encode(['status' => 'error', 'message' => 'All Fields are Required']);
        }else{
            $read_old = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            if (mysqli_num_rows($read_old) > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Email Already Exists']);
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $insert = mysqli_query($conn, "INSERT INTO users (`name`, `phone`, `email`, `password_hash`, `is_active`) VALUES ('$name', '$number', '$email', '$hashed_password', '$status')");
                if ($insert) {
                    echo json_encode(['status' => 'success', 'message' => 'User Added Successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to Add User']);
                }
            }
        }
    }else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Insert. Insert Password is Required']);
    }
}
//Insert  End Here

// Read Start Here
function read($conn){
    if(isset($_POST['read']) && $_POST['read'] == 'nuurdiin'){
        $read = mysqli_query($conn, "SELECT * FROM users");
        if($read && mysqli_num_rows($read)>0){
            foreach($read as $row){
                ?>
                 <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><button data-bs-toggle="modal" data-bs-target="#updateModal1" id="updateBtn"  student_id="<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></button></td>
                            <td><button id="btnDelete" user_id="<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                 </tr>
                <?php
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'No Data Found']);
        }
    }else{
        echo json_encode(['status' => 'error',  'message' => 'Invalid Read. Read Password is Required']);
    }
}
// Read End Here

// Delete Start Here
function delete($conn){
    if(isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];
        $delete = mysqli_query($conn, "DELETE FROM users WHERE id = '$user_id'");
        if($delete){
            echo json_encode(['status' => 'success', 'message' => 'Successfully Deleted']);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Invalid Delete']);
        }

    }else{
        echo json_encode(['status' => 'error', 'message' => 'User id is Required']);
    }
}
// Delete End Here

// ReadUpdate Start Here
function readUpdate($conn){
    if(isset($_POST['user_id'])){
                $user_id = $_POST['user_id'];
                        $readUpdate = mysqli_query($conn, "SELECT * FROM students WHERE id = '$student_id'");
                        if($readUpdate && mysqli_num_rows($readUpdate)>0){
                            ?>
                  <form id="updateForm" method="post">
                    <input type="text" name="id" id="id" value= "<?php echo $row['id'] ?>"  class="form-control" hidden >
                    <label>Name</label>
                    <input type="text" name="name" id="name" value= "<?php echo $row['name'] ?>"  class="form-control" >
                    <label>Number</label>
                    <input type="number" name="number" id="number" value= "<?php echo $row['number'] ?>"  class="form-control">
                    <label>email</label>
                    <input type="email" name="email" id="email" value= "<?php echo $row['email'] ?>" class="form-control">
                    

                    <label>Satus</label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="<?php echo $row['status']  ?>"  selected><?php echo $row['status'] ?>Chooice Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">In active</option>
               
                 
                                         <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="toggle">Close</button>
                                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Update</button>
                                        </div>
            </form>
                <?php
            }
         }
}
// ReadUpdate End Here
?>