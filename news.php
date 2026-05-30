<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    if(isset($_GET['deleted'])){
        if($_GET['deleted']=='true'){
            echo"<div class='alert alert-success text-center'>تم حذف الخبر بنجاح</div>";
        }
    }
    if(isset($_GET['updated'])){
        if($_GET['updated']=='true'){
            echo"<div class='alert alert-success text-center'>تم تعديل الخبر بنجاح</div>";
        }
    }
    if(isset($_GET['created'])){
        if($_GET['created']=='true'){
            echo"<div class='alert alert-success text-center'>تم إضافة الخبر بنجاح</div>";
        }
    }
    ?>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <table class="table">
                    <tr class="bg-primary text-light">
                        <th>رقم الخبر</th>
                        <th>عنوان الخبر</th>
                        <th>فئة الخبر </th>
                        <th>تفاصيل الخبر</th>
                        <th>صورة الخبر</th>
                        <th>الكاتب</th>
                        <th>تعديل الخبر </th>
                        <th>حذف الخبر</th>
                    </tr>
                    <?php
                if(!$connection->connect_error){    
                    $sql="SELECT * FROM `news-posts` where `post-status`='active'";
                    $result=$connection->query($sql);
                    $count=1;
                    if($result->num_rows>0){
                        
                        while($row=$result->fetch_assoc()){
                            $catgory_id=$row['category-id'];
                            // echo $catgory_id;
                            $sql2="SELECT `title` FROM `categories` WHERE id=$catgory_id ";
                            $result2=$connection->query($sql2);
                            $row2=$result2->fetch_assoc();
                            
                            $category_title= $row2['title'];
                            
                            ?>
                            <tr class="bg-light ">
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $row['post-title'] ;?> </td>
                                <td><?php echo $category_title ;?> </td>
                                <td><?php echo $row['post-content'] ; ?> </td>
                                <td><img src="<?php echo 'uploads/'.$row['post-image'] ; ?>" style="width:200px;height:150px;"> </td>
                                <td><?php echo $_SESSION['user_data']['Name'] ;?> </td>
                                <td><a href="updateNews.php?id=<?php echo $row['post-id'];?>&news_title=<?php echo $row['post-title'];?>&news_category=<?php echo $category_title;?>&news_image=<?php echo $row['post-image'];?>&news_content=<?php echo $row['post-content'];?>" class="btn btn-primary">تعديل</td>
                                <td><a href="delete_news_logic.php?id=<?php echo $row['post-id'];?>" class="btn btn-danger">حذف</td>
                               
                            </tr>







                        <?php
                        // echo $row['post-id']; echo $row['post-title']; echo $category_title;echo $row['post-image'];echo $row['post-content'];
                        }
                    }
                }
                   ?>
                </table>

    </div>
        </div>
            </div>



<?php
include('include/footer.php');
?>







