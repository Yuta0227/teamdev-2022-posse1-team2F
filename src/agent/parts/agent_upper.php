<div><?php echo 'エージェント名'; ?>さんようこそ</div>
<?php
$new_applies_array=[1,2,3,4,5];
if (count($new_applies_array)!=0) {//新着があったら
    echo '<div>新着の申込一覧</div>';
    echo '<table>';
    echo '    <tr>';
    echo '        <th>申込日時</th>';
    echo '        <th>メールアドレス</th>';
    echo '    </tr>';
    echo '</table>';
    $index=0;
    foreach($new_applies_array as $new_apply){
        echo '<div style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
        echo '<div>10/20 10:50</div>';
        echo '<div>sample@gmail.com</div>';
        echo '<div id="new'.$index.'">▽</div>';
        echo '</div>';
        echo '<div id="apply_detail'.$index.'" hidden style="border:1px solid black;">';
        echo '<div>漢字(フリガナ)</div>';
        echo '<div>電話番号</div>';
        echo '<div>大学名 学部名 学科名 何年卒</div>';
        echo '<div>郵便番号</div>';
        echo '<div>住所</div>';
        echo '<div>相談：</div>';
        echo '</div>';
        $index++;
    }
} ?>