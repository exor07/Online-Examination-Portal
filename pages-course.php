<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['id']))) {
    ?>
    <?php
    if (isset($_POST['rid'])) {
        $rid = $_POST['rid'];
        $no = $_POST['nos'];
        $id = $_SESSION['id'];
        $i = 0;
        foreach ($rid as $r) {
            if ($no[$i] != 0) {
                $q1 = "update project_request set nos='$no[$i]' where request_id='$r' and teacher_id='$id'";
                mysql_query($q1);
            }
            $i += 1;
        }
    }
    $id = $_SESSION['id'];
    $action1 = $_GET['course_id'];
    $q = "select * from project_request where teacher_id='$id' and course_id='$action1' and status = '1'";
    $qr = mysql_query($q);
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
                                    //include('dbconnect.php');
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
                        <li class="active">
                            <?php
                            $id = $_SESSION['id'];
                            $action = $_GET['course_id'];
                            $q = "select * from course c, course_master_univ u where u.course_id = c.course_id and c.course_id='$action'";
                            $sth = mysql_query($q);
                            $row = mysql_fetch_array($sth);
                            ?>
                            <a href="#"><span class="fa fa-book"></span> <span class="xn-text"><?php echo $row['course_id'], ' ', $row['course_name']; ?></span></a>
                        </li>
                        <li>
                            <a href="edu_discussion.php?course_id=<?php echo $action; ?>"><span class="fa fa-comments"></span> <span class="xn-text">Discussion Board</span></a>   
                        </li> 
                        <li>
                            <a href="edu_groups.php?course_id=<?php echo $action; ?>"><span class="fa fa-group"></span> <span class="xn-text">Assign Project</span></a>   
                        </li> 

                        <li class="xn-openable">
                            <a href="#"><span class="fa fa-key"></span> <span class="xn-text">Access Code</span></a>
                            <ul type="hidden" name="action" value="view_code">
                                <?php
                                $cid12 = $_GET['course_id'];
                                ;
                                $id12 = $_SESSION['id'];
                                $q121 = "select * from course where teacher_id='$id12' and course_id = '$cid12'";
                                $sth12 = mysql_query($q121);
                                $row12 = mysql_fetch_array($sth12)
                                ?>
                                <li><a href="#"><span class="xn-text"><strong><?php echo $row12[access_code]; ?></strong></span></a></li>
                            </ul>
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
                                <li><a href="index.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                            </ul>                        
                        </li> 
                        <!-- END POWER OFF -->                    

                    </ul>
                    <!-- END X-NAVIGATION VERTICAL -->                     

                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>                    
                        <li class="#">Dashboard</li>
                        <li class="active">Courses</li>
                    </ul>
                    <!-- END BREADCRUMB -->    


                    <!-- PAGE CONTENT TABBED -->
                    <div class="page-tabs">
                        <a href="#first-tab" class="active" >Welcome</a>
                        <a href="#second-tab">Projects</a>
                        <a href="#third-tab">Assignments</a>
                        <a href="#fourth-tab">Students</a>
                    </div>

                        <div class="page-content-wrap page-tabs-item active" id="first-tab">

                            <div class="row">
                                <div class="col-md-12">    
                                    <div class="row">
                                        <div class="col-md-6">                           

                                            <!-- START PROJECTS BLOCK -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title-box">
                                                        <h3>Project List </h3>
                                                        <span>Update Preference</span>
                                                    </div>                                    

                                                </div>
                                                <form role="form" action="pages-course.php?course_id=<?php echo $action; ?>" method="post">
                                                    <div class="panel-body panel-body-table">

                                                        <div class="table-responsive">
                                                            <table class="table table-condensed table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">Request Number</th>
                                                                        <th width="60%">Project Title</th>
                                                                        <th width="20%">Number of Students</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if ($qr) {
                                                                        ?>
                                                                        <?php
                                                                        while ($row = mysql_fetch_array($qr)) {
                                                                            echo "<tr><td><div class=\"col-xs-6\"><input type=\"text\" readonly class=\"form-control\" value='{$row['request_id']}' name=\"rid[]\" /></div></td>";
                                                                            echo "<td><a type=\"text\" value='{$row['title']}' name=\"pd[]\" readonly >{$row['title']}</a></td>";
                                                                            echo "<td><div class=\"col-xs-8\"><input class=\"form-control\" type=\"number\" value='{$row['nos']}' name=\"nos[]\" placeholder=\" Number of Students\" /></div></td></tr>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <tr><td><input type="submit" value="Update" /></td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PROJECTS BLOCK -->
                                        </div> 

                                    </div>
                                </div>
                            </div>
                        </div>

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

                        <div class="page-content-wrap page-tabs-item" id="second-tab">

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- START ACCORDION -->        
                                    <div class="panel-group accordion">
                                        <?php
                                        $id = $_SESSION['id'];
                                        $action1 = $_GET['course_id'];
                                        $q = "select * from project_request where teacher_id='$id' and course_id='$action1' and status = '1'";
                                        $qr1 = mysql_query($q);
                                        ?>
                                        <?php
                                        while ($row1 = mysql_fetch_array($qr1)) {
                                            ?>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accOneColOne">
                                                            <?php echo $row1['title']; ?>
                                                        </a>
                                                    </h4>
                                                </div>                                
                                                <div class="panel-body panel-body-open" id="accOneColOne">
                                                    <?php echo $row1['project_description']; ?>
                                                    <p></p>
                                                    <p><strong><a type="hidden" href="pages-timeline.php?course_id=<?php echo $action . "&request_id=" . $row1['request_id']; ?>">View Details</a></strong></p>
                                                </div>                                
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- END ACCORDION -->                        
                            </div>
                        </div>
                    </div>
                    <div class="page-content-wrap page-tabs-item" id="third-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h3><span class="fa fa-mail-forward"></span> Post Assignment</h3>


                                        <form method="post" enctype="multipart/form-data" class="form-horizontal"role="form" >
                                            <div class="form-group">
                                                <label>Select the File</label>
                                                <input class="form-control" type="file" name="file">
                                            </div>
                                                <button type="submit" name="btnupload" class="btn btn-primary">Upload</button>
                                            </form>
                                        </div>
                                    </div>

                                    <?php
                                    if (isset($_POST['btnupload'])) {
                                        $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
                                        $file_loc = $_FILES['file']['tmp_name'];
                                        $file_size = $_FILES['file']['size'];
                                        $file_type = $_FILES['file']['type'];
                                        $folder = "uploads/";
                                        $new_size = $file_size;
                                        $id = $_SESSION['id'];
                                        $action1 = $_GET['course_id'];
                                        if (move_uploaded_file($file_loc, $folder . $file)) {
                                            $sql = "INSERT INTO assignment(file_name,file_type,file_size,teacher_id,course_id) VALUES('$file','$file_type','$new_size',$id,'$action1')";
                                            mysql_query($sql)or die("query failed:" . mysql_errno() . mysql_error());
                                            ?>
                                            <?php
                                        } else {
                                            
                                        }
                                    }
                                    ?>
                                    <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title-box">
                                            <h3>Assignments</h3>
                                            <span>Uploads</span>
                                        </div>
                                    </div>
                                    <div class="panel-body ">
                                        <table class="table datatable" >
                                            <thead>
                                                <tr>
                                                    <td>File Name</td>
                                                    <td>File Type</td>
                                                        <td>File Size(KB)</td>
                                                        <td>View</td>
                                                    </tr></thead>
                                                <?php
                                                $id = $_SESSION['id'];
                                                $action1 = $_GET['course_id'];
                                                $sql = "SELECT * FROM assignment where teacher_id='$id' and course_id='$action1'";
                                                $result_set = mysql_query($sql);
                                                while ($row4 = mysql_fetch_array($result_set)) {
                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $row4['file_name'] ?></td>
                                                            <td><?php echo $row4['file_type'] ?></td>
                                                            <td><?php echo $row4['file_size'] ?></td>
                                                            <td><a href="uploads/<?php echo $row4['file_name'] ?>" target="_blank">view file</a></td>
                                                        </tr>
                                                    </tbody>
                                                <?php }
                                                ?>
                                            </table>
                                        </div>
                                </div>   
                            </div>
                        </div>
                    </div>


                    <div class="page-content-wrap page-tabs-item" id="fourth-tab">


                        <div class="col-md-12">
                            <!-- START CONTACTS -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Student List</h3>
                                </div>
                                    <?php
                                    $id = $_SESSION['id'];
                                    $action = $_GET['course_id'];
                                    $q = "select * from student_master s,enrolled_master e where s.stud_id =e.stud_id and e.course_id ='$action1' ";
                                    $sth = mysql_query($q);

                                    while ($row = mysql_fetch_object($sth)) {
                                        ?>
                                        <div class="panel-body list-group list-group-contacts">                                
                                            <a href="#" class="list-group-item">                                 
                                                <div class="list-group-status status-online"></div>
                                                <img src="assets/images/users/no-image.jpg" class="pull-left" alt="Dmitry Ivaniuk">
                                                <span class="contacts-title"><?php echo" $row->lastName  $row->firstName"; ?></span>
                                                <p><?php echo" $row->email"; ?></p>                                                                        
                                            </a>                                
                                        <?php } ?>                            
                                    </div>
                                </div>                            
                            <!-- END CONTACTS -->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT TABBED -->
                </div>            
                <!-- END PAGE CONTENT -->
            </div>
            <!-- END PAGE CONTAINER -->
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