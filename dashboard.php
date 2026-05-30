<?php
    session_start();
    // echo $_SESSION['user'];
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    ?>


    <div class="container">
    <div class="row">
    <div class="dashboard-posts col-11 ">
        <?php
        if(!$connection->connect_error){
        $sql="SELECT * FROM `news-posts` WHERE `post-status`='active'";
        $result=$connection->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $post_author_id=$row['user-id'];
                $author_sql="SELECT `Name` FROM `users` WHERE `Id`=$post_author_id ";
                $author_result=$connection->query($author_sql);
                $author_data_row=$author_result->fetch_assoc();
                $author_name=$author_data_row['Name'];
                ////////////////////
                $post_category_id=$row['category-id'];
                $category_sql="SELECT title FROM `categories` WHERE `id`=$post_category_id";
                $category_result=$connection->query($category_sql);
                $category_data_row=$category_result->fetch_assoc();
                $category_name=$category_data_row['title'];

        ?>
        <div class="dashboard-post p-4 mb-3 pb-5 mt-5 text-center" style="background-color:white;height:600px;">
            <div class="post-image h-75"><img class="img-fluid w-100 h-100" src="<?php echo 'uploads/'.$row['post-image'];?>"></div>
            <div class="post-title text-center text-primary"><h4><?php echo $row['post-title'];?></h4></div>
            <div class="post-details">
                <p class="post-info text-secondary">
                <span ><i class="fas fa-user"></i><?php echo $author_name ;?></span>
                <span class="fas fa-tags"><?php echo $category_name ;?></span>
                </p>
            </div>
            <p class="postContent">         
                <?php
                    if(strlen($row['post-content'])>200){
                        $row['post-content']=substr($row['post-content'],0,300)."....";
                    }
                    echo $row['post-content'];
                ?> 
            </p>
            <a href="post.php?id=<?php echo $row['post-id']; ?>&post_author=<?php echo $author_name ;?>&category=<?php echo $category_name ?>" class="btn btn-custom bg-primary text-light ">اقرأ المزيد</a>
        </div>
        <?php
        
        }}}?>

    </div>

</div>
</div>






<?php
include('include/footer.php');
?>
