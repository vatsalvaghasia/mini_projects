<?php
	include "dbconnect.php";
	session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: admin.php");
    die();
}
	$sql1 = "DELETE FROM posts";
	$sql2 = "DELETE FROM blog_posts_categories";	
	$sql3 = "ALTER TABLE posts AUTO_INCREMENT = 1";
	$res1 = mysqli_query($conn, $sql1);
	$res2 = mysqli_query($conn, $sql2);	
	$res3 = mysqli_query($conn, $sql3);
	if($res1 && $res2 && $res3){
		header('location:postmgmt.php');
	}
	else{
		echo "Deletion Failed!!";
	}
	
?>