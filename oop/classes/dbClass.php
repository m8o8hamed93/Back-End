<?php

class DataBase{
    var $server = "localhost";
    var $dbName = "grop88";
    var $dbUser = "root";
    var $dbPssword = "";
    var $con = Null;

    function __construct(){
        $this->con = mysqli_connect($this->server,$this->dbUser,$this->dbPssword,$this->dbName);
        if (!$this->con) {
            echo "error::" .mysqli_connect_error();
        }
    }
    function doQuery($sql){
       $result = mysqli_query($this->con,$sql);
       return $result;
    }
    function __destruct(){
        mysqli_close($this->con);
    }
}

$obj = new Database();
$result = $obj->doQuery("select * from users");
while($data = mysqli_fetch_assoc($result)){
    echo $data['name'].'<br>';
}


?>