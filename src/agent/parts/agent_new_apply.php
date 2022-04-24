<div><?php echo 'エージェント名'; ?>さんようこそ</div>
<?php 
$new_applies_array = [//データベースから取得
    [
        '年'=>'2022',
        '月'=>'10',
        '日'=>'20',
        '時間'=>'10:50',
        'メールアドレス'=>'sample@gmail.com',
        '漢字'=>'漢字サンプル',
        'フリガナ'=>'フリガナサンプル',
        '電話番号'=>'000-0000-0000',
        '大学名'=>'大学名サンプル',
        '学部名'=>'学部名サンプル',
        '学科名'=>'学科名サンプル',
        '何年卒'=>'24',
        '郵便番号'=>'000-0000',
        '住所'=>'住所サンプル',
        '相談'=>'相談サンプル',
        ]
];
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
        echo '<div>'.$new_apply['月'].'/'.$new_apply['日'].' '.$new_apply['時間'].'</div>';
        echo '<div>'.$new_apply['メールアドレス'].'</div>';
        echo '<input type="button" id="open_new_apply' . $index . '" value="詳細▽">';
        echo '<input id="close_new_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
        echo '</form>';
        echo '<div id="new_apply_detail' . $index . '" hidden style="border:1px solid black;">';
        echo '<div>'.$new_apply['漢字'].'('.$new_apply['フリガナ'].')</div>';
        echo '<div>'.$new_apply['電話番号'].'</div>';
        echo '<div>'.$new_apply['大学名'].' '.$new_apply['学部名'].' '.$new_apply['学科名'].' '.$new_apply['何年卒'].'年卒</div>';
        echo '<div>'.$new_apply['郵便番号'].'</div>';
        echo '<div>'.$new_apply['住所'].'</div>';
        echo '<div>相談：'.$new_apply['相談'].'</div>';
        echo '</div>';
        echo '<form name="report_form'.$index.'" onsubmit="submit_reason();" action="" method="POST">';
        echo '<div style="justify-content:center;display:flex;border:1px solid black;">';
        echo '<div id="new_report'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:red;">通報する('.($new_apply['月']+1).'月1日23:59まで)';
        echo'</div>';
        echo '<div id="new_reported'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:blue;">通報済み</div>';
        echo '</div>';
        echo '<div id="new_report_reason'.$index.'" style="border:1px solid black;" hidden><div style="display:flex;justify-content:center;align-items:center;"><span>通報理由：</span><textarea type="text" name="new_report_reason" required placeholder="理由を記入してください"></textarea></div>';
        echo '<div style="display:flex;justify-content:center;"><input type="submit" name="report'.$index.'"></div></div>';
        echo '</form>';
        //formにする
        //divでごり押しするか。できるかわからん。divをクリック時jsからphpに変数なげてそれで判定も可能。一番現実的かもしれない
        //やること。▽おしたら詳細みせる△おしたら閉じて新着テーブルから消して一覧テーブルに追加する
        ${'report_status'.$index}=0;
        // if($_SERVER['REQUEST_METHOD']=='POST'){
        //     if($_POST['report_form'.$index]!=NULL){
        //         ${'report_status'.$index}=1;
        //         // echo ${'report_status'.$index};
        //         // var_dump($_POST['report'.$index]);
        //         //通報テーブルにこのデータ送ってvalid=1のものの表示を切り替えたい
        //     }
        // }
        $index++;
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
    <?php for($index=0;$index<count($new_applies_array);$index++) { 
        
        ?>
        document.getElementById('open_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('new_apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            <?php if( ${'report_status'.$index}==0){?>
                document.getElementById('new_report<?php echo $index;?>').removeAttribute('hidden');
            <?php }else{?>
                document.getElementById('new_reported<?php echo $index;?>').removeAttribute('hidden');
            <?php }?>
        });
        document.getElementById('close_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('new_apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('new_reported<?php echo $index;?>').setAttribute('hidden','');
            <?php if( ${'report_status'.$index}==0){?>
                document.report_form<?php echo $index;?>.submit();
            <?php }?>

        });
        document.getElementById('new_report<?php echo $index;?>').addEventListener('click',function(){
            document.getElementById('new_report<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('new_report_reason<?php echo $index;?>').removeAttribute('hidden');
        })
        function submit_reason(){
            document.getElementById('new_report_reason<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('new_reported<?php echo $index;?>').removeAttribute('hidden');            
        }
    <?php }; ?>
</script>