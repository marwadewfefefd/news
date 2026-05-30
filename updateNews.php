<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    if(!$connection->connect_error){
        // عند الضغط على زر التعديل ارسلت مع الرابط هذه البيانات 
        //ولكن ساقوم بالتعديل على البيانات واظهار القيم القديمة من خلال ال 
        //id because it will be more secure
        if(isset($_GET['id'])){
            $oldPostId=intval($_GET['id']);//since the data we get using $_GET is string 
            //getting the old data using the id we passed
        }else if(isset($_POST['newsPostId'])){
            $oldPostId=intval($_POST['newsPostId']);
        }
        //when we submit the form the id will disappear but we need it so
        //there is more than one way to solve this 
        //i will use a hidden type input to store the news post id
        

        //we need this sql statment to get the the posts old data to fill the nputs fields
        $sql="SELECT * FROM `news-posts` WHERE `post-id`=$oldPostId";
        $result=$connection->query($sql);
        $oldData=$result->fetch_assoc();

        
        if(isset($_POST['update-news'])){
            $newsPostId=intval($_POST['newsPostId']);
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
                    }
                    $newImageName=time().$imageName;//you can use also rand()
                    $imagePath='uploads/'.$newImageName;
                    move_uploaded_file($imageTmp,$imagePath);
                    
                    
                }
                //if the user did not change the old image 
                else{
                    $newImageName=$oldData['post-image'];
                }
                    $updateSql="UPDATE `news-posts` SET`post-title`='$newsTitle',`post-content`='$newsContent',`post-image`='$newImageName',`category-id`=$newsCategory,`user-id`=$newsUserId,`post-status`='active' WHERE `post-id`=$newsPostId";
                    $result=$connection->query($updateSql);
                    if($result){
                        header('location:news.php?updated=true');
                        
                    }else{
                        echo"<div class='alert alert-danger text-center'>لم يتم التعديل</div>";
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
            <input type="hidden" name="newsPostId" value="<?php echo $oldPostId ?>">
            <label>عنوان الخبر</label>
            <input type="text" class="form-control" value="<?php  echo  $oldData['post-title'] ;?>"name="news-title">
            </div>
            <div class="form-group">
            <label>فئة الخبر</label>
            <select class=" form-control" name="news-category">
                <?php
                $categoriesSql="select * from categories";
                $categoriesResult=$connection->query($categoriesSql);
                if($categoriesResult->num_rows>0){
                    while($categoryRow=$categoriesResult->fetch_assoc()){
                        $selected=($oldData['category-id']==$categoryRow['id'])?'selected':'';
                ?>

                        <option value="<?php echo $categoryRow['id'] ; ?>" <?php echo $selected;?>>
                            <?php echo $categoryRow['title']; ?>
                        </option>
                    <?php
                    }
                }
                ?>
                
            </select>

            </div>
            <div class="form-group">
            <label>صورة الخبر</label>
            <img src="<?php echo 'uploads/'.$oldData['post-image'] ;?>" style="width:200px;height:150px;">
            <input type="file" class="form-control" name="news-image">
            </div>
            <div class="form-group">
            <label>تفاصيل الخبر</label>
            <textarea class="form-control area" style="height:150px;" name="news-content"><?php echo $oldData['post-content']  ;?></textarea>
            <input type="submit" class="mt-4 btn btn-primary" name="update-news">
            </div>
            

        </form>
        </div>
    </div>
</div>


<?php
include('include/footer.php');
?>