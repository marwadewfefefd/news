<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}
    if(!$connection->connect_error){
        if(isset($_POST['add-category'])){
            $category=$_POST['category'];
            if(empty($category)){
                echo"<div class='alert alert-danger text-center'>الرجاء ملء الحقل ادناه</div>";
            }else{
                $sql="insert into categories (title) values ('$category')";
                $result=$connection->query($sql);
                if($result){
                    echo"<div class='alert alert-success text-center'>تمت عملية الإضافة بنجاح</div>";
                }
            }
        }
    }
    ?>

    <div class="add-cat-continer continer">
    <div class="row d-flex justify-content-center mt-5 w-100">
        <div class="col-10">
        <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
            <label>فئة جديدة</label>
            <input type="text" class="form-control" name="category">
            <input type="submit" class="mt-4 btn btn-primary" name="add-category">
            </div>

        </form>
        </div>
    </div>
</div>
















<?php
include('include/footer.php');
?>