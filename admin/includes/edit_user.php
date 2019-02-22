<?php

if(isset($_GET["eu"])){
    $eu_id=$_GET["eu"];
    
} else{
    $eu_id=1;
}

$query="SELECT * FROM users WHERE user_id=$eu_id";
$select_user_by_id=mysqli_query($connection, $query);



while($row=mysqli_fetch_assoc($select_user_by_id)){
    $user_id=$row["user_id"];
    $username=$row["username"];
    $user_password=$row["user_password"];
    $user_firstname=$row["user_firstname"];
    $user_lastname=$row["user_lastname"];
    $user_email=$row["user_email"];
    $user_image=$row["user_image"];
    $user_role=$row["user_role"];
    


?>
   <h1 class="page-header">
    Edit User
    <small>Here you can edit a user.</small>
</h1>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
       <label for="user_lastname">Lastname</label>
        <input value="<?php echo $user_lastname; ?>" type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_image">Image</label>
        <input value="<?php echo $user_image; ?>" type="text" name="user_image" class="form-control">
    </div>
     <div class="form-group">
        <label for="user_role">Role</label>
      
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
            if($user_role=="admin"){
                ?> <option value="subscriber">subscriber</option>     <?php
            }else{
                ?> <option value="admin">admin</option>     <?php
            }
            
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
</form>
<?php } ?> 
  <?php 
if(isset($_POST["update_user"])){
    $username=$_POST["username"];
    $user_firstname=$_POST["user_firstname"];
    $user_lastname=$_POST["user_lastname"];
    $user_password=$_POST["user_password"];
    $user_email=$_POST["user_email"];
    $user_image=$_POST["user_image"];
    $user_role=$_POST["user_role"];
    
    
    $query="SELECT randSalt FROM users";
    $select_randsalt_query=mysqli_query($connection,$query);
    if(!$select_randsalt_query){
        die("Query Failed".mysqli_error($connection));
    }
    $row=mysqli_fetch_array($select_randsalt_query);
    $salt=$row["randSalt"];
    $hashed_password=crypt($user_password, $salt);
    
    $query = "UPDATE users SET ";
          $query .="username  = '{$username}', ";
          $query .="user_firstname = '{$user_firstname}', ";
          $query .="user_lastname = '{$user_lastname}', ";
          $query .="user_password   = '{$hashed_password}', ";
          $query .="user_image= '{$user_image}', ";
          $query .="user_role  = '{$user_role}' ";
          $query .= "WHERE user_id = {$eu_id} ";
        
        $update_user = mysqli_query($connection,$query);
    header("Location: users.php");
    
    if(!$update_user){
        echo "query failed".mysqli_error($connection);
    }
}
?>   
   