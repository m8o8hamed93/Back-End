<?php
require 'dbClass.php';

class users {
    private $name ;
    private $email ; 
    private $password ; 
    private $linkedIn ;  

    public function __construct($val1,$val2,$val3,$val4){
        $this->name     = $val1 ;
        $this->emial    = $val2 ;
        $this->password = $val3 ;
        $this->linkedIn = $val4 ;
    }

    public function Register(){
        $db = new Database();
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `linkedin`) VALUES ('$this->name','$this->email','$this->password','$this->linkedIn')";
        $result = $db->doQuery($sql);
        // return $result;
        if ($result) {
            echo "raw inserted";
        } else {
            echo "error try again";
        }
        

    }


}



?>