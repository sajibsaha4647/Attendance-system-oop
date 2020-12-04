<?php 
$filepath = realpath(dirname(__DIR__));
    include_once($filepath . './config/Database.php');
    include_once($filepath . './config/Session.php');

class UserController{
    public $db;
    public $tableName = "all_employee";
    public function __construct()
    {
        $this->db = new Database();
    }


    public function AddEmployee($post){
        $name = $this->Validation($post['name']);
        $username = $this->Validation($post['username']);
        $email = $this->Validation($post['email']);
        $password = $this->Validation(md5($post['password']));
        $confirmPassword = $this->Validation(md5($post['confirmPassword']));
        $checkEmail = $this->Validation($this->checkEmail($email));
         if ($name == '' || $username == '' || $email == '' || $password == '' || $confirmPassword == '') {
            return "<div class='alert alert-danger'>All field are require</div>";
        } else if ($checkEmail == true) {
            return "<div class='alert alert-danger'>email is already exist</div>";
        }else if($confirmPassword !==  $password){
            return "<div class='alert alert-danger'>Password did't mathch</div>";
        }else {
            $sql = "INSERT INTO $this->tableName(employee_name,emaployee_username,employee_email,employee_password)VALUES('$name','$username','$email','$password')";
            $insert = $this->db->insert($sql);
            if ($insert) {
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Insert successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                return '<div class="alert alert-danger" role="alert">
                    <strong>Problem!</strong> Insert Unsuccessful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    }

    public function GetallEmployee(){
        error_reporting(0);
        $sql = "SELECT * FROM $this->tableName";
        $show = $this->db->select($sql);
        if ($show == true) {
            return $show;
        } else {
            return false;
        }
    }

    public function DeleteEmployee($id){
        $sql = "DELETE FROM $this->tableName where employee_id='$id'";
        $delete = $this->db->delete($sql);
        if ($delete) {
            return $delete;
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
        $sql = "SELECT * FROM $this->tableName WHERE employee_email='$email'";
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