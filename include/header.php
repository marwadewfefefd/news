<!-- <?php
    session_start();
    
    ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-rtl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">



</head>
<body>
    <nav  class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand ml-3" href="dashboard.php">أخباري</a>

  <div class="collapse navbar-collapse mr-5" id="navbarSupportedContent">
    <ul class="navbar-nav w-50 d-flex justify-content-around">
      <!------------------------>
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">الرئيسية <span class="sr-only">(current)</span></a>
      </li>
      <!------------------------>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          الفئات
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="categories.php">عرض الفئات</a>
          <a class="dropdown-item" href="add-category.php"> إضافة فئة</a>
          <!-- <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">إاضافة فئة</a>
        </div> -->
      </li>
      <!------------------------>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          الأخبار
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="news.php">عرض الأخبار</a>
          <a class="dropdown-item" href="add-news.php">إضافة خبر</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="deleted-news.php"> الأخبار المحذوفة</a>
        </div>
      </li>
    <!------------------------>
     
      
    </ul>
    
  </div>
</nav>
