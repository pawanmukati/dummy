<?php
require('top.inc.php');

$eid=$_SESSION['USER_EMAIL'];

$sql="SELECT * FROM employee,role_type WHERE role_type.email=employee.email AND role_type.email='$eid'";
$res=mysqli_query($con,$sql);



$resid=mysqli_query($con,"select * from employee");
$rowid = mysqli_fetch_assoc($resid);
$_SESSION['EMP_NAME']=$rowid['username'];


// echo $rowid['id'];
// var_dump($res) ;

// if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
// 	$id=mysqli_real_escape_string($con,$_GET['id']);
// 	mysqli_query($con,"delete from `leave` where id='$id'");
// }

?>

<div class="main">
    <div class="card">
        <div class="card-body">
            <a href="add_employee.php?id=<?php echo $rowid['id']?>" class="float-right">Edit</a>
            <table>
                <tbody>
                    <?php
                    // $row = mysqli_fetch_assoc($res);
                    // var_dump($row) ;
                    while ($row = mysqli_fetch_assoc($res)) {
                   ;
                        ?>  
                    <tr>
                        <td>Employee-ID</td>
                        <td>:</td>
                        <td><?php echo $rowid['id']?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo $rowid['username']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $row['email']?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>:</td>
                        <td><?php echo $row['mobile']?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $row['address']?></td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td>:</td>
                        <td><?php echo $row['birthday']?></td>
                    </tr>
                    <?php
                    }?>
                </tbody>
            </table>
        </div>
    </div>
    </body>

    </html>