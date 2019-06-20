<?php
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
?>
<?php
    if (isset($_POST['submit1'])) {
        $course_id = trim($_POST[course_id]);
        $id = $_SESSION['id'];
        $q = "select * from course where teacher_id='$id' and course_id = '$course_id'";
        $sth = mysql_query($q);
        $row1 = mysql_fetch_array($sth);
        $code = $row1[access_code];
        $class = $row1[course_id];
        $to = $_POST[stud_id];
        require 'class.phpmailer.php';
        require 'class.smtp.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup server
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = 'testpconn@gmail.com';  //SMTP username
        $mail->Password = 'pconntestumb';  // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        $mail->From = 'testpconn@gmail.com';
        $mail->FromName = 'PConnect';
        foreach ($to as $e) {
            $mail->addAddress($e);
        }
        $mail->WordWrap = 50;  // Set word wrap to 50 characters
        // $mail->addAttachment('/var/tmp/file.tar.gz');  // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name
        $mail->isHTML(true);  // Set email format to HTML

        $mail->Subject = 'Pconnect Test!';
        $mail->Body = 'Your <b> Access code :</b> ';
        $mail->Body .= $code;
        $mail->Body .= '<br><b>For Course :</b>';
        $mail->Body .= $class;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            echo "<script> alert('Message sent Successfully !'); </script>";
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
                                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                                </div>
                            </div>                                                                        
                        </li>
                        <li>
                            <a href="edu-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 
                        <li class="xn-openable">
                            <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Courses</span></a>

                            <ul type="hidden" name="action" value="view_class"><?php
                                //include_once('dbconnect.php');
                                $id = $_SESSION['id'];
                                $q = "select * from course c, course_master_univ u where u.course_id = c.course_id and teacher_id='$id'";
                                $sth = mysql_query($q);
                                // $i = 0;
                                while ($row = mysql_fetch_object($sth)) {
                                    echo'<li><a href="pages-course.php?course_id=' . $row->course_id . '"><span class="xn-text">' . $row->course_name . ' </span></a></li>';
                                }
                                    ?>
                            </ul>
                            <ul>
                                <!--  <li><a href="dashboard-dark.html"><span class="xn-text">Add Course</span></a><div class="informer informer-danger">New!</div></li> -->
                                <li><a href="edu-add-course.php"><span class="xn-text"></span> Add Course</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="pages-manage-courses.php"><span class="fa fa-pencil"></span><span class="xn-text"> Manage Courses</span></a>
                        </li>
                        <li class="active">
                            <a href="pages-manage-students.php"><span class="fa fa-university"></span><span class="xn-text"> Manage students</span></a>
                        </li>
                        <li>
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
                        <li class="active">Dashboard</li>
                    </ul>
                    <!-- END BREADCRUMB -->                       

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">

                        <!-- START WIDGETS -->                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Add students to your class</h3>
                                    <span>Please select the respective course and student and enroll them to the class</span>
                                </div>                                    

                            </div>
                            <div class="panel-body panel-body-table">

                                <div class="table-responsive">
                                    <form role="form" action="pages-manage-students.php" method="post">

                                        <table class="table table-condensed table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Course Name</th>
                                                    <th width="60%">Student Name</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    $id = $_SESSION['id'];
                                                    $q = "select * from course where teacher_id='$id'";
                                                    $sth = mysql_query($q);
                                                    ?>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input list="courseCode" class="form-control" name="course_id" placeholder="Course Id" required>
                                                            <datalist id="courseCode" >
                                                                <option value="">Select the course</option>
                                                                <?php while ($result = mysql_fetch_array($sth)):; ?>
                                                                    <option value="<?php echo $result[course_id]; ?>"><?php echo $result[course_id]; ?></option>
                                                                <?php endwhile; ?> 
                                                            </datalist>                           
                                                            <span class="help-block">Required</span>
                                                        </div> 
                                                    </td>

                                                    <?php
                                                    $id = $_SESSION['id'];
                                                    $q = "select * from student_master";
                                                    $sth = mysql_query($q);
                                                    ?>
                                                    <td>
                                                        <div class="col-md-10">
                                                            <input list="studCode" type="email" class="form-control" multiple  name="stud_id[]" placeholder="Student Email" required>
                                                            <datalist id="studCode" >

                                                                <?php while ($result = mysql_fetch_array($sth)):; ?>
                                                                    <option value="<?php echo $result[email]; ?>"><?php echo $result[email]; ?></option>
                                                                <?php endwhile; ?> 
                                                            </datalist>                           
                                                            <span class="help-block">Required</span>
                                                        </div> 
                                                    </td>

                                                    <td>
                                                        <button type="submit"  name="submit1"  class="btn btn-success btn-rounded" ><b>Enroll</b></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>   
                                </div>

                            </div>
                        </div> 
                        <!-- END WIDGETS -->  
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
                                <a href="index.php" class="btn btn-success btn-lg">Yes</a>
                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                            </div>
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
}
else {

    echo "<script>window.location='login.php'; </script>";
    echo 'error';
}
?>