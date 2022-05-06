<?php

require 'helpers.php';
require 'dpconnection.php';
require 'checklogin.php';
$id = $_GET['id'];

#validate id
if (validate($id,5)) {
    //# delet logi 
    $sql= "delete from users where id = $id";
    $op = mysqli_query($con,$sql);

        if ($op){
            $message = "Raw Removed";
        }
    else{
        $message = "Eroor Try Again";

    }
}else{
    $message = "Invalid Id !!!";
}

$_SESSION['message']=$message;

header("Location: index.php");

?>