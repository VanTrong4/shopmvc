<?php
	include '../classes/category.php';
	$category = new Category();
	if(isset($_GET["delId"]) && $_GET["delId"]!=NULL){
		$catId= $_GET["delId"];
		$delResult = $category->delete($catId);
	}
	$cats = $category->getAll();
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
					<?php if(isset($delResult)){
						echo $delResult;
					} ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 0;
						foreach($cats as $cat){ 
							$i++;
						?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $cat[1] ?></td>
								<td><a href="catEdit.php?catId=<?php echo $cat[0] ?>">Edit</a> || <a onclick="return confirm('are you sure')" href="?delId=<?php echo $cat[0] ?>">Delete</a></td>
							</tr>
						<?php }; ?>
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

