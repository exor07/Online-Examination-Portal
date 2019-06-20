<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect.php');
if ((isset($_SESSION['email'])) && (isset($_SESSION['o_id']))) {
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
                                    include('dbconnect.php');
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

                        <li >
                            <a href="org-dashboard.php"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></a>   
                        </li> 


                        <li>
                            <a href="#"><span class="fa fa-pencil"></span><span class="xn-text"> Manage Requests</span></a>

                        </li>
                        <li class="active">
                            <a href="avail-project.php"><span class="fa fa-file"></span><span class="xn-text">All Projects</span></a>
                        </li>
                        <li>
                            <a href="uploads.php"><span class="fa fa-upload"></span> <span class="xn-text">Uploads</span></a>   
                        </li>
                        <li>
                            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Current Projects</span></a>   
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
                        <li class="active">Available Projects</li>
                    </ul>
                    <!-- END BREADCRUMB -->    

                    <div class="page-content-wrap page-tabs-item active" id="first-tab">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">

                                        <!-- START DEFAULT PANEL -->
                                        <div class="panel panel-default">

                                        </div>
                                        <!-- END DEFAULT PANEL -->

                                    </div>
                                    <div class="page-title">                    
                                        <h2><span class="fa fa-files-o"></span> Available Projects</h2>
                                    </div>

                                    <!-- START BASIC TABLE SAMPLE -->
                                    <!-- START SIMPLE DATATABLE -->
                                    <div class="panel panel-default">                                
                                        <div class="panel-body">
                                            <a href="#"><img class="card-img-top" src="img/proj_list.png" style=" width: 840px; height: 600px;"></a>
                                        </div>
                                    </div>
                                    <!-- END SIMPLE DATATABLE -->
                                    <!-- END BASIC TABLE SAMPLE -->                            

                                </div> 
                            </div>
                        </div>

                    </div>
                    <div class="page-content-wrap page-tabs-item" id="second-tab">

                    </div>
                    <!-- File Upload Process start-->
                    <div class="page-content-wrap page-tabs-item" id="third-tab">

                        <!-- File Upload End-->

                        <div class="page-content-wrap page-tabs-item" id="fifth-tab">

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
                            <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
                            <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

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
header('location:index.php');
}
?>