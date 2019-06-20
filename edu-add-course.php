<?php
include('dbconnect.php');

function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
    ?>
    <?php
    if (isset($_POST['submit'])) {
        $no = trim($_POST['course_number']);
        $string = generateRandomString();
        $name = trim($_POST['course_name']);
        $level = trim($_POST['course_level']);
        $sd = trim($_POST['sdate']);
        $ed = trim($_POST['edate']);
        $term = trim($_POST['courseTerm']);
        $description = trim($_POST['course_description']);
        $hr = trim($_POST['hours']);
        $pl = trim($_POST['place']);
        $type = trim($_POST['org_type']);
        $ar = trim($_POST['area']);
        $sz = trim($_POST['size']);
        $commit = trim($_POST['org_commitments']);
        $id = $_SESSION['id'];
        $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder = "uploads/course/";
        $new_size = $file_size;
        $q1 = "select * from course where course_id='$no'";
        $sth1 = mysql_query($q1);
        $count1 = mysql_fetch_array($sth1);
        if ($count1 > 0) {
            echo "<script> alert('This course is Already exists.. Please add another course! ');  </script>";
        } else {

            if (move_uploaded_file($file_loc, $folder . $file)) {

                $q12 = "select course_id from course_master_univ where course_id='$no'";
                $sth12 = mysql_query($q12);
                $count2 = mysql_fetch_array($sth12);
                if ($count2 > 0) {
                    $q_c_master = "update course_master_univ set course_name='$name', course_description='$description' where course_id='$no'";
                    $sth_c_master = mysql_query($q_c_master);
                    $q_course = "insert into course(course_id,access_code,course_level,start_date,end_date,class_size,course_term,project_hours,place,org_type,org_area,file,org_commitments,teacher_id) values('$no','$string','$level','$sd','$ed','$sz','$term','$hr','$pl','$type','$ar','$file','$commit','$id')";
                    $sth_course = mysql_query($q_course);
                    if ($sth_c_master && $sth_course) {
                        echo "<script> alert('Added Course Successfully!!');window.location='edu-dashboard.php';</script>";
                    } else {
                        echo "<script> alert('Cannot add course!!..Please try later!');</script>";
                    }
                } else {
                    $qc_master = "insert into course_master_univ(course_id,course_name,course_description) values ('$no','$name','$description')";
                    $qcourse = "insert into course(course_id,access_code,course_level,start_date,end_date,class_size,course_term,project_hours,place,org_type,org_area,file,org_commitments,teacher_id) values('$no','$string','$level','$sd','$ed','$sz','$term','$hr','$pl','$type','$ar','$file','$commit','$id')";
                    $sthc_master = mysql_query($qc_master);
                    $sthcourse = mysql_query($qcourse);
                    if ($sthc_master && $sthcourse) {
                        echo "<script> alert('Course Added Successfully!!');window.location='edu-dashboard.php';</script>";
                    } else {
                        echo "<script> alert('Cannot add new course!!');</script>";
                    }
                }
            } else {
                echo "<script> alert('Please enter all the fields and try another course name!');</script>";
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
                            <a href="#"></a>
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
                                    //	include('dbconnect.php');
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


                        <li class="active">
                            <a href="#"><span class="fa fa-plus"></span><span class="xn-text"> Add Course</span></a>

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
                        <li class="active">Add Course</li>
                    </ul>
                    <!-- END BREADCRUMB -->                       

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Add Course</h3> 
                                    </div>     
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <form role="form" action="edu-add-course.php" method="post">
                                                <?php
                                                $q = "select * from course_master_univ ";
                                                $sth = mysql_query($q);
                                                ?>
                                                <div class="form-group">
                                                    <div class="col-md-8">
                                                        <input list="courseCode" class="form-control" name="course_go_id" placeholder="Course Code">
                                                        <datalist id="courseCode">
                                                            <?php while ($result = mysql_fetch_array($sth)):; ?>
                                                                <option value="<?php echo $result[course_id]; ?>"></option>
                                                            <?php endwhile; ?> 
                                                        </datalist>

                                                    </div>
                                                </div>
                                                <button type="submit" name="submit1" class="btn btn-primary">Go</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                            </div>


                            <!-- START WIZARD WITH SUBMIT BUTTON -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php
                                    $number1 = trim($_POST['course_go_id']);
                                    $ccheck = "select * from course where course_id = '$number1' ";
                                    $sthcc = mysql_query($ccheck);
                                    $ccount1 = mysql_fetch_array($sthcc);
                                    $q = "select * from course_master_univ where course_id = '$number1' ";
                                    $sth = mysql_query($q);
                                    $r = mysql_fetch_array($sth);
                                    if ($ccount1 > 0) {
                                        echo "<script> alert('This course is Already taken by another educator.. Please change the course code! ');</script>";
                                    }
                                    ?>
                                    <h3>Course Information</h3> 
                                    <form method="post" action="edu-add-course.php" enctype="multipart/form-data" class="form-horizontal" role="form" >


                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Code</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="course_number" value="<?php echo $r['course_id']; ?>" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="course_name" value="<?php echo $r['course_name']; ?>" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Level</label>
                                            <div class="col-md-8">
                                                <select name="course_level" id="role" class="form-control validate[required]" required>  

                                                    <option> Select One</option>
                                                    <option value="Undergrad">Undergraduate</option>
                                                    <option value="Graduate">Graduate</option>
                                                    <option value="Graduate and Undergraduate">Graduate and Undergraduate</option>
                                                </select> 
                                            </div>                        
                                        </div>
                                        <div class="form-group">                                        
                                            <label class="col-md-2 control-label">Start Date</label>
                                            <div class="col-md-8">
                                                <div class="form-group date">
                                               <!--     <span class="input-group-addon"><span class="fa fa-calendar"></span></span> -->
                                                    <input type="date" name="sdate" class="form-control" placeholder="Start Date" required>                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">                                        
                                            <label class="col-md-2 control-label">End Date</label>
                                            <div class="col-md-8">
                                                <div class="form-group date">
                                                   <!-- <span class="input-group-addon"><span class="fa fa-calendar"></span></span> -->
                                                    <input type="date" name="edate" class="form-control" placeholder="End Date" required>                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Size</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="size" placeholder="Enter the Class Size" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Term</label>
                                            <div class="col-md-8">
                                                <select name="courseTerm" id="role" class="form-control validate[required]" required>  

                                                    <option> Select One</option>
                                                    <option value="spring">Spring</option>
                                                    <option value="summer">Summer</option>
                                                    <option value="fall">Fall</option>
                                                </select> 
                                            </div>                        
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Description</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="5" name="course_description" required ><?php echo $r['course_description']; ?> </textarea>

                                            </div>
                                        </div>
                                        <h3>Organization Information</h3> 
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Project Hours</label>
                                            <div class="col-md-8">
                                                <input type="text" name="hours" class="form-control" placeholder="Project Hours" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"> Organization Place</label>
                                            <div class="col-md-8">
                                                <input type="text" name="place" class="form-control" placeholder="Enter City,State Name" required/>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Organization Type</label>
                                            <div class="col-md-8">
                                                <select name="org_type" id="role" class="form-control validate[required]" required>  

                                                    <option> Select One</option>
                                                    <option value="small">Small(10-49 Employees)</option>
                                                    <option value="medium">Medium(50-249 Employees)</option>
                                                    <option value="large">Large(250+ Employees)</option>
                                                </select> 
                                            </div>                        
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Organization Categories</label>
                                            <div class="col-md-8">
                                                <input type="text" name="area" class="form-control" placeholder="Organization's Area of Operation " required/>
                                            </div>
                                        </div>                                                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Project Examples</label>

                                            <div class="col-md-8">                                                                                            
                                                <span class="help-block">Please do not Upload any  Image file!</span>
                                                <input class="form-control" type="file" name="file" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Organization Commitments</label>
                                            <div class="col-md-8">                                            
                                                <textarea class="form-control" name="org_commitments" rows="5" required></textarea>

                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>                        
                            <!-- END WIZARD WITH SUBMIT BUTTON -->

                        </div>       
                    </div>
                    <!-- END PAGE CONTENT WRAPPER -->                                
                </div>            
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
            <script type="text/javascript" src="js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script> 
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