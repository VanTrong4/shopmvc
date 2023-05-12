<?php 
include_once '../lib/database.php';
include_once '../helpers/format.php';


class Brand
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert($brandName){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if(empty($brandName)){
            $err = "Brand must be not empty";
            return $err;
        }else{
            $getBrands = "SELECT * FROM tbl_brand";
            $resultBrands = $this->db->select($getBrands);
            if($resultBrands!=false){
                $resultBrandsNew = $resultBrands->fetch_all();
                foreach($resultBrandsNew as $Brands){
                    foreach($Brands as $brand){
                        if($brand===$brandName){
                            return "Add error because Brand already exists";
                        }
                    }
                }
            }
            
            $query = "INSERT INTO tbl_brand (brandName) SELECT '$brandName' WHERE NOT EXISTS (SELECT * FROM tbl_brand WHERE brandName = '$brandName')";
            $result = $this->db->insert($query);
            if($result){
                return 'Brand had been inserted';
            }else{
                return 'Brand was not inserted';
            }
        }
    }
    public function getAll(){
        $getBrands = "SELECT * FROM tbl_brand";
        $resultBrands = $this->db->select($getBrands);
        if($resultBrands!=false){
            return $resultBrands->fetch_all();
        }else{
            return false;
        }
    }
    public function get($brandId){
        $getBrands = "SELECT * FROM tbl_brand WHERE brandId = '$brandId'";
        $resultBrands = $this->db->select($getBrands)->fetch_assoc();
        return $resultBrands;
    }
    public function update($brandId,$brandName){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if(empty($brandName)){
            $err = "Brand must be not empty";
            return $err;
        }else{
            $getBrands = "SELECT * FROM tbl_brand";
            $resultBrands = $this->db->select($getBrands)->fetch_all();
            foreach($resultBrands as $Brands){
                foreach($Brands as $brand){
                    if($brand===$brandName){
                        return "Add error because Brand already exists";
                    }
                }
            }
            $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$brandId'";
            $result = $this->db->update($query);
            if($result){
                return 'Brand had been updated';
            }else{
                return 'Brand was not updated';
            }
        }
    }
    public function delete($brandId){
        if(empty($brandId)){
            $err = "Dont have Brand";
            return $err;
        }else{
            $query = "DELETE FROM tbl_brand WHERE brandId='$brandId'";
            $result = $this->db->delete($query);
            if($result){
                return 'Brand had been deleted';
            }else{
                return 'Brand was not delete';
            }
        }
    }
}


?>