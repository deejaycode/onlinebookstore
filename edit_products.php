<?php

    session_start();

    $page_title = "Edit Products";

    include "include/db.php";
    include "include/function.php";
    include "include/dashboard_header.php";

    $flag = ['Top-Selling', 'Trending', 'Recently-Viewed'];


    checkLogin();

    $errors = [];

    if($_GET['book_id']) {
        $book_id = $_GET['book_id'];
    }

    $item = getProductById($conn, $book_id);

    $category = getCategory($conn, $item[5]);
     //print_r($item); exit();

    if(array_key_exists('edit', $_POST)) {

        if(empty($_POST['title'])) {

            $errors['title'] = "Enter the book title";

        }

        if(empty($_POST['author'])) {

            $errors['author'] = "Enter the book author";

        }

        if(empty($_POST['price'])) {

            $errors['price'] = "Enter the book price";

        }

        if(empty($_POST['year'])) {

            $errors['year'] = "Enter the publication year";

        }

        if(empty($_POST['cat'])) {

            $errors['cat_name'] = "Select the book flag";

        }

        if(empty($errors)) {

            $clean = array_map('trim', $_POST);
            $clean['id'] = $book_id;

            editProduct($conn, $clean);

            redirect("view_products.php");

        }
    }

?>

<div class="wrapper">
    <div id="stream">
        <form id="register"  action ="" method ="POST">
			<div>
				<?php  
					$info = displayErrors($errors, 'title');
					echo $info;
				?>
				<label>Edit Title:</label>
				<input type="text" name="title" placeholder="title" value="<?php echo $item[1]; ?>">
            </div>

            <div>
				<?php  
					$info = displayErrors($errors, 'author');
					echo $info;
				?>
				<label>Edit Author:</label>
				<input type="text" name="author" placeholder="author" value="<?php echo $item[2]; ?>">
            </div>

            <div>
				<?php  
					$info = displayErrors($errors, 'price');
					echo $info;
				?>
				<label>Edit Price:</label>
				<input type="text" name="price" placeholder="price" value="<?php echo $item[3]; ?>">
            </div>

            <div>
				<?php  
					$info = displayErrors($errors, 'year');
					echo $info;
				?>
				<label>Publication Year: </label>
				<input type="text" name="year" placeholder="publication year" value="<?php echo $item[4]; ?>">
            </div>

            <div>
				<?php  
					$info = displayErrors($errors, 'cat');
					echo $info;
				?>
				<label>Product Category:</label>
				<select name="cat">
					<option value="<?php echo $category[0]; ?>"><?php echo $category[1] ?></option>
					<?php
						$data = fetchCategory($conn, $category[1]); 
						echo $data;
					?>
				</select>
            </div>


             <input type="submit" name="edit" value="Edit product"/>
        </form>
        <h4 class="jumpto">To edit product image <a href="edit_image.php?img=<?php echo $book_id; ?>">Click here</a></h4>
    </div>
</div>

<?php
    include("include/footer.php");
?>