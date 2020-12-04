<?php 
// $filepath = realpath(dirname(__DIR__));
    require_once('config/Database.php');
    require_once('config/Session.php');
    $db = new Database();
     Session::checkSession();
 function get_header(){
    require_once('inc/header.php');
    }
    function get_Footer(){
         require_once('inc/footer.php');
    }
    function get_Bread(){
         require_once('inc/Bread.php');
    }
    


?>