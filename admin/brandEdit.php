<?php 
include '../classes/brand.php';

$brand = new Brand();

if(isset($_GET['brandId']) &&  $_GET['brandId']!=NULL){
	$brandId= $_GET["brandId"];
}else{
    header('Lobrandion: brandlist.php');
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $brandName2= $_POST["brandName"];
    $insetbrand = $brand->update($brandId,$brandName2);
}
$brandName = $brand->get($brandId);

?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit brand</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $brandName['brandName'];?>" name="brandName" placeholder="Edit brand Name..." class="medium" />
                                <span>
                                    <?php
                                        if(isset($insetbrand)){
                                            echo $insetbrand;
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