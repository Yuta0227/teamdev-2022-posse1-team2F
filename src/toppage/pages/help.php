<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ヘルプページ</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/others.css">
</head>

<body>
    <?php require "../parts/header.php"; ?>
    <?php require "../../dbconnect.php";?>
    <div class="help">
        <div>
            <p>就活エージェントへの応募に関するご不明点や企業様の掲載申込等の問い合わせは現在メールで受け付けております。</p>
            <p>お問い合わせ先はこちら</p>
            <p class="help-mail">
                <?php
                $help_email_stmt=$db->query("select * from help_email;");
                $help_email=$help_email_stmt->fetchAll()[0];
                echo $help_email['email'];
                ?>
            </p>
        </div>
    </div>
    <?php require "../parts/footer.php"; ?>
</body>

</html>