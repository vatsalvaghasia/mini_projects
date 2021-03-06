<?php include 'dbconnect.php';?>
<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: admin.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <!---------------------CSS--------------------->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">
	
  <title>Admin Panel</title>

  <!---------------------jquery--------------------->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function loadImg(){
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
}
    </script>
  <!---------------------END of jquery--------------------->
</head>
<body>
<!---------------------navbar--------------------->
	<div class = "navbar">
		<a href = "postmgmt.php" id ="blg-title">Blog Management</a>
		<a href="admin.php" class="btn btn-right red-btn">Log Out</a>
	</div>
 <!---------------------end of navbar--------------------->

 <!---------------------content--------------------->
	<div class = "contents">
    <?php
    $operation = $_GET['source'];
switch($operation){
    case 'add_post':include "actions/add_post.php";
                    break;
    case 'update_post':include 'actions/update_post.php';
    break;
    default:include "postmgmt.php";
                    break;
}
    ?>
</div>
<!---------------------end of content--------------------->
</body>
</html>