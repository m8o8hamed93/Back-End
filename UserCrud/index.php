<?php
require 'dpconnection.php';
require 'checklogin.php';
    



#Fetch ..... data
$sql = "SELECT users.* ,departments.title FROM users inner JOIN departments ON users.depatment_id = departments.id;";
$op = mysqli_query($con,$sql);


?>


<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        
        .m-b-1em {
            margin-bottom: 1em;
        }
        
        .m-l-1em {
            margin-left: 1em;
        }
        
        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">
 

        <div class="page-header">
            <h1>Read Users </h1> 
            <br>
        </div>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }


        ?>

    <a href="create.php">+ Account</a> ||  <a href="logout.php">LogOut</a> 

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>LinkedIn</th>
                <th>departmnt</th>  
                <th>action</th> 
                      
            </tr>

       <?php

            while ($data = mysqli_fetch_assoc($op)) {
                
        ?>
           <tr>
                 <td><?php echo $data['id'];?></td>
                 <td><?php echo $data['name'];?></td>
                 <td><?php echo $data['email'];?></td>
                 <td><?php echo $data['linkedin'];?></td>
                 <td><?php echo $data['title'];?></td>
                 <td>
                 <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                 <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                 <a href='editAddress.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit Address</a>           
           
                </td> 
           </tr> 
    
       <?php } ?>
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>



