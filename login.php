<?php
include('dbconnect.php');
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST[role]);
    if ($role == "educator") {
        $q = "select *from teacher_master where email='$email' and password='$password'";
        $sth = mysql_query($q) or die("query failed:" . mysql_errno() . mysql_error());
        $count = mysql_num_rows($sth);
        $result = mysql_fetch_array($sth);
        if ($count == 1) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['id'] = $result['teacher_id'];
            echo "<script>alert('Success!');window.location='edu-dashboard.php'; </script>";
            exit();
        } else {
            echo "<script> alert('Wrong Username or Password'); window.location='login.php'; </script>";
        }
    } else
    if ($role == "organization") {
        $q = "select *from organization_master where email='$email' and password='$password'";
        $sth = mysql_query($q) or die("query failed:" . mysql_errno() . mysql_error());
        $count = mysql_num_rows($sth);
        $result = mysql_fetch_array($sth);
        if ($count == 1) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['o_id'] = $result['organization_id'];
            echo "<script>window.location='org-dashboard.php'; </script>";
            exit();
        } else {
            echo "<script> alert('Wrong Username or Password'); window.location='login.php'; </script>";
        }
    } else {
        $q = "select *from student_master where email='$email' and password='$password'";
        $sth = mysql_query($q) or die("query failed:" . mysql_errno() . mysql_error());
        $count = mysql_num_rows($sth);
        $result = mysql_fetch_array($sth);
        if ($count == 1) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['s_id'] = $result['student_id'];
            echo "<script>window.location='stud-dashboard.php'; </script>";
            exit();
        } else {
            echo "<script> alert('Wrong Username or Password'); window.location='login.php'; </script>";
        }
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	

        <!-- EOF LESSCSS INCLUDE -->      


    </head>
    <body>

        <div class="login-container lightmode">

            <div class="login-box animated fadeInDown">
                <div class="login"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form action="login.php" class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="E-mail" name="email"required>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="form-group">
                                <div class="col-md-12">

                                    <select class="form-control" name="role" required>
                                        <option value="">Choose Option</option>
                                        <option value="educator">Educator</option>
                                        <option value="organization">Organization</option>
                                        <option value="student">Student</option>
                                    </select>                           

                                </div>                        
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <button class="btn btn-info btn-block " name="submit" type="submit">Log In</button>

                                </div>
                                <div class="col-md-6">
                                    <a href="pages-forgot-password.php" class="btn btn-link btn-block">Forgot your password?</a>
                                </div>
                            </div>
                            <div class="login-or">OR</div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <a href="https://www.linkedin.com" class="btn btn-block btn-social btn-linkedin"> <span class="fa fa-linkedin-square"></span>Sign in with LinkedIn </a>
                                </div>  
                            </div>
                            <div class="login-subtitle">
                                Don't have an account yet? <a href="pages-registration.php">Create an account</a>
                            </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2018 PConnect
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> 
                        <a href="#">Privacy</a> 
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        
        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>       
        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>   
    </body>
</html>