<?php

	session_start();

	$page_title = "Admin Dashboard";

	include "include/db.php";
	include 'include/function.php';
	include "include/dashboard_header.php";

	


	checkLogin();


				$errors = [];

			if(array_key_exists('add',$_POST)){

				if(empty($_POST['cat_name'])){
					$errors['cat_name'] = "Please enter category name";
				}

				if(empty($errors)){

					$clean = array_map('trim', $_POST);

					addCategory($conn, $clean);

					header("location: view_category.php");

				}
			}


?>
	





	<div class="wrapper">
		<div id="stream">

			<form id="register"  action ="add_category.php" method ="POST">
				<div>
					<?php 
						$info = displayErrors($errors,'cat_name');
						echo $info;
					?>
					<label>Add Category:</label>
					<input type="text" name="cat_name" placeholder="Category name">
				</div>
			
			 <div>
			<input type="submit" name="add" value="Add">
			
			</form>

		</div>

	</div>

<?php

	include "include/footer.php";

?>