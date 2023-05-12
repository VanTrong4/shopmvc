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
            $getCats = "SELECT * FROM tbl_category";
            $resultCats = $this->db->select($getCats)->fetch_all();
            foreach($resultCats as $cats){
                foreach($cats as $cat){
                    if($cat===$catName){
                        return "Add error because category already exists";
                    }
                }
            }
            $query = "INSERT INTO tbl_category (catName) SELECT '$catName' WHERE NOT EXISTS (SELECT * FROM tbl_category WHERE catName = '$catName')";
            $result = $this->db->insert($query);
            if($result){
                return 'category had been inserted';
            }else{
                return 'category was not inserted';
            }
        }
    }
    public function getAll(){
        $getCats = "SELECT * FROM tbl_category";
        $resultCats = $this->db->select($getCats)->fetch_all();
        return $resultCats;
    }
    public function get($catId){
        $getCats = "SELECT * FROM tbl_category WHERE catId = '$catId'";
        $resultCats = $this->db->select($getCats)->fetch_assoc();
        return $resultCats;
    }
    public function update($catId,$catName){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if(empty($catName)){
            $err = "Category must be not empty";
            return $err;
        }else{
            $getCats = "SELECT * FROM tbl_category";
            $resultCats = $this->db->select($getCats)->fetch_all();
            foreach($resultCats as $cats){
                foreach($cats as $cat){
                    if($cat===$catName){
                        return "Add error because category already exists";
                    }
                }
            }
            $query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$catId'";
            $result = $this->db->update($query);
            if($result){
                return 'category had been updated';
            }else{
                return 'category was not updated';
            }
        }
    }
    public function delete($catId){
        if(empty($catId)){
            $err = "Dont have category";
            return $err;
        }else{
            $query = "DELETE FROM tbl_category WHERE catId='$catId'";
            $result = $this->db->delete($query);
            if($result){
                return 'category had been deleted';
            }else{
                return 'category was not delete';
            }
        }
    }
}


?>