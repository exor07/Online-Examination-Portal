<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('dbconnect.php');
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$o_id = $_SESSION['id'];
$s_id = $_SESSION['id'];
session_unset();
session_destroy();
echo "<script>window.location='login.php'; </script>";
exit();
?>  