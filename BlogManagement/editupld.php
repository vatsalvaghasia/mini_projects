 <!DOCTYPE html>
 <html>
 <head>
 	<title>Update Post</title>
 	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">
 </head>
 <body>
 	<div class = "navbar">
		<a href = "postmgmt.php" id ="blg-title">Blog Management</a>
		<a href="admin.php" class="btn red-btn btn-right">Log Out</a>
	</div>
 <?php
 		include 'dbconnect.php';
    session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: admin.php");
    die();
}
    $id = $_GET['post_id'];
    $sql = "SELECT * FROM posts WHERE post_id = '$id'";
              $result = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($result);
              $sql1 = "SELECT cat_name FROM blog_categories";
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $arr_cat=[];
              $i = 0;
              if($count1 > 0){
                while($row = mysqli_fetch_array($result1)){
                  $arr_cat[$i] = $row['cat_name'];
                  $i++;
                }
              }

              if($count > 0){
               while($row = mysqli_fetch_assoc($result)) {
              $arrchecked = explode(",", $row['post_cat']);
                  echo "
                  <script>
                  $(document).ready(function(){
                      $('#alldata').hide();
                      $('#postadd').hide();
                      $('.alpostview').show();
                  });</script>
                  <div class = 'contents'>
                  <form id ='upd_form' method ='POST' enctype='multipart/form-data'>
                  <label>Title: </label><input type='text' name='title' value ='".$row['post_title']."' autocomplete='off' required><br>
                  <label>Description: </label><br><br><textarea name='desc' rows='5' cols='50' autocomplete='off' required>".$row['post_desc']."</textarea><br><br>
                  <label>Image: <br><img alt = 'No image Found' name = 'image' src='imagesuploaded/".$row['post_img']."' width='400' height='400' /></label><br><br>
                  <input type='file' name= 'imagefile' value='".$row['post_img']."' required><br><br>";

                  for($i = 0;$i < $count1 ;$i++){
                    if(in_array($arr_cat[$i], $arrchecked)){
                      echo "<label><input type='checkbox' value = '".($i+1)."' name = 'category[]'checked>".$arr_cat[$i]."</label>";
                      }
                    else{
                      echo "<label><input type='checkbox' value = '".($i+1)."' name = 'category[]'>".$arr_cat[$i]."</label>";
                    }
                  }
                  echo"<input type='submit' class='btn red-btn btn-right' name='update' value='Save Changes'>
                  </form>
                  </div>";
              }
          }
 		   
      	if(isset($_POST['update'])) {
      			$filename = $_FILES['imagefile']['name'];
      			$filetmpname = $_FILES['imagefile']['tmp_name'];
      			$folder = 'imagesuploaded/';
      			move_uploaded_file($filetmpname, $folder.$filename);
      			$title = $_POST['title'];
      	   $desc = $_POST['desc'];

        $cat_str = "";
        $o = count($_POST['category']);
        mysqli_query($conn,"DELETE FROM blog_posts_categories WHERE post_id = $id");
        foreach($_POST['category'] as $cb){ 
      mysqli_query($conn,"INSERT INTO blog_posts_categories(post_id,cat_id) VALUES('$id','$cb')");
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
      	if($filetmpname != ""){
		$sql = "UPDATE posts SET post_title = '$title',post_desc = '$desc', post_img = '$filename', post_cat = '$cat_str' WHERE post_id = '$id'";
		}
		else{
			$sql = "UPDATE posts SET post_title = '$title',post_desc = '$desc',post_cat = '$cat_str' WHERE post_id = '$id'";
		}
		$qry = mysqli_query($conn, $sql);
		if($qry) {
			header('location:postmgmt.php');
			echo "<script>Alert('Operation Successfull!!')</script>";
		}
		else{
			header('location:editpost.php');
			echo "<script>Alert('Operation Failed!!')</script>";
		}

 }
              

		exit();
?>
 </body>
 </html>