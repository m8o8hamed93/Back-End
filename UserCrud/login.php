<?php

require 'dpconnection.php';
require 'helpers.php' ;
if ($_SERVER['REQUEST_METHOD']=="POST") {

    $email    = clean($_POST['email']);
    $password = clean($_POST['password']);
    $errors =[];

    #email validate
    if (!validate($email,1)) {
        $errors['Email'] ="email required";
    }elseif(!validate($email,2)){
        $errors ['Email'] = "valid email rquired";

    }
    #password validate
    if (!validate($password,1)) {
        $errors['Password'] ="password rquired";
    }elseif(!validate($password,4)){
        $errors ['Password']= "invalid lenght must be >= 6 ch ";

    }

    if (count($errors) > 0) {
        # print errors
        Errors($errors);
    }else {
        # DB code........
        $password = md5($password);
        $sql = "select * from users where email = '$email' and password = '$password'";
        $op=mysqli_query($con,$sql);
    //    echo mysqli_num_rows($op);
    }if (mysqli_num_rows($op)==1) {
        //# code...
            $data = mysqli_fetch_assoc($op);
            $_SESSION['user'] = $data;
            header("Location: index.php");

    }else{
        echo "Error in your cr try againn!!";
    }

    mysqli_close($con);

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Login</h2> 


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


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


            <button type="submit" class="btn btn-primary">Login</button>
        </form>



</body>

</html>