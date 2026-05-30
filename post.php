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
            if(isset($_GET['id'])){
                $post_id=$_GET['id'];
                $post_author=$_GET['post_author'];
                $category=$_GET['category'];
            
                $sql="SELECT * FROM `news-posts` WHERE `post-id`=$post_id";
                $result=$connection->query($sql);
                $row=$result->fetch_assoc();

        ?>
        <div class="dashboard-post p-4 mb-3 pb-5 mt-5 text-center" style="background-color:white;height:600px;">
            <div class="post-image h-75"><img class="img-fluid w-100 h-100" src="<?php echo 'uploads/'.$row['post-image'];?>"></div>
            <div class="post-title text-center text-primary"><h4><?php echo $row['post-title'];?></h4></div>
            <div class="post-details">
                <p class="post-info text-secondary">
                <span ><i class="fas fa-user"></i><?php echo $post_author ;?></span>
                <span class="fas fa-tags"><?php echo $category ;?></span>
                </p>
            </div>
            <p class="postContent">         
                <?php
                    echo $row['post-content'];
                ?> 
            </p>
            
        </div>
        <?php
        
        }}?>

    </div>

</div>
</div>






<?php
include('include/footer.php');
?>