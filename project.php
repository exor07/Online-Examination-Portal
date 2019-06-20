<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect1.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style> 
            input[type=text] {
                width: 270px;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                background-color: white;

                background-position: 10px 10px; 
                background-repeat: no-repeat;
                padding: 12px 20px 12px 40px;
                -webkit-transition: width 0.4s ease-in-out;
                transition: width 0.4s ease-in-out;
            }

            input[type=text]:focus {
                width: 100%;
            }
        </style>
        <title>PCONNECT</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Custom fonts for this template -->
        <link href="css/fonts/googlefontone.min.css" rel="stylesheet">
        <link href="css/fonts/googlefonttwo.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/one-page-wonder.min.css" rel="stylesheet">

    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">PCONNECT</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="pages-registration.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Page Content -->
        <div class="container">
            <br>
            <br>

            <h2 class="mt-4 mb-3 " style="color: #09289B"> List of Projects..</h2>

            <form>
                <a><i class="fa fa-hand-o-right" style="font-size:24px"></i></a> &ensp;<input type="text" name="search" placeholder="Click to Search Projects..." >
            </form>

            <!-- Marketing Icons Section -->
            <br>
            <div class="row">
                <?php
                $sql = "SELECT * FROM course_master_univ";
                $query = mysql_query($sql);
                for (; $row = mysql_fetch_array($query);) {
                    ?>
                    <div class="col-lg-4 mb-4">

                        <div class="card h-100">

                            <a href="#"><img class="card-img-top" src="img/univ.jpg" alt="" style="height: 150px;"></a>
                            <h4 class="card-header"><a style="color: #6A6665" href="proj_desc.php?request_id=<?php echo $row['course_id']; ?>"><?php echo $row['course_name']; ?></a></h4>
                            <div class="card-body">
                                <p class="card-text" align="justify">
                                    <?php echo $row['course_description']; ?>
                                </p>
                                <a style="color: #9494b8"><i>University of Massachusetts Boston</i></a>
                            </div>
                            <div class="card-footer">
                                <a href="proj_desc.php?request_id=<?php echo $row['course_id']; ?>" class="btn btn-primary rounded-pill">Click to learn More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Call to Action Section -->

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; PConnect2018</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>
</html>