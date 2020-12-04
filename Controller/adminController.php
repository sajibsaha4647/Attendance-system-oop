<?php 

    $filepath = realpath(dirname(__DIR__));
    include_once('config/Database.php');
    include_once('config/Session.php');

class AdminController{

    public $db;
    public $tableName = "admin_user";
    public function __construct()
    {
        $this->db = new Database();
    }


    public function AdminLogin($post){
       $email = $this->Validation($post['email']);
        $password = $this->Validation(md5($post['password']));
        if ($email == '' || $password == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else {
            $sql = "SELECT * FROM $this->tableName WHERE admin_email='$email' AND admin_password='$password' ";
            $log = $this->db->select($sql);
            if ($log == true) {
                $value =  $log->fetch_assoc();
                Session::set('login', true);
                Session::set('admin_id', $value['admin_id']);
                Session::set('admin_name', $value['admin_name']);
                Session::set('admin_email', $value['admin_email']);
                Session::set('admin_password', $value['admin_password']);
                header("location:index.php");
            } else {
                return "<div class='alert alert-danger'>User name or password did not mathch</div>";
            }
    }
}

    public function Validation($data)
    { //validation
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->link, $data);
        return $data;
    }

    public function checkEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE admin_email='$email'";
        $check = $this->db->select($sql);
        if ($check !== false) {
            $row = mysqli_num_rows($check);
            if ($row > 0) {
                return  true;
            } else {
                return false;
            }
        }
    }




}

?>