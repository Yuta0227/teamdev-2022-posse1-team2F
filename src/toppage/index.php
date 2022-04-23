<?php
session_start();
require("../dbconnect.php");

$stmt = $db->query('SELECT id, title FROM events');
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="./top.css">
</head>
<?php require "header.php";?>
<!-- <ul>
    <?php foreach ($events as $key => $event) : ?>
        <li>
            <?= $event["id"]; ?>:<?= $event["title"]; ?>
        </li>
    <?php endforeach; ?>
    <a href="/admin/index.php">管理者ページ</a>
</ul> -->
<section>
<?php require "sort_filter_guide.php";?>
<?php require "guide_popup.php";?>
<?php require "filter_popup.php";?><!--場所変更の可能性大-->
<?php require "agent_list.php";?>
<?php require "agent_list_pagination.php";?>
</section>

<body>
</body>
<?php require "footer.php";?>
</html>