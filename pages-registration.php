<?php
include("dbconnect.php");
if (isset($_POST['submit'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $sex = trim($_POST['sex']);
    $role = $_POST['role'];

    $query = "select * from users_master where email='$email'";
    $query_run = mysql_query($query)or die("query failed:" . mysql_errno() . mysql_error());

    if ($query_run) {
        if (mysql_num_rows($query_run) > 0) {
            echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
        } else {
            if ($role == "professor") {
                $query1 = "insert into users_master(firstName,lastname, email,password) values ('$firstName', '$lastName', '$email', '$password')";
                $query_run = mysql_query($query1);
                $query = "insert into teacher_master (firstName,lastName,sex,address,phone,email,password) VALUES ('$firstName', '$lastName', '$sex', '$address', '$phone', '$email', '$password')";
                $query_run = mysql_query($query);
                if ($query_run) {
                    echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
                    echo "<script>alert('Success!');window.location='login.php'; </script>";
                    exit();
                } else {
                    echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                }
            } elseif ($role == "student") {
                $query1 = "insert into users_master(firstName,lastname, email,password) values ('$firstName', '$lastName', '$email', '$password')";
                $query_run = mysql_query($query1);
                $query = "insert into student_master (firstName,lastName,sex,address,phone,email,password) VALUES ('$firstName', '$lastName', '$sex', '$address', '$phone', '$email', '$password')";
                $query_run = mysql_query($query);
                if ($query_run) {
                    echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
                    echo "<script>alert('Success!');window.location='login.php'; </script>";
                    exit();
                } else {
                    echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                }
            } elseif ($role == "organization") {
                $query1 = "insert into users_master(firstName,lastname, email,password) values ('$firstName', '$lastName', '$email', '$password')";
                $query_run = mysql_query($query1);
                $query = "insert into organization_master (firstName,lastName,sex,address,phone,email,password) VALUES ('$firstName', '$lastName', '$sex', '$address', '$phone', '$email', '$password')";
                $query_run = mysql_query($query);
                if ($query_run) {
                    echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
                    echo "<script>alert('Success!');window.location='login.php'; </script>";
                    exit();
                } else {
                    echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                }
            } else
                echo'<script type="text/javascript">alert("Please select your role")</script>';
        }
    }
    else {
        echo '<script type="text/javascript">alert("DB error")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>PConnect</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- LESSCSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>                
        <!-- EOF LESSCSS INCLUDE -->                                       
    </head>
    <body>

        <div class="registration-container">            
            <div class="registration-box animated fadeInDown">
                <div class="registration"></div>
                <div class="registration-body">
                    <div class="registration-title"><strong>PCONNECT</strong>, Registration Form</div>
                    <div class="registration-subtitle"> Let's Create your PConnect Account. </div>

                    <form id="validate" role="form" href="login.php" class="form-horizontal" method="post" >
                        <div class= "form-group">
                            <label class="col-md-3 control-label">First Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="firstName" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lastName" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="validate[required,minSize[5],maxSize[10]] form-control" id="password" name="password" required>
                                <span class="help-block">Required, min size = 5</span>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="validate[required,equals[password]] form-control" required>

                            </div>
                        </div>                            

                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender:</label>
                            <div class="col-md-9">
                                <select class="form-control"  name="sex" required>
                                    <option value="">Choose option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="other">Others</option>>
                                </select>                           

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Type:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="formType" name="role" required>
                                    <option value="">Choose option</option>
                                    <option value="professor">Educator</option>
                                    <option value="organization">Organization</option>
                                    <option value="student">Student</option>
                                </select>                           
                            </div>                        
                        </div>
                        <div id="formUniversity" class="form-group">
                            <label class="col-md-3 control-label">University:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="formUniv" name="univ" >
                                    <option value="">Choose option</option>
                                    <option value="1">UMASS Boston</option>
                                    <option value="2">UMASS Amherst</option>
                                    <option value="3">UMASS Dartmuoth</option>
                                </select>                           
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">phone:</label>
                            <div class="col-md-9">
                                <input type="number" size="10" class=" form-control" name="phone" required>
                            </div>
                        </div>                             
                        <div class="form-group">                        
                            <div class="col-md-12">
                                <label class="checkbox">
                                    <label>
                                        <input type="checkbox" class="validate[required]" name="terms" value="1" required> Yes, I accept your terms and conditions.
                                    </label>
                                </label>
                            </div>
                        </div>                                             

                        <div class="form-group push-up-30">
                            <div class="col-md-8">
                                <a href="login.php" class="btn btn-link btn-block">Already have account? Click here.</a>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block" name="submit" type="submit">Sign Up</button>
                            </div>
                        </div> 
                    </form>
                </div>
                <div class="registration-footer">
                    <div class="pull-left">
                        &copy; 2018 PConnect
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- START SCRIPTS -->

        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type="text/javascript" src="js/showhide.js"></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        

        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS -->               

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>

        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->

        <script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    login: {
                        required: true,
                        minlength: 2,
                        maxlength: 8
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 10
                    },
                    're-password': {
                        required: true,
                        minlength: 5,
                        maxlength: 10,
                        equalTo: "#password2"
                    },

                    email: {
                        required: true,
                        email: true
                    },

                    Role: {
                        required: true,
                        creditcard: true
                    },

                }
            });

        </script>

        <!-- END SCRIPTS --> 
    </body>
</html>