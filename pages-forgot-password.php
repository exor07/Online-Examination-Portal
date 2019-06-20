<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
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

        <div class="registration-container">            
            <div class="registration-box animated fadeInDown">
                <div class="registration"></div>
                <div class="registration-body">
                    <div class="registration-title"><strong>Forgot</strong> Password?</div>
                    <div class="registration-subtitle">Please Enter Your Registered Email Address.</div>
                    <form action="pages-forgot-password.php" class="form-horizontal" method="post">                        
                        <h4>Your E-mail</h4>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="email@domain.com" required/>
                            </div>
                        </div>                                                            
                        <div class="form-group push-up-20">
                            <div class="col-md-6">
                                <button name='submit' class="btn btn-success btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="registration-footer">
                    <div class="pull-left">
                        &copy; 2018 PConnect
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>