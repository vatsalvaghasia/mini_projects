<?php
include "dbconnect.php";
function post_add(){
    global $conn;
    if(isset($_POST['fileupload'])) {
      $dir = 'imagesuploaded/';
      $filename = $_FILES['imagefile']['name'];
      $target_file = $dir.basename($filename);
      $filetmpname = $_FILES['imagefile']['tmp_name'];
        if(move_uploaded_file($filetmpname, $target_file)){
          echo $target_file;
        }
        $title = $_POST['title'];
        $desc = $_POST['desc'];
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
      $rowx = mysqli_fetch_assoc($res);
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
}
post_add();

function update_post(){
  global $conn;
  if(isset($_POST['update'])) {
    $id = $_GET['post_id'];
      $dir = 'imagesuploaded/';
      $filename = $_FILES['imagefile']['name'];
      $target_file = $dir.basename($filename);
      $filetmpname = $_FILES['imagefile']['tmp_name'];
      move_uploaded_file($filetmpname, $target_file);
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
}
}
update_post();
?>