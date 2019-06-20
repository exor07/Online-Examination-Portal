<?php
include('dbconnect.php');

function find($a, $b) {
    $q = "select nos from project_request where teacher_id='{$a}' and request_id='{$b}'";
    $qr = mysql_query($q) or die(mysql_error());
    $row = mysql_fetch_array($qr);
    $count1 = $row['nos'];
    $q1 = "select * from projectpref where request_id='{$b}' and teacher_id='{$a}'";
    $q1r = mysql_query($q1) or die(mysql_error());
    $count2 = 0;
    if (mysql_num_rows($q1r) != 0) {
        $count2 = mysql_num_rows($q1r) or die(mysql_error());
    } else {
        $count2 = 0;
    }
    if ($count1 - $count2 > 0) {
        return true;
    } else {
        return false;
    }
}

if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
    ?>
    <?php
    $action1 = $_GET['course_id'];
    $q4 = "delete from projectpref";
    $q6 = "drop view if exists hello";
    mysql_query($q4) or die(mysql_error());
    mysql_query($q6) or die(mysql_error());
    $q = "create view hello as select stud_id,cno,request_id,teacher_id from student_choice order by cno asc";

    mysql_query($q) or die(mysql_error());
    $q1 = "select * from hello";
    $qr = mysql_query($q1) or die(mysql_error());
    while ($row = mysql_fetch_array($qr)) {
        $q11 = "select * from projectpref";
        $q12 = "select sum(nos) from project_request where teacher_id='$id' and course_id='$action1' and status = '1'";
        $q11r = mysql_query($q11) or die(mysql_error());
        $q12r = mysql_query($q12) or die(mysql_error());
        $r12 = mysql_fetch_array($q12r);
        if (mysql_num_rows($q11r) == $r12[0]) {
            echo $r12[0];
        }

        if (find($row['teacher_id'], $row['request_id'])) {
            $q4 = "select * from projectpref where stud_id='{$row['stud_id']}'";
            $q4r = mysql_query($q4);
            if (mysql_num_rows($q4r) == 0) {
                $q3 = "insert into projectpref values('{$row['stud_id']}','{$row['request_id']}','{$row['teacher_id']}')";
                mysql_query($q3) or die(mysql_error());
            }
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

                        <li class="active">
                            <a href="#"><span class="fa fa-group"></span><span class="xn-text"> Assign Projects</span></a>
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
                                <!-- START DEFAULT PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Final Project List</h3>
                                    </div>
                                    <div class="panel-body ">
                                            <?php
                                            $id = $_SESSION['id'];
                                            $action1 = $_GET['course_id'];
                                            $q5 = "select r.title, s.firstName, s.lastName from project_request r, student_master s, projectpref p where p.stud_id = s.stud_id and r.request_id = p.request_id and r.course_id ='$action'and p.teacher_id = $id";

                                            $q5r = mysql_query($q5) or die(mysql_error());
                                            ?>
                                            <table class="table table-condensed table-bordered table-striped">
                                                <tr><td>Project Title</td><td>Student Name</td></tr>
                                                <?php
                                                while ($row5 = mysql_fetch_array($q5r)) {
                                                    echo '<tr>';
                                                    echo "<td>{$row5['title']}</td>";
                                                    echo "<td>{$row5['firstName']} {$row5['lastName']}</td>";
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </table>
                                            <?php
                                            $q2 = "drop view hello";
                                            mysql_query($q2) or die(mysql_error());
                                            ?>

                                    </div>
                                </div>
                                <!-- END DEFAULT PANEL -->                   
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