<?php
$connection=new mysqli("localhost","root","","news");
function validate_data($data){
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;

}

// if ($connection->error==true){
//     echo"connection fail";
// }else{
//     echo"connected";
// }