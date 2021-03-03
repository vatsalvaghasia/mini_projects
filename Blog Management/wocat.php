<?php 
include 'dbconnect.php';
              


              //define total number of results you want per page  
    $results_per_page = 5;  
  
    //find the total number of results stored in the database  
    $sql = "SELECT * from posts";  
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
    //display the retrieved result on the webpage  
    if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          echo "
          <article class='entry' >

              <div class='entry-img'>
                <img src='imagesuploaded/".$row['post_img']."' alt='some image' class='img-fluid'>
              </div>

              <h2 class='entry-title'>
                <a href='blog-single.html'>".$row['post_title']."</a>
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
                  ".$row['post_desc']."
                </p>
              </div>

            </article>
          ";
          }
      }
      echo "<div id = 'link-box'>";
    //display the link of the pages in URL  
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a id = "link-btn" href = "blog.php?page=' . $page . '">' . $page . ' </a>'. "&nbsp;";  
    }  
      echo "</div>";




          
 ?>