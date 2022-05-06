<?php

require 'dpconnection.php';
require 'checklogin.php';
require 'helpers.php' ;


$id = $_GET['id'];
$sql = "select * from address where user_id = $id";
$op = mysqli_query($con,$sql);
if (mysqli_num_rows($op) == 1) {
    $data = mysqli_fetch_assoc($op);
}else{
    $message = 'Invalid Id ';
    $_SESSION['message'] = $message;
    header('Location: index.php'); 
    
}

 
if ($_SERVER['REQUEST_METHOD']=="POST") {

    $gov         = clean($_POST['gov']);
    $city        = clean($_POST['city']);
    $extraData   = clean($_POST['extraData']);
    $errors =[];

    #validate government
    if (!validate($gov,1)) {
        $errors['gov'] ="goverment required";
    }
    #validate city
    if (!validate($city,1)) {
        $errors['city'] ="city required";
    }
    #validate extradata
    if (!validate($extraData,1)) {
        $errors['extraData'] ="address required";
    }

    if (count($errors) > 0) {
        # print errors
        Errors($errors);
    }else {
        # DB code........
        $sql = "update address set gov='$gov' , city = '$city', extraData='$extraData' where user_id = $id";
        $op=mysqli_query($con,$sql);
        if ($op) {
            # code...
            $message = "raw updated";
        }else {
            $message = "error try again"; 
        }
        $_SESSION['message']=$message;

        header("Location: index.php");
    }

    mysqli_close($con);
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit address</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit address</h2> 


        <form action="editAddress.php?id=<?php echo $data['user_id'];?>" method="post">

        <div class="form-group">
                <label for="exampleInputName">government</label>
                <input type="text" class="form-control" id="exampleInputName" name="gov" value="<?php echo $data['gov']; ?>" aria-describedby=""
                    placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">city</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="city" value="<?php echo $data['city']; ?>"
                    aria-describedby="emailHelp" placeholder="Enter city">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Address Details</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="extraData" value="<?php echo $data['extraData']; ?>"
                    placeholder="enter address">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>



</body>

</html>