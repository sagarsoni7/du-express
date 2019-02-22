<?php

if(isset($_GET["ep"])){
    $ep_id=$_GET["ep"];
    
} else{
    $ep_id=1;
}

$query="SELECT * FROM posts WHERE post_id=$ep_id";
$select_posts_by_id=mysqli_query($connection, $query);



while($row=mysqli_fetch_assoc($select_posts_by_id)){
     $post_id=$row["post_id"];
    $post_title=$row["post_title"];
    $post_author=$row["post_author"];
    $post_category_id=$row["post_category_id"];
    $post_status=$row["post_status"];
    $post_image=$row["post_image"];
    $post_tags=$row["post_tags"];
    $post_content=$row["post_content"];
    


?>
   <h1 class="page-header">
    Edit Post
    <small>Here you can edit the post.</small>
</h1>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
       <label for="post_category">Post Category</label>
        <select name="post_category_id" class="form-control" id="post_category_id">
            <?php
            $query="SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
   
            while($row=mysqli_fetch_assoc($select_categories)){
            $cat_id=$row['cat_id'];
            $cat_title=$row['cat_title'];
             echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        
        <select name="post_status" class="form-control">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            if($post_status=="draft"){
                echo "<option value='published'>published</option>";
            }else{
                echo "<option value='draft'>draft</option>";
            }
            
            
            ?>
        </select>
        
    
    </div>
    <div class="form-group">
       <label for="post_image">Post Image</label>
        <img src="../images/<?php echo $post_image; ?>" class='img-responsive' width=100>
        <input  type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="editor" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>
<?php } ?> 
  <?php 
if(isset($_POST["update_post"])){
    $post_title=$_POST["post_title"];
    $post_author=$_POST["post_author"];
    $post_category_id=$_POST["post_category_id"];
    $post_status=$_POST["post_status"];
    $post_image=$_FILES["image"]["name"];
    $post_image_temp=$_FILES["image"]["tmp_name"];
    $post_tags=$_POST["post_tags"];
    $post_content=$_POST["post_content"];
    move_uploaded_file($post_image_temp, "../images/$post_image");
     if(empty($post_image)) {
        
        $query = "SELECT * FROM posts WHERE post_id =$ep_id";
        $select_image = mysqli_query($connection,$query);
            
        while($row = mysqli_fetch_array($select_image)) {
            
           $post_image = $row['post_image'];
        
        }
         
     }
    
    $query = "UPDATE posts SET ";
          $query .="post_title  = '{$post_title}', ";
            $query .="post_author  = '{$post_author}', ";
          $query .="post_category_id = '{$post_category_id}', ";
          $query .="post_date   =  now(), ";
          
          $query .="post_status = '{$post_status}', ";
          $query .="post_tags   = '{$post_tags}', ";
          $query .="post_content= '{$post_content}', ";
          $query .="post_image  = '{$post_image}' ";
          $query .= "WHERE post_id = {$ep_id} ";
        
        $update_post = mysqli_query($connection,$query);
    
    
    if(!$update_post){
        echo "query failed".mysqli_error($connection);
    }
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$ep_id}'>View Post</a> OR <a href='posts.php'>Edit more posts</a></p>";
}
?>   
   