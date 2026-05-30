<?php
    session_start();
    include('include/header.php');
    include('include/connection.php');
    if(isset($_SESSION['user_data'])!=true){
    header('location:login.php');
}

    ?>


    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <table class="table">
                    <tr class="bg-primary text-light">
                        <th>رقم الفئة</th>
                        <th>اسم الفئة</th>
                        
                    </tr>
                    <?php 
                    $sql="select * from categories";
                    $result=$connection->query($sql);
                    if($result->num_rows>0){
                        $count=1;
                        while($row=$result->fetch_assoc()){
                    ?>

                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $row['title'] ;?></td>
                        
                    </tr>
                    
                    <?php
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