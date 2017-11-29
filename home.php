<?php

	session_start();
	$page_title = "Login";
	include 'include/header.php';
	include 'include/db.php';
	include 'include/function.php';


	$admin_id = $_SESSION['admin_id'];
	$email = $_SESSION['email'];

	

?>

<div class="wrapper">


	<?php

		echo $admin_id." ".$email;


	?>


</div>