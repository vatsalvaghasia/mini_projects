<?php
      	if(isset($_POST['fileupload'])) {
      	$filename = $_FILES['imagefile']['name'];
      	$filetmpname = $_FILES['imagefile']['tmp_name'];
      	$title = $_POST['title'];
      	$desc = $_POST['desc'];
      	$folder = 'imagesuploaded/';
      	move_uploaded_file($filetmpname, $folder.$filename);
      
		
      	$cat_str = "";
      	if(!isset($_POST['category'])){
      		echo"<script>
      		alert('Select Category of the post.');
      		window.location.href = 'postmgmt.php';
      		</script>";
      	}
      	$o = count($_POST['category']);
      	
		
		$sql = "INSERT INTO posts (post_title,post_desc,post_img) VALUES ('$title','$desc','$filename')";
		$qry = mysqli_query($conn, $sql);

		$sql1 = "SELECT MAX(post_id) as pmax FROM posts";
		$res = mysqli_query($conn,$sql1);
		$id = mysqli_fetch_array($res);
		$k = $id['pmax'];
		foreach($_POST['category'] as $cb){	
			mysqli_query($conn,"INSERT INTO blog_posts_categories(post_id,cat_id) VALUES('$k','$cb')");
			$res = mysqli_query($conn,"SELECT cat_name FROM blog_categories WHERE cat_id = '$cb'");
			if(mysqli_num_rows($res) > 0){
				$rowx = mysqli_fetch_assoc($res);
			}
			$o--;
			if($o == 0)
				$cat_str .= "".$rowx['cat_name']."";
			else
				$cat_str .= "".$rowx['cat_name'].",";
		}
		$qry1 = mysqli_query($conn,"UPDATE posts SET post_cat = '$cat_str' WHERE post_id = $k");
		if($qry && $qry1) {
			header('location:postmgmt.php');
		}
		else{
			echo"Operation Failed!!";
		}
	}
?>