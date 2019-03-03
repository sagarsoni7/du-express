<?php
function users_online(){
    global $connection;
    
     $session= session_id();
    $time=time();
    $time_out_in_seconds=60;
    $time_out = $time - $time_out_in_seconds;
    
    $query="SELECT * FROM users_online WHERE session='$session'";
    $send_query=mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);
    
    if($count==NULL){
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session',$time)");
    }else{
        mysqli_query($connection, "UPDATE users_online SET time=$time WHERE session='$session'");
    }
    $users_online_query=mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");
    
    return $count_user=mysqli_num_rows($users_online_query);
}

function confirmQuery($result){
    global $connection;
    if(!$result){
        die("Query Failed. ".mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;
     if(isset($_POST["submit"])){
        $cat_title = $_POST["cat_title"];
        
        if($cat_title=="" || empty($cat_title)){
            echo "This field should not be empty";
        } else{
            $query="INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            header("Location: categories.php");
            
            if(!$create_category_query){
                die("Failed to add category ".mysqli_error($connection));
            }
        }
    }
    
    
}

function findAllCategories(){
        global $connection;
        $query="SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        while($row=mysqli_fetch_assoc($select_categories)){
        $cat_id=$row['cat_id'];
        $cat_title=$row['cat_title'];
        echo "<tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td><a href='categories.php?delete={$cat_id}'>Delete</td>
        <td><a href='categories.php?edit={$cat_id}'>Edit</td>
        </tr>";
        }
}


function deleteCategories(){
            global $connection;
            if(isset($_GET["delete"])){
            $the_cat_id=$_GET["delete"];
            $query="DELETE FROM categories WHERE cat_id={$the_cat_id}";
            $query_to_delete= mysqli_query($connection, $query);
            header("Location: categories.php");
            }
}

?>