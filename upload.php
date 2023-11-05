<?php 

if (isset($_FILES['my_image'])) {
	require_once('db.php');


/* 	echo "<pre>";
	print_r($_FILES['image']);
	echo "</pre>"; */

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
/* 	$error = $_FILES['image']['error']; */

	
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

    $sql = "INSERT INTO products (productimg) VALUES ('$new_img_name')";
    $SORGU = $DB->prepare($sql);


    header("Location: index.php");
    $SORGU->execute();
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}

}