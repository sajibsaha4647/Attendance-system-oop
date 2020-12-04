<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . './functions/functions.php');
    include_once($filepath . './Controller/userController.php');
    get_header();
    get_Bread();

?>

<?php 
    $User = new UserController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $result = $User->AddEmployee($_POST);
    }

?>

    <section>
        <div style="margin-bottom:50px" class="header"> 
            <div class="container">
                    <div class="card">
                        <div class="card-header">
                           <div class="row">
                                <div class="col-md-6">
                                    <a href="index.php"><button type="button" class="btn btn-info">All Employee</button></a>
                               </div>
                               <div style="text-align:right" class="col-md-6 justify-content-end">
                                    <a href="Viewemployee.php"><button type="button" class="btn btn-info">View Employees</button></a>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">
                        <?php 
                            if(isset( $result )){
                                echo  $result ;
                            }
                        ?>
                           <form action="" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter Name</label>
                                    <input type="text" class="form-control" name="name" aria-describedby="emailHelp"  placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter UserName</label>
                                    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter UserName">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter Email</label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enter Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Create Employee</button>
                            </form>
                        </div>
                       </div>
                </div>
            </div>
        </section>


<?php 
get_Footer()
?>



   