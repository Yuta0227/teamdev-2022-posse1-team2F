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
    <?php require "footer.php";?>
</body>
</html>