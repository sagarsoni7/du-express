<?php include "includes/db.php" ?>
    <?php include "includes/header.php" ?>

    <!-- Navigation -->
    
<?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
             <div class="col-md-8">

                <h1 class="page-header">
                    DU Express
                    <small>Inpendent Student Run Platform</small>
                </h1>

                <!-- First Blog Post -->
        <?php
    
            if(isset($_GET["p_id"])){
                $the_post_id=$_GET["p_id"];
                $the_author=$_GET["author"];
               
                
            }

            $query ="SELECT * FROM posts WHERE post_author='{$the_author}'";
            $select_all_posts_query= mysqli_query($connection, $query);

            if(!$select_all_posts_query){
                die("Query toh fail ho gyi");

            }

            while($row=mysqli_fetch_assoc($select_all_posts_query)){

                $post_title=$row["post_title"];
                $post_author=$row["post_author"];
                $post_date=$row["post_date"];
                $post_image=$row["post_image"];
                $post_content=$row["post_content"];

        ?>
                
                <h2>
                    <a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
               <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>

                <?php } ?>

               <!-- Blog Comments - no -->
                

                <!-- Comments Form - no -->
                

              

                <!-- Posted Comments - no -->
               
                     <!-- Comment - no -->
          
    
                


            </div>

            <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <?php include "includes/footer.php" ?>