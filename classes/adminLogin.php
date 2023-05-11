<?php 
include '../lib/session.php';
Session::checkLogin();
include '../lib/database.php';
include '../helpers/format.php';


class AdminLogin
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser,$adminPass){
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if(empty($adminPass) || empty($adminUser)){
            $err = "user or pass must be not empty";
            return $err;
        }else{
            $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' LIMIT 1";
            $result = $this->db->select($query);
            if($result !== false){

                $value = $result->fetch_assoc();
                Session::set('adminLogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);

                header("Location:index.php");
            }else{
                $err = "user or pass not match";
                return $err;
            }
        }
    }
}


?>