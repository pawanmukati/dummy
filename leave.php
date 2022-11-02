<?php
require('top.inc.php');

// if($_SESSION['ROLE']!=2){
// 	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
// 	die();
// }

// delete leaves status
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `leave` where id='$id'");
}
// update leaves status by admin
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
   $remark=isset($_GET['remark']) ? $_GET['remark'] : '';
	mysqli_query($con,"update `leave` set leave_status='$status', ao_remark='$remark' where id='$id'");
}

// display leave in admin panel
if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin"){ 
	$sql="select `leave`.*, role_type.username,role_type.id as eid from `leave`,role_type 
   where `leave`.employee_id=role_type.id order by `leave`.id desc";

// display leave in employee panel
}
if($_SESSION['ROLE']=="employee"){ 
	$eid=$_SESSION['USER_ID'];
	$sql="select `leave`.*, role_type.username ,role_type.id as eid from `leave`,role_type 
   where `leave`.employee_id='$eid' and `leave`.employee_id=role_type.id order by `leave`.id desc";
}
else{
	// $eid=$_SESSION['USER_ID'];
	// $sql="select `leave`.*, role_type.username ,role_type.id as eid from `leave`,role_type 
   // where `leave`.employee_id='$eid' and `leave`.employee_id=role_type.id order by `leave`.id desc";
}
// echo $eid;
$res=mysqli_query($con,$sql);


?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave</h4>
                           <?php if($_SESSION['ROLE']=="employee" || $_SESSION['ROLE']=="subadmin"){ ?>
                           <h4 class="box_title_link"><a href="add_leave.php">Add Leave</a> </h4>
                           <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="10%">Name</th>
                                       <th width="15%">From</th>
                                       <th width="15%">To</th>
                                       <th width="20%">Description</th>
                                       <th width="15%">Status</th>
                                       <th width="15%">leave Comments</th>
                                       <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                

                                    $i=1;
                                    while($row=mysqli_fetch_assoc($res)){
                                        ?>
                                    <tr>
                                                <td><?php echo $i?></td>
                                       <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['username']?></td>
                                       <td><?php echo $row['leave_from']?></td>
                                       <td><?php echo $row['leave_to']?></td>
                                       <td><?php echo $row['leave_description']?></td>
                                       <td>
                                          <?php
                                          if($row['leave_status']==1){
                                             echo "Applied";
                                          }if($row['leave_status']==2){
                                             echo "Approved";
                                          }if($row['leave_status']==3){
                                             echo "Rejected";
                                          }
                                          ?>
                                          <?php if($_SESSION['ROLE']=="admin" || $_SESSION['ROLE']=="subadmin" ){ ?>
                                          <select class="form-control"
                                           onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                                          <option value="">Update Status</option>
                                          <option value="2">Approved</option>
                                          <option value="3">Rejected</option>
                                          </select>
                                          <?php } ?>
                                          <script>
                                             function update_leave_status(id,select_value){
                                                let reason='';
                                                if(select_value === "3"){
                                                   reason = prompt("Please enter the reason");
                                                }
                                                window.location.href='leave.php?id='+id+'&type=update&status='+select_value+'&remark='+reason;
                                             }
                                          </script>
                                       </td>
                                       <td><?php echo $row['ao_remark']?></td>
                                       <td>
                                                <?php
                                       if($row['leave_status']==1){ ?>
                                       <a href="leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
                                       <?php } ?>
                                                
                                                
                                          </td>
                                                
                                          </tr>
                                          <?php 
                                          $i++;
                                          } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         
<?php
// require('footer.inc.php');
?>