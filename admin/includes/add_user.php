<?php

if(isset($_POST['create_user'])){
    
    $user_firstname=$_POST["user_firstname"];
    $user_lastname=$_POST["user_lastname"];
    $username=$_POST["username"];
    $user_role=$_POST["user_role"];
    $user_email=$_POST["user_email"];
    $user_password=$_POST["user_password"];

    $query="INSERT INTO users(username, user_password,user_firstname, user_lastname, user_email, user_role) VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";
    
    $query_to_create_post=mysqli_query($connection,$query);
    
    confirmQuery($query_to_create_post);   
    echo "User Created: "."<a href='users.php'>View Users</a>";
}
?>
   <h1 class="page-header">
    Add a user
    <small>Here you can add a new user.</small>
</h1>
   <form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
      <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
       <label for="user_role">Role</label>
       
       <select name="user_role" id="post_category_id">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>