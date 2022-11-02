<?php
    require('top.inc.php');
    // if($_SESSION['ROLE']!="1"){
    //     header('location:add_employee.php?id='.$_SESSION['USER_ID']);
    //     die();
    // }
    $username='';
    $email='';
    $mobile='';
    $address='';
    $birthday='';
    $user_type='';
    $password='';
    $id='';
    
    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        // if($_SESSION['ROLE']=="employee" && $_SESSION['USER_ID']!=$id){
        //     die("Access Denied");
        // }
        $res=mysqli_query($con,"select * from employee where id='$id'");
        $row=mysqli_fetch_assoc($res);
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $birthday = $row['birthday'];
        // $user_type = $row['user_type'];
    }
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
        $address = mysqli_real_escape_string($con,$_POST['address']);
        $birthday = mysqli_real_escape_string($con,$_POST['birthday']);
        $user_type = mysqli_real_escape_string($con,$_POST['user_type']);
        

        echo $username;
        if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin"){
            if($id>0){
                // update data in role table and employee table 
                $sql="update employee set username='$username' , email='$email' ,password='$password',
                mobile='$mobile',address='$address',birthday='$birthday' where id='$id';
                insert into role_type(username,email,password,user_type) 

                values('$username','$email','$password','$user_type');
            
                Delete From role_type where id not in (select Max(id) from role_type Group by email)";

            }else{
                $sql="insert into employee(username,email,password,mobile,address,birthday,role) 
                values('$username','$email','$password','$mobile','$address','$birthday','2');
                insert into role_type(username,email,password,user_type) 
                values('$username','$email','$password','$user_type')";
            }
        }else{
             $sql="update employee set username='$username' ,
                mobile='$mobile',address='$address',birthday='$birthday' where id='$id';
                update role_type set username='$username' where id='$_SESSION'USER_ID'";
        }
        // end
        mysqli_multi_query($con,$sql);
        if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin"){
            header('location:employee.php');
        }else{
            header('location:employee-profile.php');
        }
        die();
    } 
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                        <div class="card-header"><strong>Add Employee</strong><small> Form</small></div>
                        <?php } ?>
                        <?php if($_SESSION['ROLE']=="employee"){ ?>
                            <div class="card-header"><strong>Employee Details</strong><small> Form</small></div>
                            <?php } ?>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
                                    <label class=" form-control-label">Name</label>
                                    <input type="text" value="<?php echo $username?>" name="username" placeholder="Enter employee name" class="form-control" required>
                                </div>
                                <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                                <div class="form-group">
                                    <label class=" form-control-label">Email</label>
                                    <input type="text" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class=" form-control-label">Phone Number</label>
                                    <input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee phone number" class="form-control" required>
                                </div>
                                <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                                <div class="form-group">
                                    <label class=" form-control-label">Password</label>
                                    <input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
                                </div>
                                <?php } ?>
                                <!-- <div class="form-group">
                                    <label class=" form-control-label">User Type</label>
                                    <input type="user_type"  name="user_type" placeholder="Enter user type" class="form-control" required>
                                </div> -->
                                <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                                          <select class="form-control my-2" name="user_type" >
                                          <option value="">Choose type</option>
                                          <option value="admin">admin</option>
                                          <option value="subadmin">subadmin</option>
                                          <option value="employee">employee</option>
                                          </select>
                                          <?php } ?>
                                          <script>
                                             function update_leave_status(id,select_value){
                                                window.location.href=id+'&type=update&status='+select_value;
                                                if(select_value === "3"){
                                                   let person = prompt("Please enter the reason");
                                                   if (person != null) {
                                                      document.getElementById("demo").innerHTML =
                                                      "Hello " + person + "! How are you today?";
                                                   }
                                                }
                                             }
                                          </script>
                                <div class="form-group">
                                    <label class=" form-control-label">Address</label>
                                    <input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">DOB</label>
                                    <input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter employee DOB" class="form-control" required>
                                </div>
                                <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                                </button>
							   <!-- <?php if ($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin"){?>
                               <?php }?> -->
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>            
<?php
// require('footer.inc.php');

?>