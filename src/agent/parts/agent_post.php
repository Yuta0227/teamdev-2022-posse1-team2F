<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_reporting(0);
    if($_POST['profile']!=NULL){
        header("Location:/agent/pages/profile.php?year=".$_GET['year']."&month=".$_GETE['month']."&date=".$_GET['date']);
    }
    if($_POST['list']!=NULL){
        header("Location:/agent/pages/index.php?year=".$_GET['year']."&month=".$_GETE['month']."&date=".$_GET['date']);
    }
    if($_POST['logout']!=NULL){
        header("Location:/toppage/pages/login.php");
        session_destroy();
    }
}
?>