<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンクスページ</title>
</head>
<body>
    <?php 
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <div style="text-align:center;">
        送信完了!<br>
        以下のエージェントに申込しました!<br>
        申込内容の詳細は登録したメールアドレスに<br>
        記載されているので、、ご確認ください<br>
        メールが届かないなど、ご不明な点等<br>
        ございましたら以下のメールアドレスに<br>
        ご連絡ください
    </div>
    <div>
        <?php 

        $applied_agents_array=[1,9,3,4,5];

        foreach($applied_agents_array as $applied_agent){
            echo '<div style="text-align:center;">';
            echo $applied_agent;
            echo '</div>';
        }
        ?>
    </div>
    <?php require "../parts/footer.php";?>
</body>
</html>