<?php 
include '../classes/brand.php';

$brand = new Brand();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$brandName= $_POST["brandName"];

	$insetbrand = $brand->insert($brandName);
}

?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New brand</h2>
               <div class="block copyblock"> 
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter brand Name..." class="medium" />
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