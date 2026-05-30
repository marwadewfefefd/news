<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    if(!$connection->connect_error){ 
        $news_id=$_GET['id'];
        echo $news_id;
        $sql="UPDATE `news-posts` SET `post-status`='deleted' WHERE `post-id`=$news_id";
        $result=$connection->query($sql);
        if($result){
            header('location:news.php?deleted=true');
            
        }else{
            echo"<div class='alert alert-danger text-center'>لم يتم الحذف</div>";
        }

    }
    ?>




<?php
include('include/footer.php');
?>