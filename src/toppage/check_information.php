<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内容確認画面</title>
</head>
<body>
    <!-- セッションに入力内容保存してそこから引っ張ってくる -->
    <form action="" method="POST" style="padding:10px;display:flex;flex-direction:column;">
        <div style="text-align:center;">内容確認ページ</div>
        <table>
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
                echo '<th>'.$column.'</th>';
                echo '<td>'.$data.'</td>';
                echo '</tr>';
            };
            foreach($inquiry_array as $column=>$data){
                echo '<tr>';
                echo '<th>自由記入欄'.($column+1).'</th>';
                echo '<td>'.$data[0].'に対して「'.$data[1].'」</td>';
                echo '</tr>';
            };
            ?>
        </table>
        <div style="display:flex;">
            <input type="button" value="フォーム記入に戻る">
            <input type="submit" value="この内容で送る">
        </div>
    </form>
</body>
</html>