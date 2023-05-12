<?php 
include '../classes/category.php';

$cat = new Category();

if(isset($_GET['catId']) &&  $_GET['catId']!=NULL){
	$catId= $_GET["catId"];
}else{
    header('Location: catlist.php');
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $catName2= $_POST["catName"];
    $insetCat = $cat->update($catId,$catName2);
}
$catName = $cat->get($catId);

?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $catName['catName'];?>" name="catName" placeholder="Edit Category Name..." class="medium" />
                                <span>
                                    <?php
                                        if(isset($insetCat)){
                                            echo $insetCat;
                                        }
                                    ?>
                                </span>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>