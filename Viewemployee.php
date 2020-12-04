<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . './functions/functions.php');
    include_once($filepath . './Controller/attendanceController.php');
    get_header();
    get_Bread();
    $Allemployee = new AttendanceController()
?>

<?php 

?>

    <section>
        <div style="margin-bottom:50px" class="header">
            <div class="container">
                    <div class="card">
                        <div class="card-header">
                           <div class="row">
                               <div class="col-md-6 justify-content-end">
                                    <a href="AddEmployee.php"><button type="button" class="btn btn-success">Add Employee</button></a>
                               </div>
                               <div style="text-align:right" class="col-md-6 justify-content-end">
                                    <a href="index.php"><button type="button" class="btn btn-info">All Employee</button></a>
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
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" name="submit" class="btn btn-primary">Update Attendance</button>
                            </form>
                        </div>
                       </div>
                </div>
            </div>
        </section>


<?php 
get_Footer()
?>



   