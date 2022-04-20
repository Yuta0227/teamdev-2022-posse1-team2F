<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント詳細</title>
</head>
<body>
    <?php 
    require "header.php";
    ?>
    <section>
        <div>
            <h1>企業名</h1>
        </div>
        <div style="display:flex;">
            <div>
                <img alt="企業の画像">
            </div>
            <div>
                <table>
                    <?php 
                    $table_array=['取り扱い企業数','特色','就活方式','何系の企業'];
                    for($i=0;$i<count($table_array);$i++){//ここ今は4だけど他に載せたい情報あったら変更できるように
                        echo '<tr>';
                        echo '<th class="">'.$table_array[$i].'</th>';
                        echo '<td class="">'.$i.'</td>';
                        echo '</tr>';
                    };?>
                </table>
            </div>
        </div>
        <div>
            <div>
                <h2>こんな人におすすめ</h2>
            </div>
            <div>
                <?php 
                $recommend_array=['理系'];//データベースから取得する。テーブルのカラムはわかりやすくrecommendとかにする
                foreach($recommend_array as $recommend){
                    echo '<ul>';
                    echo '<li>'.$recommend.'な人</li>';
                    echo '</ul>';
                };?>
            </div>
        </div>
        <div>
            <div>
                <h2>エージェントの特徴</h2>
            </div>
            <div>
                <p>
                    <!--データベースに文章登録して引っ張ってくる-->
                    テキスト
                </p>
            </div>
        </div>
    </section>
</body>
<?php require "footer.php";?>
</html>