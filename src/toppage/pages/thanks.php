<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/others.css">
    <title>サンクスページ</title>
</head>
<body>
    <?php 
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <section class="thanks-unit">
    <div class="thanks-texts">
        <p class="thanks-message">
        お申込みありがとうございます。送信完了いたしました!
        </p>
        お申し込みは以下のエージェントです!<br>
        <div class="thanks-agent-lists">
            <?php 
    
            $applied_agents_array=['エージェント1','エージェント9','エージェント3','エージェント4','エージェント5'];
    
            foreach($applied_agents_array as $applied_agent){
                echo '<div style="text-align:center;">';
                echo $applied_agent;
                echo '</div>';
            }
            ?>
        </div>
        申込内容の詳細は登録したメールアドレスに送信されているので、メールボックスからご確認ください<br>
        メールが届かないなど、ご不明な点等ございましたら以下のメールアドレスにご連絡ください<br>
        boozer-dummy@mail.com
    </div>
    <a  class="thanks-top-back-btn"  href="./index.php">
        <div>
        トップページに戻る
    </div>
</a>
    <?php require "../parts/footer.php";?>
</body>
</html>