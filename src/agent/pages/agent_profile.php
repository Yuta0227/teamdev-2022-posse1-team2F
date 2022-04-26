<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェントプロフィール</title>
</head>

<?php
require "../parts/agent_header.php";
?>

<body style="display:flex;flex-direction:column;justify-content:center;">
    <section>
        <h1><?php echo 'エージェント名'; ?>さんのプロフィール</h1>
    </section>
    <?php
    require "../parts/agent_public_information.php";
    require "../parts/agent_private_information.php";
    ?>
</body>
<?php require "../../toppage/footer.php"; ?>


</html>