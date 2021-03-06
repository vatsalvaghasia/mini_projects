<?php
		session_start();
		include "dbconnect.php";
		$uname = $_POST['username'];
		$pass = $_POST['password'];
		if(isset($uname) && isset($pass)){
			$sql = "SELECT * FROM admins WHERE username ='$uname' && password='$pass'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$_SESSION["userLogin"]="loggedIn";
				header('location:postmgmt.php');

			}
			else{
				header('location:admin.php');
			}
		}
?>