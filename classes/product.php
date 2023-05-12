<?php 
include_once '../lib/database.php';
include_once '../helpers/format.php';


class Product
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert($data,$files){
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $productCat = mysqli_real_escape_string($this->db->link, $data['productCat']);
        $productBrand = mysqli_real_escape_string($this->db->link, $data['productBrand']);
        $productDescription = mysqli_real_escape_string($this->db->link, $data['productDescription']);
        $productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $fileName = $_FILES['productImage']['name'];
        $fileSize = $_FILES['productImage']['size'];
        $fileTemp = $_FILES['productImage']['tmp_name'];

        $div = explode('.', $fileName);
        $file_ext = strtolower(end($div));
        $uniqueImage = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = 'uploads/'.$uniqueImage;
        if($productName == '' || $productBrand == '' || $productDescription == '' || $productPrice == '' || $productType == '' || $fileName ==''){
            $err = "Fields must be not empty";
            return $err;
        }else{
            move_uploaded_file($fileTemp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,productCat,productBrand,descrip,price,productType,productImage) VALUES ('$productName', '$productBrand', '$productCat', '$productDescription', '$productPrice', '$productType', '$uniqueImage')";
            $result = $this->db->insert($query);
            if($result){
                return 'Product had been inserted';
            }else{
                return 'Product was not inserted';
            }
        }
    }
    public function getAll(){
        $getProduct = "SELECT * FROM tbl_product";
        $resultProduct = $this->db->select($getProduct);
        if($resultProduct!=false){
            return $resultProduct->fetch_all();
        }else{
            return false;
        }
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