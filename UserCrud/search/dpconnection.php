<?php

session_start();
$server = "localhost";
$dbName = "group8";
$dbUser = "root";
$dbPssword = "";

$con = mysqli_connect($server,$dbUser,$dbPssword,$dbName);
if (!$con) {
    echo "error::" .mysqli_connect_error();
}


?>