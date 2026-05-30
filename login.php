    <?php 
    session_start();
    include("include/connection.php");
    if(!$connection->connect_error){
        if(isset($_POST["login-button"])){
            $userName=validate_data($_POST['user-name']);
            $userEmail=validate_data($_POST['user-email']);
            $userPassword=$_POST['user-password'];
            if(empty($userName)||empty($userEmail)||empty($userPassword)){
                echo "<div class='alert alert-danger text-center'>الرجاء ملء الحقل ادناه </div>";
            }else{
                $sql="SELECT * FROM `users` WHERE `Name`='$userName' AND `Email`='$userEmail' ";
                $result=$connection->query($sql);
                if($result->num_rows>0){
                    $data=$result->fetch_assoc();
                    if(password_verify($userPassword,$data['Password'])){
                        $_SESSION['user_data']=$data;
                        echo "<div class='alert alert-success text-center'>مرحبا".$_SESSION['user_data']['Name']. "  سيتم تحويلك الى لوحة التحكم  "."</div>";
                        header('REFRESH:5;URL=dashboard.php');
                    }else{
                        echo "<div class='alert alert-danger text-center'>خطأ بكلمة المرور</div>";
                    }
                    
                }else{
                        echo "<div class='alert alert-danger text-center'>لا حساب مسجل بهذه البيانات</div>";
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
    <title>login</title>
    <link rel="stylesheet" href="css/font/Janna_LT_Regular.ttf">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/style.css">



</head>
<body>
    <div class="login-form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h1>تسجيل الدخول</h1>
            <div class="inputs">
                <div>
                    <label>الاسم:</label>
                    <input class="form-control" type="text" name="user-name">
                </div>
                <div>
                    <label>الايميل:</label>
                    <input class="form-control" type="text" name="user-email">
                </div> 
                <div>
                    <label>كلمة المرور:</label>
                    <input class="form-control" type="password" name="user-password">
                </div>
            </div>
            <div class="login-form-buttons">
                <input type="submit" class="btn btn-primary" name="login-button" value="تسجيل دخول" ></input>
                <a href="signup.php" class="btn btn-primary">إنشاء حساب</a>
            </div>
        </form>

    </div>
</body>
</html>