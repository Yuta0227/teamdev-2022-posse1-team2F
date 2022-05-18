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
    <title>買い物カート</title>
</head>
<body>
    <?php 
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <section class="check-cart-unit">
    <div class="check-cart-header">申込企業</div>
    <div class="check-cart-agent-all">
        <?php
        $selected_agents_array=[1,2,3,4,5];//連想か多次元。これ専用のテーブルつくるけどどの情報をひっぱるかはまだ考えていない
        foreach($selected_agents_array as $selected_agent){
            echo '<div class="check-cart-each-agent-box">';
            echo '<div class="check-cart-agent-name">企業名</div>';
            echo '<div class="check-cart-each-agent-info-box">';
            echo '<div class="check-cart-agent-img-box">';
            echo '<img alt="企業の画像" src="../../img/dummy.png">';
            echo '</div>';
            echo '<div>';
            echo '<div>簡単な説明を記入</div>';
            echo '<div>タグ</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="check-cart-agent-delete-btn-box">';
            echo '<button class="check-cart-agent-delete-btn" id="">削除</button>';
            echo '</div>';
            echo '</div>';
        };?>
    </div>
    <div class="check-cart-next-btn-box">
        <button class="check-cart-next-btn">
            <a href="">
                情報を記入して上記のエージェントに申込する<br>->次のステップへ
            </a>
        </button>
    </div>
    <!-- <form action="" method="POST" hidden> -->
    <form class="check-cart-delete-check-unit" action="" method="POST">
        <!--削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく-->
        <div class="check-cart-delete-check-text">次の企業への申込をやめますか？</div>
        <div class="check-cart-delete-check-infos">
            <div class="check-cart-delete-check-img-box">
                <img alt="企業の画像" src="../../img/dummy.png">
            </div>
            <div class="check-cart-delete-check-agent-name-box">
                <div class="check-cart-delete-check-agent-name">企業名</div>
            </div>
        </div>
        <div style="display:flex;">
            <input type="submit" value="はい">
            <input type="submit" value="いいえ">
        </div>
    </form>
    </section>
    <?php require "../parts/footer.php";?>
</body>
</html>