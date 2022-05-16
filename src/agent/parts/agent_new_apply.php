<section class="agent-new-apply-unit">
<div class="agent-welcome"><?php echo 'エージェント名'; ?>さんようこそ</div>
<?php
$new_applies_array = [ //データベースから取得
    [
        '年' => '2022',
        '月' => '12',
        '日' => '20',
        '時間' => '10:50',
        'メールアドレス' => 'sample@gmail.com',
        '漢字' => '山田太郎',
        'フリガナ' => 'ヤマダタロウ',
        '電話番号' => '090-0000-0000',
        '大学名' => '慶応義塾大学',
        '学部名' => '経済学部',
        '学科名' => '学科名サンプル',
        '何年卒' => '24',
        '郵便番号' => '160-0000',
        '住所' => '東京都港区南青山1-3',
        '相談' => '相談サンプル',
        '履歴'=>'',
        '通報ステータス'=>1
    ]
];
if (count($new_applies_array) != 0) { //新着があったら
    echo '<div class="agent-new-apply-header">新着の申込一覧</div>';
    echo '<table class="agent-new-apply-explanations">';
    echo '    <tr>';
    echo '        <th class="agent-new-apply-explanation">申込日時</th>';
    echo '        <th class="agent-new-apply-explanation">メールアドレス</th>';
    echo '    </tr>';
    echo '</table>';
    for ($index=0;$index<count($new_applies_array);$index++) {        
        echo '<form method="POST" onsubmit="return false;" id="test' . $index . '" class="agent-new-apply-info-box">';
        echo '<div>' . $new_applies_array[$index]['月'] . '/' . $new_applies_array[$index]['日'] . ' ' . $new_applies_array[$index]['時間'] . '</div>';
        echo '<div>' . $new_applies_array[$index]['メールアドレス'] . '</div>';
        echo '<input type="button" id="open_new_apply' . $index . '" value="詳細▽">';
        echo '<input id="close_new_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
        echo '</form>';
        echo '<div id="new_apply_detail' . $index . '" hidden class="agent-apply-detail-box">';
        echo '<div>' . $new_applies_array[$index]['漢字'] . '(' . $new_applies_array[$index]['フリガナ'] . ')</div>';
        echo '<div>' . $new_applies_array[$index]['電話番号'] . '</div>';
        echo '<div>' . $new_applies_array[$index]['大学名'] . ' ' . $new_applies_array[$index]['学部名'] . ' ' . $new_applies_array[$index]['学科名'] . ' ' . $new_applies_array[$index]['何年卒'] . '年卒</div>';
        echo '<div>' . $new_applies_array[$index]['郵便番号'] . '</div>';
        echo '<div>' . $new_applies_array[$index]['住所'] . '</div>';
        echo '<div>' . $new_applies_array[$index]['履歴'] . '</div>';
        echo '<div>相談：' . $new_applies_array[$index]['相談'] . '</div>';
        
        echo '<form name="report_form' . $index . '" onsubmit="submit_reason();" action="" method="POST">';
        echo '<div class="report-box">';
        if ($new_applies_array[$index]['通報ステータス'] == 0) {
            //通報されていない場合
            if($new_applies_array[$index]['月']!=12){
                //申込の月が12月ではない場合
                echo '<div id="new_report' . $index . '" hidden class="agent-report-not-yet">通報する('.$new_applies_array[$index]['年'].'年' . ($new_applies_array[$index]['月'] + 1) . '月1日23:59まで)</div>';
            }else{
                //申込の月が12の場合=>翌年の一月まで
                echo '<div id="new_report' . $index . '" hidden class="agent-report-not-yet">通報する('.($new_applies_array[$index]['年']+1).'年1月1日23:59まで)</div>';
            }
        } else {
            //通報されている場合
            echo '<div id="new_reported' . $index . '" class="agent-report-done" hidden>通報済み</div>';
        }
        echo '</div>';
        echo '<div id="new_report_reason' . $index . '" style="border:1px solid black;" hidden><div style="display:flex;justify-content:center;align-items:center;"><span>通報理由：</span><textarea type="text" name="new_report_reason" required placeholder="理由を記入してください"></textarea></div>';
        echo '<div style="display:flex;justify-content:center;"><div id="cancel_new_report' . $index . '">キャンセル</div><input type="submit" name="report' . $index . '" value="通報"></div></div>';
        echo '</form>';
        echo '</div>';
        //formにする
        //divでごり押しするか。できるかわからん。divをクリック時jsからphpに変数なげてそれで判定も可能。一番現実的かもしれない
        //やること。▽おしたら詳細みせる△おしたら閉じて新着テーブルから消して一覧テーブルに追加する
        // if($_SERVER['REQUEST_METHOD']=='POST'){
        //     if($_POST['report_form'.$index]!=NULL){
        //         ${'report_status'.$index}=1;
        //         // echo ${'report_status'.$index};
        //         // var_dump($_POST['report'.$index]);
        //         //通報テーブルにこのデータ送ってvalid=1のものの表示を切り替えたい
        //     }
        // }
    };
};
?>
</section>

<script>
    function submitEvent() {
        // https://brainlog.jp/programming/post-538/
        //ここで変数を別phpファイルと受け渡しをする
        //そのファイルの変数が空っぽではなくなったら＝＝変数受け渡しがされたら新着一覧テーブルから学生の情報を消す
        console.log('テスト');
    }
    <?php for ($index = 0; $index < count($new_applies_array); $index++) { ?>
        document.getElementById('open_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            //新着の詳細ボタン押すと
            document.getElementById('close_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            //新着の閉じるボタン出現
            document.getElementById('open_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            //新着の詳細ボタンが消える
            document.getElementById('new_apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            //学生の情報が出現
            <?php if ($new_applies_array[$index]['通報ステータス'] == 0) { ?>
                //通報済みステータスがゼロの場合==通報していない場合
                document.getElementById('new_report<?php echo $index; ?>').removeAttribute('hidden');
                //通報するボタン出現
            <?php } else { ?>
                //通報済みの場合
                document.getElementById('new_reported<?php echo $index; ?>').removeAttribute('hidden');
                //通報済みボタンが出現
            <?php } ?>
        });
        document.getElementById('close_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            //新着の閉じるボタン押すと
            document.getElementById('close_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            //新着の閉じるボタンが消える
            document.getElementById('open_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            //新着の詳細ボタン出現
            document.getElementById('new_apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            //新着の学生の情報出現
            <?php if ($new_applies_array[$index]['通報ステータス'] == 0) { ?>
                //通報済みステータスがゼロの場合==通報していない場合
                document.getElementById('new_report<?php echo $index; ?>').setAttribute('hidden', '');
                //新着通報するボタンが消える
            <?php } else { ?>
                //通報済みの場合
                document.getElementById('new_reported<?php echo $index; ?>').setAttribute('hidden', '');
                //新着通報済みボタンが消える
            <?php }; ?>
        });
        document.getElementById('new_report<?php echo $index; ?>').addEventListener('click', function() {
            //新着通報するボタン押すと
            document.getElementById('new_report<?php echo $index; ?>').setAttribute('hidden', '');
            //新着通報するボタンが消える
            document.getElementById('new_report_reason<?php echo $index; ?>').removeAttribute('hidden');
            //新着通報理由記入フォーム出現
        });
        document.getElementById('cancel_new_report<?php echo $index; ?>').addEventListener('click', function() {
            //新着通報キャンセル押すと
            document.getElementById('new_report_reason<?php echo $index; ?>').setAttribute('hidden', '');
            //新着通報理由記入フォームが消える
            document.getElementById('new_report<?php echo $index; ?>').removeAttribute('hidden', '');
            //新着通報するボタン出現
        });
    <?php } ?>
</script>