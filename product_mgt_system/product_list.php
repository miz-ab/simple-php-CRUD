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
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle Button</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">PMS</a>
            <div class="navbar-collapse collapse">

            </div>
        </div>
    </nav>



    <div class="container">
        <div class="jumbotron">
            <h2>List of Product</h2> <a href="add_product.php" class="btn btn-success float-right">Register Student</a>
        </div>

        <table id="list_of_product" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Photo</td>
                    <td>Detail</td>
                </tr>
            </thead>
            <tbody id="list_of_product" class="table table-striped table-bordered">
                <?php
                $sql = "SELECT * FROM product";
                $result_arr = mysqli_query($create_connection, $sql);
                $num = 1;
                if (mysqli_num_rows($result_arr) > 0) {
                    while ($row = mysqli_fetch_assoc($result_arr)) {

                ?>

                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['quantity'] ?></td>
                            <td><?php echo "<img style='width : 40px' src='assets/images/" . $row['image'] . "'>"; ?></td>
                            <td> <?php echo '<a class="btn btn-primary btn-block" href="product_detail.php?id=' . $row['id'] . '">Detail</a>  '; ?></td>
                        </tr>

                <?php
                        $num = $num + 1;
                    }
                }
                ?>

                <script>
                    $(document).ready(function() {
                        $('#list_of_product').dataTable();
                    })
                </script>

            <tbody>
        </table>

    </div>






    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>
</body>

</html>