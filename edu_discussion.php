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
                                    <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                                </a>
                                <div class="profile">
                                    <div class="profile-image">
                                        <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
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
                                        <a href="edit-profile.php" class="profile-control-left"><span class="fa fa-info"></span></a>
                                    </div>
                                </div>                                                                        
                            </li>
                            <!-- <li class="xn-title">Navigation</li> -->
                            <li>
                                <a href="edu-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                            </li> 
                            <li>
                                <?php
                                $id = $_SESSION['id'];
                                $action = $_GET['course_id'];
                                $q = "select * from course c, course_master_univ u where u.course_id = c.course_id and c.course_id='$action'";
                                $sth = mysql_query($q);
                                $row = mysql_fetch_array($sth);
                                ?>
                                <a href="pages-course.php?course_id=<?php echo $action; ?>"><span class="fa fa-book"></span> <span class="xn-text"><?php echo $row['course_id'], ' ', $row['course_name']; ?></span></a>
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
                        <li href="edu-dshboard.php">Dashboard</li>
                        <li href="pages-course.php?course_id=<?php echo $action; ?>">Course</li>
                        <li class="active">Assign Project</li>
                    </ul>
                    <!-- END BREADCRUMB -->                       

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- START CONTENT FRAME -->
                                <div class="content-frame">                                    
                                    <!-- START CONTENT FRAME TOP -->
                                    <div class="content-frame-top">                        
                                        <div class="page-title">                    
                                            <h2><span class="fa fa-comments"></span> Discussion</h2>
                                        </div>                                                    
                                        <div class="pull-right">                            

                                            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
                                        </div>                           
                                    </div>
                                    <!-- END CONTENT FRAME TOP -->
                                    <?php
                                    if (isset($_POST['send'])) {
                                        $message = trim($_POST['post_text']);
                                        $id = $_SESSION['id'];
                                        $action = $_GET['course_id'];
                                        $q = "insert into discussion(message, course_id, id, date_sent)values('$message', '$action', '$id', CURRENT_TIMESTAMP ) ";
                                        $sth = mysql_query($q); //or die("query failed:" .mysql_errno() .mysql_error()); 
                                        if ($sth) {
                                            header('location:pages-course.php');
                                        } else {
                                            
                                        }
                                    }
                                    ?>
                                    <!-- START CONTENT FRAME BODY -->
                                    <div class="content-frame-body content-frame-body-left">

                                        <div class="messages messages">
                                            <div class="item" class="form-group">

                                                <div class="item">
                                                        <?php
                                                        $message = $_GET['message'];
                                                        $id = $_SESSION['id'];
                                                        $action = $_GET['course_id'];
                                                        $q = "select * from discussion d, teacher_master t where t.teacher_id=d.id and d.id= '$id'and course_id='$action' and t.teacher_id=d.id and d.id='$id'ORDER BY date_sent ASC";
                                                        $sth = mysql_query($q);
                                                        ?>

                                                        <?php while ($row = mysql_fetch_array($sth)) { ?>

                                                            <div class="text" class ="form-group">
                                                                <div class="heading">
                                                                    <a href="pages-course.php"><?php echo $row['firstName'] . " " . $row['lastName']; ?></a>
                                                                    <span class="date"><?php echo $row['date_sent'] ?></span>
                                                                </div>
                                                                <?php echo $row['message']; ?>
                                                            </div>
                                                        <?php } ?>       
                                                    </div>

                                                <div class="panel panel-default push-up-10">

                                                    <div class="panel-body panel-body-search">
                                                        <form role="form" method="post">
                                                            <div class="input-group" class="form-group">
                                                                <input type="text" name="post_text" class="form-control" placeholder="Type Your message here..."/>
                                                                <div class="input-group-btn" class="form-group">
                                                                    <button type="submit" name="send"class="btn btn-default">Send</button> 
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- END CONTENT FRAME BODY -->      
                                        </div>
                                        <!-- END PAGE CONTENT FRAME -->
                                    </div>
                                </div>      
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
            <div class="message-box message-box-success animated fadeIn" data-sound="alert" id="mb-sign">
                <div class="mb-container">
                    <div class="mb-middle">
                        <div class="mb-title"><span class="fa fa-plus-square"></span> Add <strong>Course</strong></div>
                        <div class="modal-body form-horizontal ">                        
                            <form role="form" action="edu-dashboard.php" method="post">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Number</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="course_number"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="course_name"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="course_description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="mb-footer">
                                    <div class="pull-right">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg" >Add</button>
                                        <button class="btn btn-danger btn-lg mb-control-close">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MESSAGE BOX-->

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
    echo 'error';
}
?>