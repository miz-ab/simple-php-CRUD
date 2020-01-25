<!DOCTYPE html>


<html>

<?php

$host_name = 'localhost';
$user_name = 'root';
$user_password = '';
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
            <h2>Register New product</h2>
        </div>

        <?php
        if (isset($_POST['register_product'])) {
            $product_name = $_POST['product_name'];
            $product_quantity = $_POST['product_quantity'];
            $product_description = $_POST['product_description'];
            //path file will be uploaded
            $target = "assets/images/" . basename($_FILES['product_image']['name']);
            //get image name inserted into the db
            $image_name = $_FILES['product_image']['name'];

            //insert values to db
            $sql = "INSERT INTO product(name,quantity,description,image) VALUES('$product_name','$product_quantity','$product_description','$image_name')";
            $result = mysqli_query($create_connection, $sql);

            if ($result) {
                echo '<div class="alert alert-success">  
                        <strong>Success!</strong> Product Registered Successfully  
                      </div> ';
            } else {
                echo '<div class="alert alert-danger">  
                        <strong>Failed !</strong> Product Registration Failed   
                      </div> ';
            }

            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
                //echo 'Images Uplodeed Succesfully';
            } else {
                echo '<div class="alert alert-danger">  
                        <strong>Failed !</strong> Unable to upload File   
                      </div> ';
            }
            mysqli_close($create_connection);
        }

        if (isset($_POST['cancle_registration'])) {

            header("location: product_list.php");
        }
        ?>

        <div class="body_section">
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-1"></div><!-- first col -->

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                            <p id="validation_status_product_name" style="color: red;">Enter Letter Character only</p>
                        </div>



                    </div><!-- second col -->

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="product_quantity">Quantity</label>
                            <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Product Quantity">
                            <p id="validation_status_product_quantity" style="color: red;">Product Quantity Must be Numeric Character</p>
                        </div>
                    </div><!--  col three -->

                    <div class="col-md-1"></div><!--  col four -->


                </div> <!-- end of row -->

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="product_quantity">Product Image</label>
                            <input type="hidden" name="size" value="1000000" />
                            <input type="file" class="form-control" id="product_image" name="product_image" />
                        </div>
                    </div> <!-- coll file upload -->
                    <div class="col-md-1"></div>
                </div> <!-- row file upload -->

                <div class="row">
                    <!-- product description -->
                    <div class="col-md-1"></div><!-- first col -->
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="product_quantity">Description</label>
                            <textarea name="product_description" id="description" class="form-control" rows="4" placeholder="Enter Description"></textarea>
                        </div> <!-- end of form group -->
                        <div class="col-md-1"></div><!-- first col -->
                    </div>
                </div> <!-- end of second row -->

                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6"><button type="submit" class="btn btn-primary btn-block" id="register_product" name="register_product">Save</button> </div>
                            <div class="col-md-6"><button type="submit" class="btn btn-danger btn-block" name="cancle_registration">Cancle</button></div>
                        </div>
                        <div class="col-md-1"></div>
                    </div><!-- end of col outer action -->
                </div> <!-- end of action row -->
            </form>
        </div> <!-- body section -->
    </div>



    <script>
        $(document).ready(function() {
            //console.log('document is ready');
            var validate_name = /^[a-zA-Z]+$/;
            var validate_number = /^[0-9]+$/;

            var valid_name = false;
            var valid_quantity = false;
            //hide the err message
            $('#validation_status_product_name').hide();
            $('#validation_status_product_quantity').hide();


            //keyup function for product name
            $('#product_name').keyup(function(event) {
                var product_name = $('#product_name').val();
                if (validate_name.test(product_name)) {
                    $('#validation_status_product_name').hide();
                    valid_name = true;
                } else {
                    valid_name = false;
                    event.preventDefault();
                    $('#validation_status_product_name').show();
                }
            });
            //keyup function for product_quantity
            $('#product_quantity').keyup(function(event) {
                var product_quantity = $('#product_quantity').val();
                if (validate_number.test(product_quantity)) {
                    $('#validation_status_product_quantity').hide();
                    valid_quantity = true;
                } else {
                    valid_quantity = false;
                    event.preventDefault();
                    $('#product_quantity').addClass('empty_box');
                    $('#validation_status_product_quantity').show();

                }
            });

            //if btn pressed
            $('#register_product').click(function(event) {
                //get all value 
                var product_name = $('#product_name').val();
                var product_quantity = $('#product_quantity').val();
                var product_description = $('#description').val();

                if (!valid_name) {
                    event.preventDefault();
                }

                if (!valid_quantity) {
                    event.preventDefault();
                }

                if (product_name == '') {
                    event.preventDefault();
                    $('#product_name').addClass('empty_box');
                } else {
                    $('#product_name').removeClass('empty_box');
                }

                if (product_quantity == '') {
                    event.preventDefault();
                    $('#product_quantity').addClass('empty_box');
                } else {
                    $('#product_quantity').removeClass('empty_box');
                }

                if (product_description == '') {
                    event.preventDefault();
                    $('#description').addClass('empty_box');
                } else {
                    $('#description').removeClass('empty_box');
                }

            });

        });
    </script>


    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>
</body>

</html>