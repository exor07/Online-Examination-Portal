<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
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

            <!-- LESSCSS INCLUDE -->        
            <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>              
            <!-- EOF LESSCSS INCLUDE -->                                       
        </head>
        <body>
            <!-- START PAGE CONTAINER -->
            <div class="page-container">

                <!-- START PAGE SIDEBAR -->
                <div class="page-sidebar">
                    <!-- START X-NAVIGATION -->
                    <ul class="x-navigation">
                        <li class="xn">
                            <a href="index.html"></a>
                            <a href="#" class="x-navigation-control"></a>
                        </li>
                        <li class="xn-profile">
                            <a href="#" class="profile-mini">
                                <img src="assets/images/users/no-image.jpg" alt="swapnil patil"/>
                            </a>
                            <div class="profile">
                                <div class="profile-image">
                                    <img src="assets/images/users/no-image.jpg" alt="swapnil patil"/>
                                </div>
                                <div class="profile-data">
                                    <?php
                                    $email = $_SESSION['email'];
                                    $q = "select *from teacher_master where email='$email'";
                                    $sth = mysql_query($q);
                                    $result = mysql_fetch_array($sth);
                                    ?>
                                    <div class="profile-data-name"><?php echo $result['firstName'], ' ', $result['lastName']; ?></div>

                                </div>
                                <div class="profile-controls">
                                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                                </div>
                            </div>                                                                        
                        </li>
                        <li>
                            <a href="edu-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 
                        <li class="active">
                            <?php
                            $id = $_SESSION['id'];
                            $action = $_GET['course_id'];
                            $q = "select * from course where teacher_id='$id' and course_id='$action'";
                            $sth = mysql_query($q);
                            $row = mysql_fetch_array($sth);
                            ?>
                            <a href="#"><span class="fa fa-book"></span> <span class="xn-text"><?php echo $row['course_id'], ' ', $row['course_name']; ?></span></a>
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

                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>                    
                        <li class="#">Dashboard</li>
                        <li class="#">Courses</li>
                        <li class="active">Project Details</li>
                    </ul>
                    <!-- END BREADCRUMB -->    
                    <?php
                    $id = $_SESSION['id'];
                    $action1 = $_GET['course_id'];
                    $prid = $_GET['request_id'];
                    $q = "select * from project_request where teacher_id='$id' and course_id='$action1' and request_id = '$prid'";
                    $qr1 = mysql_query($q);
                    $row1 = mysql_fetch_array($qr1)
                    ?>  
                    <!-- PAGE TITLE -->
                    <div class="page-title">                    
                        <h2><span class="fa fa-arrow-circle-o-left"></span> <?php echo $row1['title']; ?></h2>
                    </div>
                    <!-- END PAGE TITLE -->               

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Project Details</h3>
                                            </div>
                                            <div class="panel-body"> 
                                                <div>
                                                    <ul>
                                                        <li>
                                                            <?php echo $row1['project_description']; ?>
                                                        </li> 
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Project Team</h3>
                                            </div>
                                            <div class="panel-body ">
                                                <?php
                                                $q5 = "select s.firstName, s.lastName, s.email from student_master s, projectpref p where p.stud_id = s.stud_id and p.request_id = $prid";
                                                $q5r = mysql_query($q5) or die(mysql_error());
                                                ?>
                                                <table class="table table-condensed table-bordered table-striped">
                                                    <tr><td>Student Name</td><td>Student Email</td></tr>
                                                        <?php
                                                        while ($row5 = mysql_fetch_array($q5r)) {
                                                            echo '<tr>';
                                                            echo "<td>{$row5['firstName']} {$row5['lastName']}</td>";
                                                            echo "<td>{$row5['email']}</td>";
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                    </table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <!-- START DEFAULT WIZARD -->
                                <div class="panel panel-default">
                                    <div class="panel-body">   
                                        <h3>Project Timeline </h3>
                                        <div class="wizard">

                                            <ul>
                                                <li>
                                                    <a href="#step-1">
                                                        <span class="stepNumber">1</span>
                                                        <span class="stepDesc">Step 1<br /><small>SRS Document</small></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-2">
                                                        <span class="stepNumber">2</span>
                                                        <span class="stepDesc">Step 2<br /><small>System Design Document</small></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-3">
                                                        <span class="stepNumber">3</span>
                                                        <span class="stepDesc">Step 3<br /><small>User Manual</small></span>                   
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-4">
                                                        <span class="stepNumber">4</span>
                                                        <span class="stepDesc">Step 4<br /><small>Final Project submission</small></span>                 
                                                    </a>
                                                </li>
                                            </ul>
                                            <div id="step-1">   
                                                <h4>Step 1 SRS Document Submitted</h4>
                                                <p>We have submited the SRS document and started with System Design document.</p>
                                            </div>
                                            <div id="step-2">
                                                <h4>Step 2 Content</h4>
                                                <p>We are working on System Design Document.</p>
                                            </div>                      
                                            <div id="step-3">
                                                <h4>Step 3 Content</h4>
                                                <p>TODO.</p>
                                            </div>
                                            <div id="step-4">
                                                <h4>Step 4 Content</h4>
                                                <p>TODO.</p>
                                            </div>                           

                                        </div>
                                    </div>
                                </div>                                       

                                <!-- END DEFAULT WIZARD -->
                            </div>
                        </div>
                    </div>
                </div>            
                <!-- END PAGE CONTENT -->
            </div>
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

            <!-- THIS PAGE PLUGINS -->
            <script type="text/javascript" src="js/plugins/icheck/icheck.min.js"></script>
            <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
            <script type="text/javascript" src="js/plugins/dropzone/dropzone.min.js"></script>
            <script type="text/javascript" src="js/plugins/fileinput/fileinput.min.js"></script>        
            <script type="text/javascript" src="js/plugins/filetree/jqueryFileTree.js"></script>
            <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
            <script type="text/javascript" src="js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script> 
            <!-- END PAGE PLUGINS -->       

            <!-- START TEMPLATE -->
            <script type="text/javascript" src="js/settings.js"></script>

            <script type="text/javascript" src="js/plugins.js"></script>        
            <script type="text/javascript" src="js/actions.js"></script>        
            <!-- END TEMPLATE -->
            <!-- END SCRIPTS -->         
        </body>
    </html>

<?php
} else {
    echo "<script>window.location='login.php'; </script>";
}
?>