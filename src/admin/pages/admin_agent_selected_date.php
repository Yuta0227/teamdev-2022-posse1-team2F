<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面企業詳細特定日</title>
</head>

<body>
    <?php
    require "../../dbconnect.php";
    require "../../function.php";
    require "../admin_function.php";
    require "../parts/header.php";
    require "../parts/admin_agent_selected_date/apply_list.php";
    ?>
</body>

</html>