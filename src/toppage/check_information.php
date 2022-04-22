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
    <form style="padding:10px;display:flex;flex-direction:column;">
        <div style="text-align:center;">内容確認ページ</div>
        <table>
            <?php 
            $array=[
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
            for($i=1;$i<4;$i++){
                $array+=array('自由記入欄'.$i=>$i);//どこに対して何を送ったかは記入内容から引っ張る
            }
            foreach($array as $column=>$data){
                echo '<tr>';
                echo '<th>'.$column.'</th>';
                echo '<td>'.$data.'に対して「'.$data.'」</td>';
                echo '</tr>';
            }?>
        </table>
        <div style="display:flex;">
            <input type="button" value="フォーム記入に戻る">
            <input type="submit" value="この内容で送る">
        </div>
    </form>
</body>
</html>