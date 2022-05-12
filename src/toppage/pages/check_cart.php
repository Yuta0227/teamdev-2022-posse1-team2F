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
    <title>買い物カート</title>
</head>
<body>
    <?php 
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <div>申込企業</div>
    <div>
        <?php
        $selected_agents_array=[1,2,3,4,5];//連想か多次元。これ専用のテーブルつくるけどどの情報をひっぱるかはまだ考えていない
        foreach($selected_agents_array as $selected_agent){
            echo '<div style="display:flex;">';
            echo '<div>';
            echo '<img alt="企業の画像">';
            echo '</div>';
            echo '<div>';
            echo '<div>企業名</div>';
            echo '<div>簡単な説明</div>';
            echo '<div>タグ</div>';
            echo '</div>';
            echo '<div>';
            echo '<button id="">削除</button>';
            echo '</div>';
            echo '</div>';
        };?>
    </div>
    <div>
        <button>
            <a href="">
                情報を記入して上記のエージェントに申込する<br>->次のステップへ
            </a>
        </button>
    </div>
    <form action="" method="POST" hidden>
        <!--削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく-->
        <div>次の企業への申込をやめますか？</div>
        <div style="display:flex;">
            <div>
                <img alt="企業の画像">
            </div>
            <div>
                <div>企業名</div>
            </div>
        </div>
        <div style="display:flex;">
            <input type="submit" value="はい">
            <input type="submit" value="いいえ">
        </div>
    </form>
    <?php require "../parts/footer.php";?>
</body>
</html>