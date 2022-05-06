<?php
require 'dpconnection.php';
require 'helpers.php' ;
if ($_SERVER['REQUEST_METHOD']=="POST") {

    $key     = clean($_POST['key']); 
    $errors = [];

    #validate input
    if (!validate($key,1)) {
        $errors['key'] ="key required";
    }
    if (count($errors) > 0) {
        # print errors
        Errors($errors);
    }else {
        #DP code
        $sql = "select * from users where name like '%$key%'";
        $op =  mysqli_query($con,$sql);
        if (mysqli_num_rows($op) > 0) {
            // fetch data
            while ($data = mysqli_fetch_assoc($op)) {
                echo $data['name'].'<br>';
            }

        }else {
            echo "No Matched Data!!!";
        }

}
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Search</h2>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="exampleInputName">Search Key</label>
                <input type="text" class="form-control" id="exampleInputName" name="key" aria-describedby=""
                    placeholder="Search Here .... ">
            </div>



            <button type="submit" class="btn btn-primary">GO!!</button>
        </form>



</body>

</html>