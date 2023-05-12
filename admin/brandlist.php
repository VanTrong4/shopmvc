<?php
	include '../classes/brand.php';
	$brand = new Brand();
	if(isset($_GET["delId"]) && $_GET["delId"]!=NULL){
		$brandId= $_GET["delId"];
		$delResult = $brand->delete($brandId);
	}
	$brands = $brand->getAll();
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>brand List</h2>
                <div class="block">
					<?php if(isset($delResult)){
						echo $delResult;
					} ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 0;
						if($brands!=false){
						foreach($brands as $brand){ 
							$i++;
						?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $brand[1] ?></td>
								<td><a href="brandEdit.php?brandId=<?php echo $brand[0] ?>">Edit</a> || <a onclick="return confirm('are you sure')" href="?delId=<?php echo $brand[0] ?>">Delete</a></td>
							</tr>
						<?php }}; ?>
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

