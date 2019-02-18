<h1 class="page-header">
    Users
    <small>Here you can manage all users.</small>
</h1>
   <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
           <th>Change Role</th>
           <th>Change Role</th>
           <th>Edit User</th>
           <th>Remove User</th>
           
        </tr>
    </thead>
    <tbody>
       
            <?php
            $query="SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            while($row=mysqli_fetch_assoc($select_users)){
            $user_id=$row['user_id'];
            $username=$row['username'];    
            $user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
            $user_image=$row['user_image'];
            $user_role=$row['user_role'];
                
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
//                $query="SELECT * FROM categories WHERE cat_id=$post_category_id";
//                $select_categories_id = mysqli_query($connection, $query);
//                while($row=mysqli_fetch_assoc($select_categories_id)){
//                $cat_id=$row['cat_id'];
//                $cat_title=$row['cat_title'];
//                echo "<td>{$cat_title}</td>";
//                }                   
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
                
                
//            $query="SELECT * FROM posts WHERE post_id={$comment_post_id}";
//            $select_post_id_query=mysqli_query($connection, $query);
//                
//                while($row=mysqli_fetch_assoc($select_post_id_query)){
//                    $post_id=$row["post_id"];
//                    $post_title=$row["post_title"];
//                    
//                    echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
//                }
           
      
            echo "<td><a href='users.php?make_admin={$user_id}'>Make Admin</a></td>";
            echo "<td><a href='users.php?make_subscriber={$user_id}'>Make Subsciber</a></td>";
            echo "<td><a href='users.php?source=edit_user&eu={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
            }
        
        ?>
       
    </tbody>
</table>


<?php
if(isset($_GET['delete'])){
    $the_user_id=$_GET['delete'];
    $query="DELETE FROM `users` WHERE `users`.`user_id` = {$the_user_id}";
    $delete_query=mysqli_query($connection, $query);
    header("Location: users.php");
}
if(isset($_GET['make_admin'])){
    $the_user_id=$_GET['make_admin'];
    $query="UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
    $approve_query=mysqli_query($connection, $query);
    header("Location: users.php");
}
if(isset($_GET['make_subscriber'])){
    $the_user_id=$_GET['make_subscriber'];
    $query="UPDATE users SET user_role='subscriber' WHERE user_id=$the_user_id";
    $approve_query=mysqli_query($connection, $query);
    header("Location: users.php");
}




?>