<?php
include "dbconnect.php";
    if(isset($_POST['cate'])){
    $cat = $_POST['cate'];
    for($i = 0;$i < count($cat);$i++){
    $catname = $cat[$i];
    $qry = "SELECT cat_id FROM blog_categories WHERE cat_name = '$catname'";
    $ans = mysqli_query($conn,$qry);
    $cnt = mysqli_num_rows($ans);
    if($cnt > 0){
      $row = mysqli_fetch_assoc($ans);
        $sql1 = "SELECT * FROM posts INNER JOIN blog_posts_categories WHERE posts.post_id =blog_posts_categories.post_id AND blog_posts_categories.cat_id = ".$row['cat_id']."";
        $result1 = mysqli_query($conn,$sql1);
        $count = mysqli_num_rows($result1);
        if($count > 0){
          while($row1 = mysqli_fetch_assoc($result1)){
            echo"
              <script type='text/javascript'>
                $(document).ready(function(){
                $('.nocats').hide();
              });
              </script>
          <article class='entry' >

              <div class='entry-img'>
                <img src='imagesuploaded/".$row1['post_img']."' alt='some image' class='img-fluid'>
              </div>

              <h2 class='entry-title'>
                <a href='blog-single.html'>".$row1['post_title']."</a>
              </h2>

              <div class='entry-meta'>
                <ul>
                  <li class='d-flex align-items-center'><i class='icofont-user'></i><a href = '#'>John Doe</a></li>
                  <li class='d-flex align-items-center'><i class='icofont-wall-clock'></i> <a href='#'><time datetime='2020-01-01'>Jan 1, 2020</time></a></li>
                  <li class='d-flex align-items-center'><i class='icofont-comment'></i> <a href='#'>12 Comments</a></li>
                </ul>
              </div>

              <div class='entry-content'>
                <p>
                  ".$row1['post_desc']."
                </p>
              </div>

            </article>
          ";
        }
        }
      }
    
  }
}
?>