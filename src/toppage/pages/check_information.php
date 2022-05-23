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
    <title>入力内容確認画面</title>
</head>
<body>
<?php
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <!-- セッションに入力内容保存してそこから引っ張ってくる -->
    <form action="" method="POST" class="check-information-unit">
        <div class="check-information-head">入力情報確認</div>
        <div class="check-info-alert">＊送信は完了しておりません</div>
        <table class="check-info-table">
            <?php 
            $information_array=[
                'お名前'=>'テキスト',
                'フリガナ'=>'テキスト',
                'メールアドレス'=>'テキスト',
                '電話番号'=>'テキスト',
                '大学名'=>'テキスト',
                '学部名'=>'テキスト',
                '学科名'=>'テキスト',
                '何年卒'=>'テキスト',
                '郵便番号'=>'テキスト',
                '都道府県'=>'テキスト',
                '市区町村'=>'テキスト',
                '町域名'=>'テキスト',
                '番地など'=>'テキスト',
            ];
            $inquiry_array=[];
            for($i=1;$i<4;$i++){
                array_push($inquiry_array,['企業名'.$i,'テキスト'.$i]);
                //どこに対して何を送ったかは記入内容から数字で引っ張る
            }
            foreach($information_array as $column=>$data){
                echo '<tr>';
                echo '<th class="check-info-table-text">'.$column.'</th>';
                echo '<td class="check-info-table-content">'.$data.'</td>';
                echo '</tr>';
            };
            foreach($inquiry_array as $column=>$data){
                echo '<tr>';
                echo '<th class="check-info-table-text">自由記入欄'.($column+1).'</th>';
                echo '<td class="check-info-table-content">'.$data[0].'に対して「'.$data[1].'」</td>';
                echo '</tr>';
            };
            ?>
        </table>
        <div style="display:flex;" class="check-info-check-btns">
            <input class="check-info-back-btn" type="button" value="フォーム記入に戻る" onclick="location.href='./information_form.php'">
            <input class="check-info-ok-btn" type="submit" formaction="./thanks.php" value="この内容で送る">
        </div>
    </form>
    <?php require "../parts/footer.php"; ?>
</body>
</html>