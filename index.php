<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . './functions/functions.php');
    include_once($filepath . './config/Session.php');
    include_once($filepath . './Controller/userController.php');
    include_once($filepath . './Controller/attendanceController.php');
    get_header();
    get_Bread();
    $db = new Database();
    $Allemployee = new UserController();
    $Attendance = new AttendanceController()
   
?>
<?php 
    if(isset($_GET['logout'])){
        Session::destroy();
    }
?>

<?php 

    if(isset($_GET['delete'])){
        $id = $_GET['id'];
        $res =  $Allemployee->DeleteEmployee($id);
    }
?>

<?php 
   
    $date = date(date("Y-m-d"));
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])){
        $attendances = $_POST['attendance'];
        $message = $Attendance->giveAttendance( $attendances);
    }
    

?>

    <section>
        <div style="margin-bottom:50px" class="header">
            <div class="container">
                    <div class="card">
                        <h2 style="text-align:center;margin-top:20px;margin-bottom:10px;text-transform:capitalize"> Hi i am  <?php echo Session::get('admin_name') ?></h2>
                        <h2 style="text-align:center;margin-bottom:10px">Date:<?php  echo $date?></h2>
                        <div class="card-header">
                           <div class="row">
                               <div class="col-md-6 justify-content-end">
                                   <a href="AddEmployee.php"><button type="button" class="btn btn-success">Add Employee</button></a>
                               </div>
                               <div style="text-align:right" class="col-md-6 justify-content-end">
                                    <!-- <a href="Viewemployee.php"><button type="button" style="margin-right:30px" class="btn btn-info">View Employees</button></a> -->
                                    <a href="?logout"><button type="button" class="btn btn-info">Logout</button></a>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                            <?php 
                                if(isset( $message)){
                                    echo  $message;
                                }
                            ?>
                                <table class="table table-striped">
                                        <thead>
                                            <tr style="text-align:center" class="justify-content-center">
                                                <th scope="col">Serial</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">User name</th>
                                                <th scope="col">Attendance</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            foreach($Allemployee->GetallEmployee() as $key=>$value){
                                        ?>
                                            <tr style="text-align:center">
                                                <th scope="row"><?php echo $key+1?></th>
                                                <td><?php echo $value['employee_name'] ?></td>
                                                <td><?php echo $value['emaployee_username'] ?></td>
                                                <td><?php echo $value['employee_email']?></td>
                                                <td>
                                                    <div>
                                                        <input type="radio"  name="attendance[<?=$value['employee_email']?>]" value="present" >p
                                                        </div>
                                                        <div >
                                                        <input type="radio" name="attendance[<?=$value['employee_email']?>]" value="absent">A
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="index.php?delete&id=<?php echo $value['employee_id'] ?>" onclick="return confirm('Are you sure ?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" name="submit" class="btn btn-primary">Take Attendance</button>
                            </form>
                        </div>
                       </div>
                </div>
            </div>
        </section>


<?php 
get_Footer()
?>



   