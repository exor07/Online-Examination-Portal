<?php
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
?>
<?php
    if (isset($_POST['update'])) {

        $id = $_SESSION['id'];
        $request_id = $_GET['edit_pid'];
        $project_description = trim($_POST['project_description']);
        $q1 = "update project_request set project_description='$project_description' where request_id='$request_id' and teacher_id='$id'";
        $sth1 = mysql_query($q1); //or die("query failed:" .mysql_errno() .mysql_error()); 
        if ($sth1) {
            echo "<script>window.location='pages-organization-requests.php'; </script>";
        } else {
            echo "<script> alert('This course is Already exists.. Please try another course name!'); </script>";
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
                                <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                            </a>
                            <div class="profile">
                                <div class="profile-image">
                                    <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                                </div>
                                <div class="profile-data">
                                    <?php
                                    //include('dbconnect.php');
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
                        <li>
                            <a href="org-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 
                        <li class="xn-openable">
                            <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Courses</span></a>

                            <ul type="hidden" name="action" value="view_class">
                                <?php
                                $id = $_SESSION['id'];
                                $q = "select * from course where teacher_id='$id'";
                                $sth = mysql_query($q);
                                $i = 0;
                                while ($row = mysql_fetch_object($sth)) {
                                    echo'<li><a href="pages-course.php?course_id=' . $row->course_id . '"><span class="xn-text">' . $row->course_name . ' </span></a></li>';
                                }
                                ?>
                            </ul>
                            <ul>
                                <!--  <li><a href="dashboard-dark.html"><span class="xn-text">Add Course</span></a><div class="informer informer-danger">New!</div></li> -->
                                <li><a href="#" class="mb-control" data-box="#mb-sign"><span class="xn-text"></span> Add Course</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="pages-manage-courses.php"><span class="fa fa-pencil"></span><span class="xn-text"> Manage Courses</span></a>
                        </li>

                        <li class="active">
                            <a href="pages-organization-requests.php"><span class="fa fa-sitemap"></span> <span class="xn-text">Organization Requests</span></a>   
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
                        <li class="active">Manage Courses</li>
                    </ul>
                    <!-- END BREADCRUMB -->                       

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">

                        <div class="col-md-10">

                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Organization request for editing</h3>
                                        <span>Please review the project description below and update it according to the class requirements</span>
                                    </div>                                    

                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <form role="form" action="#" method="post">

                                                <?php
                                                $request_id = $_GET['edit_pid'];
                                                $id = $_SESSION['id'];
                                                $q = "select * from project_request p, course c where p.teacher_id='$id' and p.request_id='$request_id' ";
                                                $sth = mysql_query($q);
                                                $result = mysql_fetch_array($sth);
                                                ?>

                                                <div class="form-group">
                                                    <label>Course Name</label>
                                                    <input class="form-control" type="text" name="course_name" value="<?php echo $result['course_name']; ?>" disabled >
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Description</label>
                                                    <input type="text" value="<?php echo $result['project_description']; ?>" class="form-control" name="project_description" required/>
                                                </div>

                                                <button type="submit" name="update" class="btn btn-primary">Update</button>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- END PROJECTS BLOCK -->

                            </div>
                        </div>

                    </div>
                    <!-- END PAGE CONTENT WRAPPER -->                                
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
                            <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ..

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
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
//echo "<script>window.location='login.php'; </script>";
    echo 'error';
}
?>