<?php include 'dbconnect.php';?>
<?php
session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: admin.php");
    die();
}
        if(isset($_POST['delmultiple']) && isset($_POST['check'])){
          $checkbox = $_POST['check'];
          for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i]; 
            mysqli_query($conn,"DELETE FROM posts WHERE post_id='$del_id'");
             mysqli_query($conn,"DELETE FROM blog_posts_categories WHERE post_id='$del_id'");
          }
        }
        if(isset($_POST['updblog']) && isset($_POST['check'])){
          $checkbox = $_POST['check'];
          if(count($checkbox) == 1){
            $upd_id = $checkbox[0];
           }
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
   $(document).ready(function(){
    $('#del-all-btn').click(function(){
    var res = confirm('Are You Sure You want to Delete All the Posts?');
    if(!res) {
        $('#del-all-btn').attr("name","no-del");
    }
    else {
        $('#del-all-btn').attr("name","del");
        $('#del-all-btn').attr("href","delallpost.php");
    }
});
      $('.alpostview').hide();
      $("#checkAl").click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
});
    });
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
    <form method = 'POST' id='form1'>
		<a href="posts.php?source=add_post" type="submit" name='newpost' id='postnew' class="btn blue-btn blue-border">Add Post</a>
		<a class="btn red-btn" id="del-all-btn" name="no-del">Delete All Posts</a>
      <input type="submit" name ='delmultiple' class="btn red-btn" value ="Delete Posts">
      <a class='alpostview btn red-btn btn-right' href="postmgmt.php">View All Posts</a>
      

      <label class='opt btn-right'><input type="submit" class="btn red-btn btn-right" name="sub">Show
      <select name='numentries' class='entries btn red-btn'>
        <option value ='5'>5</option>
        <option value ='10'>10</option>
        <option value ='15'>15</option>
        <option value ='20'>20</option>
      </select>posts</label>
          
		<table id='alldata'>
  		<tr>
    		<th>Select All <br><input type="checkbox" id="checkAl"></th>
    		<th>Id</th>
    		<th>Title</th>
    		<th>Image</th>
    		<th>Description</th>
        <th>Actions</th>
        <th>Category</th>
  		</tr>
  		<?php 

      //define total number of results you want per page
      if(isset($_POST['sub'])){ 
    $results_per_page = $_POST['numentries'];
    }  
  else{
    $results_per_page = 5;
  }
  
    //find the total number of results stored in the database  
    $sql = "SELECT * FROM posts";   
    $result = mysqli_query($conn, $sql);  
    $number_of_result = mysqli_num_rows($result);  
  
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }   
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
    $sql = "SELECT * FROM posts LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $sql);  
      $endcount = mysqli_num_rows($result);
    //display the retrieved result on the webpage  
    if ($endcount > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            $desc_string="";
            if(strlen($row['post_desc'])>20)
              $desc_string = substr($row['post_desc'], 0,20)."...";
            else
              $desc_string = $row['post_desc'];
          echo "
          <tr>
          <td><input type = 'checkbox' name = 'check[]' value = '".$row['post_id']."'></td>
          <td>".$row['post_id']."</td>
          <td><b>".$row['post_title']."</b></td>
          <td><img alt = 'some image' src='imagesuploaded/".$row['post_img']."' width= 50 height= 50></td>
          <td>".$desc_string."</td>
          <td><a name='blog_upd' class='btn yellow-btn' href='posts.php?post_id=".$row['post_id']."&source=update_post'>Edit</a></td>
          <td>".$row['post_cat']."</td>
          </tr>"; 
          }
        }
  		?>
		</table><br><br>
    <div id = 'link-box'>
    <?php
    $pg = $page;
    $temppg  = $pg;
    if($pg != 1){
      $temppg = $pg - 1;
    }
    echo '<div id="box1"><div id="keepleft">Showing entries '.($page_first_result+1).' to '.($page_first_result+$endcount).' of '.$number_of_result.' entries</div>';
    echo '<a class ="btn red-btn" href = "postmgmt.php?page=' . $temppg . '"> Previous </a>'.'&nbsp;';
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a class ="btn red-btn" href = "postmgmt.php?page=' . $page . '">' . $page . ' </a>'.'&nbsp;';
        }  
    if($pg >= $number_of_page){ $pg = $number_of_page;} 
    else{ $pg +=1; }
    echo '<a class ="btn red-btn" href = "postmgmt.php?page=' . $pg . '"> Next </a>'.'&nbsp;</div>';
     ?>
   </div>
  </form>
    <?php
        
?>
<!---------------------end of content--------------------->
</body>
</html>