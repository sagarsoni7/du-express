<?php

if(isset($_POST['create_post'])){
    
    $post_title=$_POST["title"];
    $post_author=$_POST["author"];
    $post_category_id=$_POST["post_category_id"];
    $post_status=$_POST["post_status"];
    $post_image=$_FILES["image"]["name"];
    $post_image_temp=$_FILES["image"]["tmp_name"];
    $post_tags=$_POST["post_tags"];
    $post_content=$_POST["post_content"];
    $post_date= date("d-m-y");
    
    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query="INSERT INTO posts(post_category_id, post_title, post_author,post_date, post_image, post_content, post_tags, post_status) VALUES('{$post_category_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
    
    $query_to_create_post=mysqli_query($connection,$query);
    
    confirmQuery($query_to_create_post);
    
    
}



?>
   <h1 class="page-header">
    Add a post
    <small>Here you can create a new post.</small>
</h1>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
      
       <select class="form-control" name="post_category_id" id="post_category_id">
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
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        
        <select name="post_status" class="form-control">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="editor" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>