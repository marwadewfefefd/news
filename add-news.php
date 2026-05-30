<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    if(!$connection->connect_error){
        if(isset($_POST['add-news'])){
            $newsTitle=$_POST['news-title'];
            $newsCategory=$_POST['news-category'];
            $newsContent=$_POST['news-content'];
            $newsUserId=$_SESSION['user_data']['Id'];
            
            if(empty($newsTitle)||empty($newsContent)||strlen($newsContent)==0){
                echo"<div class='alert alert-danger text-center'>الرجاء ملء جميع الحقول</div>";
            }else{
                if(isset($_FILES['news-image']) && $_FILES['news-image']['error']==0){
                    $imageName=$_FILES['news-image']['name'];
                    $imageTmp=$_FILES['news-image']['tmp_name'];
                    $imageSize=$_FILES['news-image']['size'];
                    $imageType=$_FILES['news-image']['type'];
                    $allowedTypes=['image/jpeg','image/png','image/gif'];
                    if(!in_array($imageType,$allowedTypes)){
                        echo"<div class='alert alert-danger text-center'> نوع الملف غير مسموح به</div>";
                    }else{
                    
                    $newImageName=time().$imageName;//you can use also rand()
                    $imagePath='uploads/'.$newImageName;
                    //to move the image from tmp to the new folder which is uploads
                    if(move_uploaded_file($imageTmp,$imagePath)){
                        $sql="INSERT INTO `news-posts`(`post-title`, `post-content`, `post-image`, `category-id`, `user-id`, `post-status`) VALUES ('$newsTitle','$newsContent','$newImageName',$newsCategory,$newsUserId,'active') ";
                        $result=$connection->query($sql);
                        if($result){
                            header('location:news.php?created=true');
                        }
                        echo "<div class='alert alert-success text-center'>تم إضافة الخبر</div>";
                    }
                    
                    }
                }else{
                    echo"<div class='alert alert-danger text-center'>الرجاء ملء جميع الحقول</div>";
                }


            }
        }
    }
    ?>

    <div class="add-cat-continer continer">
    <div class="row d-flex justify-content-center mt-5 w-100">
        <div class="col-10">
        <form class="w-100" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
            <label>عنوان الخبر</label>
            <input type="text" class="form-control" name="news-title">
            </div>
            <div class="form-group">
            <label>فئة الخبر</label>
            <select class=" form-control" name="news-category">
                <?php
                $sql="select * from categories";
                $select_result=$connection->query($sql);
                if($select_result->num_rows>0){
                    while($row=$select_result->fetch_assoc()){
                ?>

                        <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                    <?php
                    }
                }
                ?>
                
            </select>

            </div>
            <div class="form-group">
            <label>صورة الخبر</label>
            <input type="file" class="form-control"  name="news-image">
            </div>
            <div class="form-group">
            <label>تفاصيل الخبر</label>
            <textarea class="form-control area" style="height:150px;" name="news-content"></textarea>
            <input type="submit" class="mt-4 btn btn-primary" name="add-news">
            </div>
            

        </form>
        </div>
    </div>
</div>
















<?php
include('include/footer.php');
?>