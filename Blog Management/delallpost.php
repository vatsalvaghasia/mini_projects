<?php
	include "dbconnect.php";
	session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: admin.php");
    die();
}
	$sql = "DELETE FROM posts";
	$sql1 = "DELETE FROM blog_posts_categories";
	$sql2 = "ALTER TABLE posts AUTO_INCREMENT = 1";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql1);
	mysqli_query($conn, $sql2);
	header('location:postmgmt.php');
?>