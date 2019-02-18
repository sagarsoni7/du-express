<?php include "includes/admin_header.php"; ?>
<?php
if(isset($_SESSION["username"])){
$username= $_SESSION["username"];
$query="SELECT * FROM users WHERE username ='{$username}'";
    $select_user_profile_query=mysqli_query($connection, $query);
    while($row=mysqli_fetch_array($select_user_profile_query)){
            $user_id=$row['user_id'];
            $username=$row['username'];    
            $user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
            $user_image=$row['user_image'];
            $user_role=$row['user_role'];
    }

}

?>

<div id="wrapper">


<!-- Navigation -->
<?php  include "includes/admin_navigation.php"; ?>


<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
    Profile
    <small>Here you can edit your profile.</small>
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
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div>
</form>
<?php 
if(isset($_POST["update_profile"])){
    $username=$_POST["username"];
    $user_firstname=$_POST["user_firstname"];
    $user_lastname=$_POST["user_lastname"];
    $user_password=$_POST["user_password"];
    $user_email=$_POST["user_email"];
    $user_image=$_POST["user_image"];
    $user_role=$_POST["user_role"];
    
    $query = "UPDATE users SET ";
          $query .="username  = '{$username}', ";
          $query .="user_firstname = '{$user_firstname}', ";
          $query .="user_lastname = '{$user_lastname}', ";
          $query .="user_password   = '{$user_password}', ";
          $query .="user_image= '{$user_image}', ";
          $query .="user_role  = '{$user_role}' ";
          $query .= "WHERE username = '{$_SESSION["username"]}' ";
        
        $update_user = mysqli_query($connection,$query);
    header("Location: users.php");
    
    if(!$update_user){
        echo "query failed".mysqli_error($connection);
    }
}
?>   


<!-- view all posts above here  -->

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>