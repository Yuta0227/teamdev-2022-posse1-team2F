<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    require "../parts/url.php";
    require "../parts/agent_header.php";
    require "../parts/agent_new_apply.php";
    echo '<div>'.$_GET['year'].'年'.$_GET['month'].'月'.$_GET['date'].'日の申込一覧</div>';
    echo '<table>';
    echo '    <tr>';
    echo '        <th>申込日時</th>';
    echo '        <th>メールアドレス</th>';
    echo '    </tr>';
    echo '</table>';
    $applies_array=[
        ['10:50','sample@gmail.com'],
        ['10:10','sample@gmail.com']
        //パラメータの日程の申込一覧をデータベースから取得
    ];
    $index = 0;
    foreach ($applies_array as $apply) {
        echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
        echo '<div>'.$apply[0].'</div>';
        echo '<div>'.$apply[1].'</div>';
        echo '<input type="button" id="open_apply' . $index . '" value="▽">';
        echo '<input id="close_apply' . $index . '" name="close' . $index . '" hidden value="△" type="submit">';
        echo '</form>';
        echo '<div id="apply_detail' . $index . '" hidden style="border:1px solid black;">';
        echo '<div>漢字(フリガナ)</div>';
        echo '<div>電話番号</div>';
        echo '<div>大学名 学部名 学科名 何年卒</div>';
        echo '<div>郵便番号</div>';
        echo '<div>住所</div>';
        echo '<div>相談：</div>';
        echo '</div>';
        $index++;
        //formにする
        //divでごり押しするか。できるかわからん。divをクリック時jsからphpに変数なげてそれで判定も可能。一番現実的かもしれない
        //やること。▽おしたら詳細みせる△おしたら閉じて新着テーブルから消して一覧テーブルに追加する
    };
    echo '<div>'.$_GET['month'].'月'.$_GET['date'].'日の合計：'.count($applies_array).'人</div>';
    require "../../toppage/footer.php";
    ?>
</body>
</html>
<script>
    <?php for($index=0;$index<=count($applies_array);$index++) { ?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php }; ?>
</script>