<?php

	session_start();

	$page_title = "Admin Dashboard";

	include "include/db.php";
	include 'include/function.php';
	include "include/dashboard_header.php";

	


	checkLogin();


	if($_GET['cat_id']){

		$cat_id = $_GET['cat_id'];

	}

	$item = getCategory($conn, $cat_id);


	$errors = [];

			if(array_key_exists('edit',$_POST)){

				if(empty($_POST['cat_name'])){
					$errors['cat_name'] = "Please enter category name";
				}

				if(empty($errors)){

					$clean = array_map('trim', $_POST);
					$clean['id'] = $cat_id;

					updateCategory($conn, $clean);

					redirect("view_category.php");
					
				}
			}


?>
	





	<div class="wrapper">
		<div id="stream">

			<form id="register"  action ="" method ="POST">
				<div>
					<?php 
						$info = displayErrors($errors,'cat_name');
						echo $info;
					?>
					<label>Edit Category:</label>
					<input type="text" name="cat_name" placeholder="Category name" value="<?php echo $item[1]; ?>">
				</div>
			
			 <div>
			<input type="submit" name="edit" value="Edit">
			
			</form>

		</div>

	</div>

<?php

	include "include/footer.php";

?>