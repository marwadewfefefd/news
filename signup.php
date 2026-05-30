    <?php 
    session_start();
    include("include/connection.php");
    if(!$connection->connect_error){
        if(isset($_POST["signup-button"])){
            $userName=validate_data($_POST['user-name']);
            $userEmail=validate_data($_POST['user-email']);
            $userPassword=password_hash($_POST['user-password'],PASSWORD_BCRYPT);
            if(empty($userName)||empty($userEmail)||empty($userPassword)){
                echo "<div class='alert alert-danger text-center'>الرجاء ملء الحقل ادناه </div>";
            }else{
            $sql="INSERT INTO `users`(`Name`, `Email`, `Password`) values ('$userName','$userEmail','$userPassword')";
            $result=$connection->query($sql);
                if($result){
                    echo"<div class='alert alert-success text-center'>تم إنشاء الحساب بنجاح سيتم تحويلك لصفحة تسجيل الدخول</div>";
                    header('REFRESH:5;URL=login.php');
                    // header('location:login.php');
                }
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="css/font/Janna_LT_Regular.ttf">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/style.css">



</head>
<body>
    <div class="signup-form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h1>إنشاء حساب</h1>
            <div class="inputs ">
                <div>
                    <label>الاسم:</label>
                    <input class="form-control" type="text" name="user-name">
                </div>
                <div>
                    <label>الايميل:</label>
                    <input class="form-control" type="email" name="user-email">
                </div> 
                <div>
                    <label>كلمة المرور:</label>
                    <input class="form-control" type="password" name="user-password">
                </div>
            </div>
            <div class="form-buttons d-flex justify-content-center mt-3">
                <input type="submit" class="btn btn-primary" name="signup-button" value="إنشاء حساب" ></input>
            </div>
        </form>

    </div>
</body>
</html>