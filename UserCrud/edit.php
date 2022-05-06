<?php

require 'dpconnection.php';
require 'checklogin.php';
require 'helpers.php' ;


$id = $_GET['id'];
$sql = "select * from users where id = $id";
$op = mysqli_query($con,$sql);
if (mysqli_num_rows($op) == 1) {
    $data = mysqli_fetch_assoc($op);
}else{
    $message = 'Invalid Id ';
    $_SESSION['message'] = $message;
    header('Location: index.php'); 
    
}


#select department
$sql = "select * from departments";
$dep_op = mysqli_query($con,$sql);
 
if ($_SERVER['REQUEST_METHOD']=="POST") {

    $name     = clean($_POST['name']); 
    $email    = clean($_POST['email']);
    $linkedIn = clean($_POST['linkedIn']);
    $dep_id   = clean($_POST['dep_id']);
    $errors =[];

    #validate name
    if (!validate($name,1)) {
        $errors['name'] ="name required";
    }
    #email validate
    if (!validate($email,1)) {
        $errors['Email'] ="email required";
    }elseif(!validate($email,2)){
        $errors ['Email'] = "valid email rquired";

    }
    #password validate
    // if (!validate($password,1)) {
    //     $errors['Password'] ="password rquired";
    // }elseif(!validate($password,4)){
    //     $errors ['Password']= "invalid lenght must be >= 6 ch ";

    // }
    #url validate
    if (!validate($linkedIn,1)) {
        $errors['LinkedIn'] ="link rquired";
    }elseif(!validate($linkedIn,3)){
        $errors['LinkedIn'] = "invalid linkedin url";

    }
    #dep validate
    if (!validate($dep_id,1)) {
        $errors['departments'] ="departments rquired";
    }elseif(!validate($dep_id,5)){
        $errors['departments'] = "invalid departmenst num";

    }

    if (count($errors) > 0) {
        # print errors
        Errors($errors);
    }else {
        # DB code........
        // $password = md5($password);
        // echo strlen($password);
        // exit();
        //query for update
        $sql = "update users set name='$name' , email = '$email', linkedin='$linkedIn', depatment_id = $dep_id where id = $id";
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
    <title>Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit</h2> 


        <form action="edit.php?id=<?php echo $data['id'];?>" method="post">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $data['name'];?>" aria-describedby=""
                    placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $data['email'];?>"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>

            <!-- <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                    placeholder="Password">
            </div> -->

            <div class="form-group">
                <label for="exampleInputName">LinkedIn Url</label>
                <input type="text" class="form-control" id="exampleInputName" name="linkedIn"  value="<?php echo $data['linkedin'];?>"
                    placeholder="LinkedIn Url">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Departments</label>
                <select class="form-control" name="dep_id">
                    <?php
                    while($dep_data = mysqli_fetch_assoc($dep_op)){
                    ?>
                    <option value="<?php echo $dep_data['id']; ?>" <?php if($dep_data['id'] == $data['depatment_id']){echo "selected";} ?> > <?php echo $dep_data['title'];?></option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>



</body>

</html>