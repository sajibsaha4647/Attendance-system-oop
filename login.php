<?php

    $filepath = realpath(dirname(__DIR__));
    require_once('Controller/adminController.php');
    require_once('config/Session.php');
Session::checkLogin();
    $admincontroller = new AdminController();

    if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])){
        $result = $admincontroller->AdminLogin($_POST);
    }

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontawesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

    <title>Hello, world!</title>
</head>

<body>

<section>
        <div class="header">
            <div class="container">
                 <div class="header_text m-auto">
                        <h4 style="text-align:center;margin-top:15px;text-transform:capitalize;margin-bottom:20px">Employee Attendance System App</h4>
                    </div>
                   <div class="row justify-content-md-center">
                       <div class="col-md-5 justify-content-md-center">
                           <div class="card border-success mb-3">
                                <div class="card-header bg-transparent border-success">Please login</div>
                                <div class="card-body text-success">
                                   <form action="" method="post">
                                       <?php 
                                        if(isset($result)){
                                            echo $result;
                                        }
                                       ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                    </form>
                                </div>
                            </div>
                           
                       </div>
                   </div>
            </div>
        </div>
    </section>


     <script defer src="js/jquery-3.2.1.slim.min.js"></script>
    <script defer src="js/popper.min.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="js/all.js"></script>
    <script defer src="js/fontawesome.js"></script>
</body>

</html>