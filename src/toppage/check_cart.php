<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>買い物カート</title>
</head>
<body>
    <?php 
    require "header.php";
    require "indicator.php";
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
    <form action="" method="POST" >
        <!--削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく-->
        <div>次の企業への申込をやめますか？</div>
        <div style="display:flex;">
            <div>
                <img alt="企業の画像">
            </div>
            <div>
                <div>1</div>
                <div>2</div>
                <div>3</div>
            </div>
        </div>
        <div style="display:flex;">
            <input type="submit" value="はい">
            <input type="submit" value="いいえ">
        </div>
    </form>
    <?php require "footer.php";?>
</body>
</html>