<?php 
    $id = $_GET['post_id'];
    $sql = "SELECT * FROM posts WHERE post_id = '$id'";
    $sql1 = "SELECT cat_name FROM blog_categories";
    $result = mysqli_query($conn, $sql);
    $result1 = mysqli_query($conn,$sql1);
    $count = mysqli_num_rows($result);
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
?>
<form id ="upd_form" method ="POST" enctype='multipart/form-data' action = 'functions.php?post_id=<?php echo $id;?>'>
<label>Title: </label><input type='text' name='title' value ='<?php echo $row['post_title']?>' autocomplete='off' required><br>
<label>Description: </label><br><br><textarea name='desc' rows='5' cols='50' autocomplete='off' required><?php echo $row['post_desc']?></textarea><br><br>
<label>Image: <br><img alt = 'No image Found' name = 'image' src='imagesuploaded/<?php echo $row['post_img']?>' width='300' height='200' /></label><br><br>
<input type='file' name= 'imagefile' value='<?php echo $row['post_img']?>'><br><br>
<?php
for($i = 0    ;$i < $count1 ;$i++){
    if(in_array($arr_cat[$i], $arrchecked)){
    echo "<label><input type='checkbox' value = '".($i+1)."' name = 'category[]'checked>".$arr_cat[$i]."</label>";
    }
    else{
    echo "<label><input type='checkbox' value = '".($i+1)."' name = 'category[]'>".$arr_cat[$i]."</label>";
    }
}
?>
<input type='submit' class='btn red-btn btn-right' name='update' value='Save Changes'>
</form>
<?php
              }
          }     	
 ?>
         