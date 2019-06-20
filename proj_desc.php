<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect1.php');
//if((isset($_SESSION['email']))&& (isset($_SESSION['t_id'])))
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <h2 class="mt-4 mb-3 " style="color: #09289B"> Project Description..</h2>

            <br>
            <div class="row">
                <?php
                $request_id = $_GET['request_id'];
                $sql = "SELECT  * FROM course_master_univ where course_id ='$request_id'";
                $sql13 = "SELECT  * FROM course where course_id ='$request_id'";
                $query13 = mysql_query($sql13);
                $query = mysql_query($sql);
                for (; $row = mysql_fetch_array($query);) {
                    ?>
                    <div class="col-8">
                        <h4 ><a style="color: #6A6665" ><?php echo $row['course_name']; ?></a></h4>
                        <p class="card-text" align="justify"><?php echo $row['course_description']; ?></p>

                        <br>
                            <h5>Project Requirements:</h5>
                            <?php for (; $row13 = mysql_fetch_array($query13);) { ?>
                                <table style="width:100%">
                                    <tr>
                                        <th>Type of Organization:</th>
                                        <td><?php echo $row13['org_type']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Area of project:</th>
                                        <td><?php echo $row13['org_area']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Number of Hours :</th>
                                        <td><?php echo $row13['project_hours']; ?></td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>

                    <?php } ?>
                    <div class="col-lg-4">

                    <a href="#"><img class="card-img-top" src="img/univ.jpg" alt="" style="width: 500px; height: 300px;"></a>
                    <a style="color: #9494b8"><i>University of Massachusetts Boston</i></a>
                    <br>
                    <br>
                    <br>
                    <h5>Have a projects to submit?</h5>
                    <br>

                    <a href="login.php" class="btn btn-primary rounded-pill">Click to Submit</a>

                </div>

            </div>
        </div>
        <!-- Footer -->


        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>