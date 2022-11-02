<?php
    require('top.inc.php');
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $leave_id = mysqli_real_escape_string($con,$_POST['leave_id']);
        $leave_from = mysqli_real_escape_string($con,$_POST['leave_from']);
        $leave_to = mysqli_real_escape_string($con,$_POST['leave_to']);
        $leave_description=mysqli_real_escape_string($con,$_POST['leave_description']);
        $employee_id=$_SESSION['USER_ID'];
        $sql="insert into `leave`(username,leave_id,leave_from,leave_to,employee_id,leave_description,leave_status) 
        values('$username','$leave_id','$leave_from','$leave_to','$employee_id','$leave_description',1)";
        
        mysqli_query($con,$sql);
        ?>
        <script>
            alert("Login Successfull");
            // location.replace("home.php");
        </script>
        <?php
        header('location:leave.php');
      
        die();
    } 
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Leave</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
                           <div class="form-group">
                                    <label class=" form-control-label">Name</label>
                                    <input type="text"  name="username" class="form-control" required>
                                </div>
                                    <label class=" form-control-label">Leave Type</label>
									<select name="leave_id" required class="form-control">
										<option value="">Select Leave</option>
										<?php
										$res=mysqli_query($con,"select * from leave_type order by leave_type desc");
										while($row=mysqli_fetch_assoc($res)){
                                            var_dump($row);
											echo "<option value=".$row['id'].">".$row['leave_type']."</option>";
										}
										?>
									</select>
							   <div class="form-group">
                                    <label class=" form-control-label">Form date</label>
                                    <input type="date"  name="leave_from" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Tot Date</label>
                                    <input type="date"  name="leave_to" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Leave Description</label>
                                    <input type="text"  name="leave_description" class="form-control" >
                                </div>

                                    <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                    </button>
                    
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