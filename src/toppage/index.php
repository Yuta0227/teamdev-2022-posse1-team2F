<?php
session_start();
require("../dbconnect.php");

// $stmt = $db->query('SELECT id, title FROM events');
// $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/top.css">
</head>

<body>
<div class="topbox">
<?php require "header.php"; ?>
<?php require "indicator.php"; ?>
</div>

<div class="main-informations">
        <section class="modal-size">
            <?php require "sort_filter_guide.php"; ?>
            
            <!--場所変更の可能性大-->
            <?php require "agent_list.php"; ?>
            <?php require "guide_popup.php"; ?>
            <?php require "agent_list_pagination.php"; ?>
        </section>
    
    <div class="filter-box">
        <?php require "filter_popup.php"; ?>
    </div>
</div>



<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
<?php require "footer.php"; ?>

</html>