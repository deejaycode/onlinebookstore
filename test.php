<!--script to handle upload -->



<?php

	session_start();

	$admin_id = $_SESSION['admin_id'];
	$name = $_SESSION['name'];

	echo "Hello, $name,";

	include ('include/function.php');

	define('MAX_FILE_SIZE', '2097152');
	$ext = ['image/jpg','image/jpeg','image/png'];

	if(array_key_exists('save', $_POST)){

		//print_r($_FILES);

		$error = [];

		if(empty($_FILES['pics']['name'])){
			$error[] ="Please select a file";
		}

		if($_FILES['pics']['size'] > MAX_FILE_SIZE) {
			$error[] = "File too large. Maximum: ".MAX_FILE_SIZE;
			$_FILES['pics']['tmp_name'] = null;
		}

		if(!in_array($_FILES['pics']['type'], $ext)){
			$error[] = "file format is not supported";
		}

		/*
		$strip_name = str_replace(' ','_',$_FILES['pics']['name']);

		$filename = setRandom().$strip_name;
		$destination = './uploads/'.$filename;*/

		/*if(!move_uploaded_file($_FILES['pics']['tmp_name'], $destination)){
				$error[] = "File not uploaded";
		} */

		if(empty($error)){
			//move_uploaded_file($_FILES['pics']['tmp_name'], $destination);
			$msg = uploadFile($_FILES, 'pics', 'uploads/');

			if($msg[0]){
				echo $msg[0];
			}
			
		}else {
			foreach ($error as $err) {
				echo $err.'<br/>';
			}
		}
	}


?>






<form id="register" method="POST" enctype="multipart/form-data">

	<p>Please Upload a picture </p>
	<input type="file" name="pics">

	<input type="submit" name="save">






</form>