<?php

require './classes/usersClass.php';
require './classes/validateClass.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {
    # create obi .....
    $validate = new validator;
    #clean input
    $name        =$validate->clean($_POST['name']); 
    $email       =$validate->clean($_POST['email']);
    $password    =$validate->clean($_POST['password']);
    $linkedIn    =$validate->clean($_POST['linkedIn']);
    #validate input
    #array errors
    $errors = [];
    #validate name
    if (!$validate->validate($name,1)) {
        $errors['name'] ="name required";
    }
    if (!$validate->validate($email,1)) {
        $errors['email'] ="email required";
    }elseif(!$validate->validate($email,2)){
        $errors ['email']= "invalid email address ";

    }
    if (!$validate->validate($password,1)) {
        $errors['password'] ="password required";
    }elseif(!$validate->validate($password,4)){
        $errors ['Password']= "invalid lenght must be >= 6 ch ";

    }
    if (!$validate->validate($linkedIn,1)) {
        $errors['url'] ="url required";
    }elseif(!$validate->validate($linkedIn,3)){
        $errors ['url']= "invalid url ";
    }    
    if (count($errors) > 0) {
        # print errors
        $validate->Errors($errors);
    }else {
        $obj = new users($name,$email,$password,$linkedIn);
        $obj->Register();
    }

}

// require 'dpconnection.php';
// require 'helpers.php' ;


// #select departments...
// $sql = "select * from departments";
// $dep_op = mysqli_query($con,$sql);

// if ($_SERVER['REQUEST_METHOD']=="POST") {

//     $name        = clean($_POST['name']); 
//     $email       = clean($_POST['email']);
//     $password    = clean($_POST['password']);
//     $linkedIn    = clean($_POST['linkedIn']);
//     $dep_id      = clean($_POST['dep_id']);
//     $gov         = clean($_POST['gov']);
//     $city        = clean($_POST['city']);
//     $extraData   = clean($_POST['extraData']);
//     $errors =[];

//     #validate name
//     if (!validate($name,1)) {
//         $errors['name'] ="name required";
//     }
//     #email validate
//     if (!validate($email,1)) {
//         $errors['Email'] ="email required";
//     }elseif(!validate($email,2)){
//         $errors ['Email'] = "valid email rquired";

//     }
//     #password validate
//     if (!validate($password,1)) {
//         $errors['Password'] ="password rquired";
//     }elseif(!validate($password,4)){
//         $errors ['Password']= "invalid lenght must be >= 6 ch ";

//     }
//     #url validate
//     if (!validate($linkedIn,1)) {
//         $errors['LinkedIn'] ="link rquired";
//     }elseif(!validate($linkedIn,3)){
//         $errors['LinkedIn'] = "invalid linkedin url";

//     }
//     #dep validate
//     if (!validate($dep_id,1)) {
//         $errors['departments'] ="departments rquired";
//     }elseif(!validate($dep_id,5)){
//         $errors['departments'] = "invalid departmenst num";

//     }
//     #validate government
//     if (!validate($gov,1)) {
//         $errors['gov'] ="goverment required";
//     }
//     #validate city
//     if (!validate($city,1)) {
//         $errors['city'] ="city required";
//     }
//     #validate extradata
//     if (!validate($extraData,1)) {
//         $errors['extraData'] ="address required";
//     }

//     if (count($errors) > 0) {
//         # print errors
//         Errors($errors);
//     }else {
//         # DB code........
//         $password = md5($password);
//         // echo strlen($password);
//         // exit();
//         $sql = "INSERT INTO `users`(`name`, `email`, `password`, `linkedin`, `depatment_id`) VALUES ('$name','$email','$password','$linkedIn',$dep_id)";
        
//         $op=mysqli_query($con,$sql);
        
//         $user_id = mysqli_insert_id($con);
        
//         if ($op) {
//             # code...
//             $sql = "INSERT INTO `address`(`gov`, `city`, `extraData`,`user_id`) VALUES ('$gov','$city','$extraData',$user_id)";
//             $Address_op = mysqli_query($con,$sql);
            
//             echo "user inserted ";
//             $_SESSION['message'] = $message;
//             header("Location: index.php");
//         }else {
//             echo "error try again";
//         }
//     }

//     mysqli_close($con);
// }





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2> 


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                    placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Password">
            </div>

            <div class="form-group">
                <label for="exampleInputName">LinkedIn Url</label>
                <input type="text" class="form-control" id="exampleInputName" name="linkedIn"
                    placeholder="LinkedIn Url">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>



</body>

</html>