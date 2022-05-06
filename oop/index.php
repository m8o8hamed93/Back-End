<?php


// class users {
//     var $name;
//     var $email;
//     var $password;

//     function __construct($username){
//         echo 'welcome from construct '.$username;
//     }
//     function setName($val){
//         $this->name = $val ;
//     }
//     function getName($val){
//         echo $this->name;
//     }
// }

// $obj = new users("haidy");
// class user {
//     public static function getMessage(){

//         echo " welcome haidy";
//     }
// }
// // $obj = new user;
// // $obj->get_message();

// user :: getMessage();
class calculateArea{
    function __call($name,$arg){
        if ($name == "area") {
            switch (count($arg)) {
                case 1:
                    return 3.1*$arg[0]*$arg[0];
                    break;
                case 2:
                    return $arg[0]*$arg[1];
                    break;
                
                
            }
        }
    }
}
$obj = new calculateArea;
echo $obj->area(2).'<br>';
echo $obj->area(5,4).'<br>';






?>