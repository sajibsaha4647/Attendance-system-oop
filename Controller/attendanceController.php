<?php 
$filepath = realpath(dirname(__DIR__));
    include_once($filepath . './config/Database.php');
    include_once($filepath . './config/Session.php');

class AttendanceController{
    public $db;
    public $tableName = "table_attendance";
    public function __construct()
    {
        $this->db = new Database();
    }


    public function giveAttendance($attendances){
        // error_reporting(0);
        $date = date(date("Y-m-d"));
        $checkallvaluesexist = $this->checkAllValuesExist( $attendances);
        $checkdate = $this->checkTime( $date);
        if(!$checkallvaluesexist || empty($attendances)){
             return "<div class='alert alert-danger'>All field are require</div>";
        }else if($checkdate == true){
           return "<div class='alert alert-danger'>Attendance Already taken</div>";
        }else{
            $query = "INSERT INTO  
            $this->tableName(attendance_email, attendance_status, attendance_time) 
            VALUES";
            $values = [];
            foreach( $attendances as $attendanceEmail=>$attend){
                array_push($values, "('$attendanceEmail', '$attend', '$date')");
            }
            $values = implode(", ", $values);
            $query .= $values;
            // print_r($query);
            // die;
            $success = $this->db->insert( $query);

            if($success)
                return '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Attendance successful
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';


            return '<div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> Attendance unsuccessful
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';       



             
        }
    }

    public function GetEmployeeUpdate(){
        
    }

    

    public function checkTime($time)
    {
        $sql = "SELECT * FROM $this->tableName WHERE attendance_time='$time'";
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

    public function checkAllValuesExist($attendances)
    {
        $sql = "SELECT * FROM all_employee";
        $check = $this->db->select($sql);
        
        if ($check !== false) {
            $row = mysqli_num_rows($check);
          
            if ($row === count($attendances)) {
                return  true;
            } else {
                return false;
            }
        }
    }


}


?>