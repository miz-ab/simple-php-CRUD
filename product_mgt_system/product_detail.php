<!DOCTYPE html>


<html>

<?php

$host_name = 'localhost'; // host name 
$user_name = 'root'; // xampp or wampp user name
$user_password = ''; // xampp or wampp password in my case it is root for user name and password ''
$database_name = 'PMS';

$create_connection = mysqli_connect($host_name, $user_name, $user_password, $database_name);
if ($create_connection) {
    //echo 'connection created';
}
?>

<head>

    <!-- link other css file -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<script src="assets/js/jquery-3.1.1.js"></script>

<body>

    <!-- bootstrap standard nav bar -->

    <nav class="navbar navbar-default">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle Button</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="/">PMS</a>
        <div class="navbar-collapse collapse">

        </div>

    </nav>


    <div class="container">
        <?php
        $id = $_GET['id'];

        //if delete btn pressed 
        if (isset($_POST['delete_product'])) {
           // die('test');
            $delet_sql = "DELETE FROM product WHERE id='" . $id . "'";
            $res_delete = mysqli_query($create_connection, $delet_sql);
            if ($res_delete) {
                header("location: product_list.php");
            }
        }

        $sql = "SELECT * FROM product WHERE id='" . $id . "'";
        $result = mysqli_query($create_connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_object($result);

        ?>

            <div class="row">
                <div class="col-md-4">
                    <h4 for="photo">Photo</h4>
                    <?php echo "<img style='width: 180px;' src='assets/images/" . $row->image . "'>"; ?>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 for="fullname"> Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: bold; font-size:16px;"><?php echo $row->name; ?></span></h6>

                            <h6 for="fullname">Quantity :
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: bold; font-size:16px;"><?php echo $row->quantity; ?></span></h6>

                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <h6 for="fullname">Description :
                                &nbsp;&nbsp;
                                <span style="font-weight: bold; font-size:16px;"><?php echo $row->description; ?></span></h6>
                        </div>
                    </div>


                </div>
                <form method="POST">
                    <button class="btn btn-primary" type="submit">Edit</button>
                    <button class="btn btn-danger" type="submit" name="delete_product">Delete</button>
                </form>
            </div>



        <?php
        } else {
            echo '<div class="alert alert-danger">  
                      NO Data Found 
                      </div> ';
        }

        ?>


    </div>










    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>
</body>

</html>