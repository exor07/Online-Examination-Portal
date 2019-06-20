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
            <link rel="stylesheet/less" type="text/css" href="css/styles.less"/>
            <script type="text/javascript" src="js/plugins/lesscss/less.min.js"></script>                
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
                                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                                </div>
                            </div>                                                                        
                        </li>
                        <!--<li class="xn-title">Navigation</li>-->
                        <li>
                            <a href="edu-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 

                        <li class="active">
                                <?php
                                // include('dbconnect.php');
                                $id = $_SESSION['id'];
                                $action = $_GET['course_id'];
                                $q = "select * from course where teacher_id='$id' and course_id='$action'";
                                $sth = mysql_query($q);
                                $row = mysql_fetch_array($sth);
                                ?>
                            <a href="#"><span class="fa fa-book"></span> <span class="xn-text"><?php echo $row['course_id'], ' ', $row['course_name']; ?></span></a>
                        </li>

                        <li>
                            <a href="pages-manage-courses.php"><span class="fa fa-pencil"></span><span class="xn-text"> Manage Courses</span></a>           
                        </li>

                        <li>
                            <a href="pages-organization-requests.php"><span class="fa fa-sitemap"></span> <span class="xn-text">Organization Requests</span></a>   
                        </li>
                        <li class="active">
                            <a href="discussion.php"><span class="fa fa-comments"></span><span class="xn-text">Discussion</span></a>
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
                        <li class="active">Discussion</li>
                    </ul>
                    <!-- END BREADCRUMB -->    


                    <!-- PAGE CONTENT TABBED -->
                    <div class="page-tabs">
                        <a href="#first-tab" class="active">Discussion</a>
                    </div>

                    <div class="page-content-wrap page-tabs-item active" id="first-tab">
                        <div class="row">
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

                                <!-- START CONTENT FRAME BODY -->
                                <div class="content-frame-body content-frame-body-left">

                                    <div class="messages messages-img">
                                        <div class="item" class="form-group">

                                            <div class="item in">
                                                    <?php
                                                    // include('dbconnect.php');
                                                    $message = $_GET['message'];
                                                    $id = $_SESSION['id'];
                                                    $action = $_GET['course_id'];

                                                    //$posttime = date("g:ia", strtotime($post['date_sent']));
                                                    $q = "select * from discussion where teacher_id='$id' and course_id='$action' ORDER BY date_sent ASC";
                                                    //echo $q;
                                                    $sth = mysql_query($q);
                                                    // $row=mysql_fetch_array($sth);
                                                    ?>

                                                    <div class="image">
                                                        <img src="assets/images/users/user2.jpg" alt="John Doe">
                                                    </div>

                                                    <?php while ($row = mysql_fetch_array($sth)) { ?>
                                                        <div class="text" class ="form-group">

                                                            <div class="heading">
                                                                <a href="pages-course.php"><?php echo $result['firstName']; ?></a>

                                                                <span class="date"><?php echo $row['date_sent'] ?></span>

                                                            </div>
                                                            <?php echo $row['message']; ?>

                                                        </div>

                                                    <?php } ?>       
                                            </div>

                                            <div class="item">

                                                    <?php
                                                    // include('dbconnect.php');
                                                    $message = $_GET['message'];
                                                    $id = $_SESSION['id'];
                                                    $action = $_GET['course_id'];
                                                    // $posttime = date("g:ia", strtotime($post['date_sent']));
                                                    $q = "select * from s_discussion where teacher_id='$id' and course_id='$action' ORDER BY date_sent DESC";
                                                    // echo $q;
                                                    $sth1 = mysql_query($q);
                                                    // $row=mysql_fetch_array($sth);
                                                    ?>
                                                <div class="image">
                                                    <img src="assets/images/users/user.jpg" alt="Dmitry Ivaniuk">
                                                </div>
                                                        <?php
                                                        $email_id = $_GET['email'];
                                                        $stud_id = $_GET['stud_id'];
                                                        $q1 = "select * from student s, enrolled_master e where s.stud_id = '$stud_id' and e.stud_id = '$stud_id' and e.stud_id = s.stud_id and email='$email_id'";
                                                        //echo $q1;
                                                        $sth = mysql_query($q1);
                                                        //$result1=mysql_fetch_array($sth);

                                                        while ($row = mysql_fetch_array($sth1)) {
                                                            ?>
                                                    <div class="text" class="form-group">
                                                        <div class="heading">
                                                            <a href="pages-course.php"><?php echo $row['firstName']; ?></a>
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
                                                                <button type="submit" name="send"class="btn btn-default" >Send</button> 

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
                    <?php
                    if (isset($_POST['send'])) {
                        $message = trim($_POST['post_text']);
                        $id = $_SESSION['id'];
                        $action = $_GET['course_id'];
                        $q = "insert into discussion(message, course_id, teacher_id, date_sent)values('$message', '$action', '$id', CURRENT_TIMESTAMP ) ";
                        $sth = mysql_query($q); //or die("query failed:" .mysql_errno() .mysql_error()); 
                        if ($sth) {
                            
                        } else {
                            
                        }
                    }
                    ?>

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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script src="js/rChat.js"></script>
                    <script type="text/javascript" src="js/plugins/icheck/icheck.min.js"></script>
                    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
                    <script type="text/javascript" src="js/plugins/dropzone/dropzone.min.js"></script>
                    <script type="text/javascript" src="js/plugins/fileinput/fileinput.min.js"></script>        
                    <script type="text/javascript" src="js/plugins/filetree/jqueryFileTree.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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