<?php 
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/brand.php';
include '../classes/category.php';
include '../classes/product.php';
?>
<?php 
$product = new Product();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
	$insertProduct = $product->insert($_POST,$_FILES);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <span>
                <?php if(isset($insertProduct)){
                    echo $insertProduct;
                } ?>
            </span>
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input name="productName" type="text" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="productCat">
                            <option disabled selected>Select Category</option>
                            <?php 
                            $category = new Category();
                            $cats = $category->getAll();
                            if($cats != false){
                                foreach($cats as $cat){
                            ?>
                            <option value="<?php echo $cat[0] ?>"><?php echo $cat[1] ?></option>
                            <?php }};?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="productBrand">
                            <option disabled selected>Select Brand</option>
                            <?php 
                            $bran = new Brand();
                            $brands = $bran->getAll();
                            if($brands != false){
                                foreach($brands as $brand){
                            ?>
                            <option value="<?php echo $brand[0] ?>"><?php echo $brand[1] ?></option>
                            <?php }};?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="productDescription" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input name="productPrice" type="text" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input name="productImage" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="productType">
                            <option>Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


