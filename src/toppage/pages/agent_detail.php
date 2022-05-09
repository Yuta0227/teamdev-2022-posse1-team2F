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
    <title>エージェント詳細</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    ?>
    <section class="agent-detail">
        <div class="agent-detail-box">
            <div class="agent-detail-name">
                <h1>企業名1</h1>
            </div>
            <div class="agent-detail-top-box">
                <img alt="企業の画像" src="../../../img/dummy.png">
                <div class="detail-recomend">
                <div>
                    <h2>こんな人におすすめ</h2>
                </div>
                <div>
                    <?php
                    $recommend_array = ['理系','外資系企業希望','大企業希望']; //データベースから取得する。テーブルのカラムはわかりやすくrecommendとかにする
                    foreach ($recommend_array as $recommend) {
                        echo '<ul>';
                        echo '<li>' . $recommend . 'の人</li>';
                        echo '</ul>';
                    }; ?>
                </div>
            </div>
            </div>
            <div class="agent-detail-table-box">
                    <table class="agent-detail-table-whole">
                        <?php
                        $table_array = ['取り扱い企業数', '内定率', '面接方式', '何系の企業','内定が決まるまでの平均期間', '取り扱い業種', 'エージェント本拠地','求人エリア'];
                        for ($i = 0; $i < count($table_array); $i++) { //ここ今は4だけど他に載せたい情報あったら変更できるように
                            echo '<tr>';
                            echo '<th class="agent-detail-table agent-detail-table-th">' . $table_array[$i] . '</th>';
                            echo '<td class="agent-detail-table agent-detail-table-td">回答' . $i . '</td>';
                            echo '</tr>';
                        }; ?>
                    </table>
                </div>
           
            <div class="detail-feature">
                <div>
                    <h2>エージェントの特徴</h2>
                </div>
                <div>
                    <p>
                        <!--データベースに文章登録して引っ張ってくる-->
                        テキスト
                        ここにエージェントの情報を追加
                    </p>
                </div>
            </div>
            <div class="agent-add-btn">
                <button>このエージェントを選択する</button>
                <!--ボタンおしたら選択済みと表示してクリックできないようにしたい。それはjs。-->
                <!--でもカートの数字を追加したい。そのためにはphpでリロード必要。inputにする必要あり。-->
                <!--リロードするとクリック無効がなくなる。非同期処理必要なのか?それの勉強できてない。-->
                <!--非同期処理じゃなくてデータベースに選択済みかどうか判定するテーブル作ってその内容によってボタンの表示内容やクリック可能かを変更することできると思う。-->
                <!--問題はこれがカートの数字に正常に反映されるかどうかがわからない。-->
            </div>
        </div>
    </section>
</body>
<?php require "../parts/footer.php"; ?>

</html>