<?php
session_start();
require "../parts/agent_post.php";

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェントプロフィール</title>
</head>

<body style="display:flex;flex-direction:column;justify-content:center;width:100%;height:100%;position:relative;">
    <?php
    require "../parts/agent_header.php";
    ?>
    <section>
        <h1><?php echo 'エージェント名'; ?>さんのプロフィール</h1>
    </section>
    <?php
    require "../../function.php";
    require "../parts/agent_public_information.php";
    require "../parts/agent_private_information.php";
    require "../parts/agent_profile_popup.php";
    ?>
    <?php require "../../toppage/parts/footer.php"; ?>
</body>


</html>