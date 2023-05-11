<?php 
include '../lib/database.php';
include '../helpers/format.php';


class Category
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert($catName){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if(empty($catName)){
            $err = "Category must be not empty";
            return $err;
        }else{
            $query = "INSERT INTO tbl_category (catName) SELECT '$catName' WHERE NOT EXISTS (SELECT * FROM tbl_category WHERE catName = '$catName')";
            $result = $this->db->insert($query);
            if($result){
                return 'category had been inserted';
            }else{
                return 'category was not inserted';
            }
        }
    }
}


?>