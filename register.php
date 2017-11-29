<?php
	
	$page_title = "Register";
	include 'include/header.php';

	include 'include/db.php';

	include 'include/function.php';

	$errors = [];

		if(array_key_exists('register',$_POST)){

				

				if(empty($_POST['fname'])){
					$errors['fname'] = "Please enter firstname";
				}

				if(empty($_POST['lname'])){

					$errors['lname'] = "please enter lastname";
				}

				if(empty($_POST['email'])){

					$errors['email'] = "Please enter email";
				}

				if(doesEmailExist($conn, $_POST['email'])){
					$errors['email'] = "Email already exist";

				}
				if(empty($_POST['password'])){

					$errors['password'] = "Please enter password";
				}
				if(empty($_POST['pword'])){

					$errors['pword'] = "Please confirm your password";
				}

				if(empty($errors)){
					#do database stuff
					$clean = array_map('trim', $_POST);

					 doAdminRegister($conn, $clean);

					 $msg = "registration successful";

					 redirect("login.php?msg=$msg");
				}

		}


	


?>

<div class="wrapper">
		<h1 id="register-label">Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php $data = displayErrors($errors, 'fname');
						echo $data;

				  ?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php $data = displayErrors($errors, 'lname');
						echo $data;

				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php $data = displayErrors($errors, 'email');
						echo $data;

				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php $data = displayErrors($errors, 'password');
						echo $data;

				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php $data = displayErrors($errors, 'pword');
						echo $data;

				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

<?php

	include 'include/footer.php';


?>