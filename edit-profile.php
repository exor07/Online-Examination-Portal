<?php
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
    ?>
    <?php
    if (isset($_POST['submit'])) {
        $id = $_SESSION['id'];
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);

        $query1 = "update teacher_master set phone='$phone', address='$address' where teacher_id='$id'";
        $query_run = mysql_query($query1);
        if ($query_run) {
            echo "<script> alert('Success');  </script>";
        } else {
            echo "<script> alert('Cannot update! Please try later!!'); </script>";
        }
    }
?>
<?php
    if (isset($_POST['submit1'])) {
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $old_password = trim($_POST['old_password']);
        $new_password = trim($_POST['new_password']);
        if ($password == $old_password) {
            $q = "update teacher_master set password='$new_password' where email='$email'";
            $sth = mysql_query($q);
            echo "<script> alert('Success');  </script>";
        } else {
            echo "<script> alert('Old password is incorrect!!');</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">


        <head>        
            <!-- META SECTION -->
            <title>PConnect</title>            
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />

            <link rel="icon" href="favicon.ico" type="image/x-icon" />
            <!-- END META SECTION -->

            <!-- CSS INCLUDE -->        
            <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>              
            <!-- EOF CSS INCLUDE -->  

        </head>
        <body>
            <!-- START PAGE CONTAINER -->
            <div class="page-container">

                <!-- START PAGE SIDEBAR -->
                <div class="page-sidebar">
                    <!-- START X-NAVIGATION -->
                    <ul class="x-navigation">
                        <li class="xn">
                            <a href="index.php"></a>
                            <a href="#" class="x-navigation-control"></a>
                        </li>
                        <li class="xn-profile">
                            <a href="#" class="profile-mini">
                                <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                            </a>
                            <div class="profile">
                                <div class="profile-image">
                                    <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                                </div>
                                <div class="profile-data">
                                        <?php
                                        include('dbconnect.php');
                                        $email = $_SESSION['email'];
                                        $q = "select *from teacher_master where email='$email'";
                                        $sth = mysql_query($q);
                                        $result = mysql_fetch_array($sth);
                                        ?>
                                        <div class="profile-data-name"><?php echo $result['firstName'], ' ', $result['lastName']; ?></div>

                                </div>
                                <div class="profile-controls">
                                    <a href="edit-profile.php" class="profile-control-left"><span class="fa fa-info"></span></a>

                                </div>
                            </div>                                                                        
                        </li>
                        <!-- <li class="xn-title">Navigation</li> -->
                        <li class="active">
                            <a href="edu-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 
                    </ul>
                    <!-- END X-NAVIGATION -->
                </div>
                <!-- END PAGE SIDEBAR -->

                <!-- PAGE CONTENT -->
                <div class="page-content">

                    <!-- START X-NAVIGATION VERTICAL -->
                    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                        <!-- TOGGLE NAVIGATION -->
                        <li class="xn-icon-button">
                            <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                        </li>
                        <!-- END TOGGLE NAVIGATION -->
                        <!-- SEARCH -->
                        <li class="xn-search">
                            <form role="form">
                                <input type="text" name="search" placeholder="Search..."/>
                            </form>
                        </li>   
                        <!-- END SEARCH -->                    
                        <!-- POWER OFF -->
                        <li class="xn-icon-button pull-right last">
                            <a href="#"><span class="fa fa-power-off"></span></a>
                            <ul class="xn-drop-left animated zoomIn">
                                <li><a href="pages-lock-screen.php"><span class="fa fa-lock"></span> Lock Screen</a></li>
                                <li><a href="pages-logout.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                            </ul>                        
                        </li> 
                        <!-- END POWER OFF -->                    

                    </ul>
                    <!-- END X-NAVIGATION VERTICAL -->                     


                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">


                        <div class="row">                        

                            <div class="col-md-6 col-sm-8 col-xs-7">

                                <form role="form" action="#" method="post" class="form-horizontal">

                                    <br>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h3><span class="fa fa-pencil"></span> Profile</h3>
                                            <p>Edit your profile</p>
                                        </div>

                                        <div class="panel-body form-group-separated">
                                            <div class="form-group">

                                                <label class="col-md-3 col-xs-5 control-label">First name</label>
                                                <div class="col-md-9 col-xs-7">
                                                    <input type="text" value="<?php echo $result['firstName']; ?>" class="form-control" disabled/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-5 control-label">Last name</label>
                                                <div class="col-md-9 col-xs-7">

                                                    <input type="text" value="<?php echo $result['lastName']; ?>" class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-5 control-label">Email</label>
                                                <div class="col-md-9 col-xs-7">

                                                    <input type="text" value="<?php echo $result['email']; ?>" class="form-control" disabled/>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label class="col-md-3 col-xs-5 control-label">Address</label>
                                                <div class="col-md-9 col-xs-7">
                                                    <input type="text" value="<?php echo $result['address']; ?>" class="form-control" name="address" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-5 control-label">Phone Number</label>
                                                <div class="col-md-9 col-xs-7">
                                                    <input type="text" value="<?php echo $result['phone']; ?>" class="form-control" name="phone" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-5 col-xs-5">

                                                    <button class="btn btn-primary btn-rounded pull-right" type="submit" name="submit">Save</button>
                                                </div>
                                            </div>

                                            <div class="form-group">                                        
                                                <div class="col-md-12 col-xs-12">
                                                    <a href="#" class="btn btn-danger btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_password">Change password</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->                                

            <!-- END PAGE CONTENT -->

            <!-- END PAGE CONTAINER -->

            <!-- MESSAGE BOX-->
            <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
                <div class="mb-container">
                    <div class="mb-middle">
                        <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                        <div class="mb-content">
                            <p>Are you sure you want to log out?</p>                    
                            <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                        </div>
                        <div class="mb-footer">
                            <div class="pull-right">
                                <a href="pages-logout.php" class="btn btn-success btn-lg">Yes</a>
                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END MESSAGE BOX-->

            <form role="form"  method="post">
                <div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                Change Password
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form role="form" action="#" method="post">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input class="form-control" type="password" name="old_password">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input class="form-control" type="password" name="new_password">
                                            </div>
                                            <button type="submit" name="submit1" class="btn btn-primary">Change</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>   
            </form>   

            <!-- START PRELOADS -->
            <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
            <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
            <!-- END PRELOADS -->                  

            <!-- START SCRIPTS -->
            <!-- START PLUGINS -->
            <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
            <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
            <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
            <!-- END PLUGINS -->

            <!-- START THIS PAGE PLUGINS-->        
            <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
            <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
            <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

            <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
            <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
            <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
            <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
            <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
            <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
            <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
            <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 

            <script type="text/javascript" src="js/plugins/moment.min.js"></script>
            <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
            <!-- END THIS PAGE PLUGINS-->        

            <!-- START TEMPLATE -->
            <script type="text/javascript" src="js/settings.js"></script>

            <script type="text/javascript" src="js/plugins.js"></script>        
            <script type="text/javascript" src="js/actions.js"></script>

            <script type="text/javascript" src="js/demo_dashboard.js"></script>
            <!-- END TEMPLATE -->
            <!-- END SCRIPTS -->         
        </body>
    </html>

<?php
} else {
    echo "<script>window.location='login.php'; </script>";
}
?>