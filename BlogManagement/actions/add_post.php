<form method = "POST" id = "postadd" action = "functions.php" enctype='multipart/form-data'> 
    <label>Enter Title of The Post: </label><input type="text" name= "title" autocomplete="off" required><br>
    <label>Enter the Decription of the Post: </label><br><br><textarea name="desc" required autocomplete="off"></textarea><br><br>
    <label>Select the category of the post:</label><br><br>
    <?php 
    $sql = "SELECT * FROM blog_categories";
                  $result = mysqli_query($conn,$sql);
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      echo"
                  <label><input type='checkbox' name='category[]' value='".$row['cat_id']."'>".$row['cat_name']."</label>";
                    }
                  } 
    ?>
    <br><br>
         <label>Upload Image: </label>
         <input type='file' name= 'imagefile' onchange='loadImg()'><br>
         <img id="frame"  width="300px" height="200px"/>
         <input type='submit' class='btn blue-btn btn-right' name='fileupload' value='Save'>
         <a href='postmgmt.php' class='btn red-btn btn-right'>Cancel</a>
  </form>