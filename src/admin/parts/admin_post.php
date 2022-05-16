<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_reporting(0);
    if($_POST['list']!=NULL){
        header("Location: index.php");
    }
    if($_POST['logout']!=NULL){
        session_destroy();
        header("Location: ../../toppage/pages/login.php");
    }
}
?>