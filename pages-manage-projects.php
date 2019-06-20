<?php
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['s_id']))) {
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
                                    $email = $_SESSION['email'];
                                    $q = "select *from student_master where email='$email'";
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
                        <li>
                            <a href="stud-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 
                        <li class="active">
                            <a href="pages-manage-projects.php"><span class="fa fa-pencil"></span><span class="xn-text"> Manage Projects</span></a>
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
                        <li class="active">Manage Project</li>
                    </ul>
                    <!-- END BREADCRUMB -->                       

                    <!-- PAGE CONTENT WRAPPER -->
                    <div class="page-content-wrap">

                        <div class="col-md-10">

                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <div class="panel-title-box">
                                        <h3>Upload the documents for this projects</h3>
                                        <span>Course activity</span>
                                    </div>                                    

                                </div>
                                <div class="panel-body panel-body-table">
                                    <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form" >
                                        <div class="table-responsive">
                                            <table class="table table-condensed table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">Document name </th>
                                                        <th width="70%">Description</th>
                                                        <th width="10%">Activity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input class="validate[required] form-control" type="text" name="doc_name" ></td>
                                                        <td><input class="form-control" type="text" name="description"></td> 
                                                        <td>
                                                            <div class="form-group">
                                                                <input class="form-control-static" type="file" name="file">
                                                                <button type="submit" name="btnupload" class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>  
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->

                            <?php
                            if (isset($_POST['btnupload'])) {
                                $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
                                $file_loc = $_FILES['file']['tmp_name'];
                                $file_size = $_FILES['file']['size'];
                                $file_type = $_FILES['file']['type'];
                                $folder = "p_uploads/";
                                $doc_name = trim($_POST['doc_name']);
                                $description = trim($_POST['description']);
                                $new_size = $file_size;
                                $id = $_SESSION['s_id'];
                                if (move_uploaded_file($file_loc, $folder . $file)) {
                                    $sql1 = "INSERT INTO projectDocs_master(stud_id,file_type,file_size,doc_name,description) VALUES('$id','$file_type','$new_size','$doc_name','$description')";
                                    mysql_query($sql1)or die("query failed:" . mysql_errno() . mysql_error());
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
                                                <td>Document Name</td>
                                                <td>Description</td>
                                                <td>Comments</td>
                                                <td>View</td>
                                            </tr></thead>
                                        <?php
                                        $stud_id = $_SESSION['s_id'];
                                        $sql = "SELECT * FROM projectDocs_master where stud_id='$stud_id'";
                                        $result_set = mysql_query($sql);
                                        while ($row4 = mysql_fetch_array($result_set)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row4['doc_name'] ?></td>
                                                    <td><?php echo $row4['description'] ?></td>
                                                    <td><?php echo $row4['comments'] ?></td>
                                                    <td><a href="p_uploads/<?php echo $row4['doc_name'] ?>" target="_blank">view file</a></td>
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