<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include '../classes/product.php';
include_once '../helpers/format.php';
?>
<?php
$pd = new Product();
$fm = new Format();
$productList = $pd->getAll();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product name</th>
					<th>Product price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if($productList!=false){
					foreach($productList as $product){?>
				<tr>
					<td><?php echo $product[0] ?></td>
					<td><?php echo $product[1] ?></td>
					<td><?php echo $product[6] ?></td>
					<td><?php echo $product[7] ?></td>
					<td><?php echo $product[2] ?></td>
					<td><?php echo $product[3] ?></td>
					<td><?php 
					echo $fm->textShorten($product[4],20);
					?></td>
					<td class="center"><?php echo $product[5] ?></td>
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
