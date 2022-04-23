<div><?php echo 'エージェント名'; ?>さんようこそ</div>
<?php 
$new_applies_array = [1, 2, 3, 4, 5];
if (count($new_applies_array) != 0) { //新着があったら
    echo '<div>新着の申込一覧</div>';
    echo '<table>';
    echo '    <tr>';
    echo '        <th>申込日時</th>';
    echo '        <th>メールアドレス</th>';
    echo '    </tr>';
    echo '</table>';
    $index = 0;
    foreach ($new_applies_array as $new_apply) {
        echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
        echo '<div>10/20 10:50</div>';
        echo '<div>sample@gmail.com</div>';
        echo '<input type="button" id="open_new_apply' . $index . '" value="▽">';
        echo '<input id="close_new_apply' . $index . '" name="close' . $index . '" hidden value="△" type="submit">';
        echo '</form>';
        echo '<div id="new_apply_detail' . $index . '" hidden style="border:1px solid black;">';
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
};
?>


<script>
    function submitEvent() {
        // https://brainlog.jp/programming/post-538/
        //ここで変数を別phpファイルと受け渡しをする
        //そのファイルの変数が空っぽではなくなったら＝＝変数受け渡しがされたら新着一覧テーブルから学生の情報を消す
        console.log('テスト');
    }
    <?php for($index=0;$index<=count($new_applies_array);$index++) { ?>
        document.getElementById('open_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('new_apply_detail<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('new_apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php }; ?>
</script>