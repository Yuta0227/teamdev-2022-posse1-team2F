<div><?php echo $_GET['year'].'年'.$_GET['month'].'月'.$_GET['date'].'日の申込一覧';?></div>
<table>
    <tr>
        <th>申込日時</th>
        <th>メールアドレス</th>
    </tr>
</table>
<?php
$applies_array = [
    ['10:50', 'sample@gmail.com'],
    ['10:10', 'sample@gmail.com']
    //パラメータの日程の申込一覧をデータベースから取得
];
for($index=0;$index<count($applies_array);$index++) {
    ${"report_status".$index}=0;
    echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
    echo '<div>' . $applies_array[$index][0] . '</div>';
    echo '<div>' . $applies_array[$index][1] . '</div>';
    echo '<input type="button" id="open_apply' . $index . '" value="詳細▽">';
    echo '<input id="close_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
    echo '</form>';
    echo '<div id="apply_detail' . $index . '" hidden style="border:1px solid black;">';
    echo '<div>漢字(フリガナ)</div>';
    echo '<div>電話番号</div>';
    echo '<div>大学名 学部名 学科名 何年卒</div>';
    echo '<div>郵便番号</div>';
    echo '<div>住所</div>';
    echo '<div>相談：</div>';
    echo '</div>';
    echo '<form name="report_form'.$index.'" onsubmit="submit_reason();" action="" method="POST">';
    echo '<div style="justify-content:center;display:flex;border:1px solid black;">';
    if(${"report_status".$index}==0){
        //通報していない場合
        echo '<div id="report'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:red;">通報する('.($new_apply['月']+1).'月1日23:59まで)</div>';
    }else{
        //通報した場合
        echo '<div id="reported'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:blue;">通報済み</div>';
    }
    echo '</div>';
    echo '<div id="report_reason'.$index.'" style="border:1px solid black;" hidden><div style="display:flex;justify-content:center;align-items:center;"><span>通報理由：</span><textarea type="text" name="new_report_reason" required placeholder="理由を記入してください"></textarea></div>';
    echo '<div style="display:flex;justify-content:center;"><div id="cancel_report'.$index.'">キャンセル</div><input type="submit" name="report'.$index.'"></div></div>';
    echo '</form>';
};
echo '<div>' . $_GET['month'] . '月' . $_GET['date'] . '日の合計：' . count($applies_array) . '人</div>';
?>
<script>
<?php for($index=0;$index<count($applies_array);$index++) {?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            <?php if( ${'report_status'.$index}==0){?>
                document.getElementById('report<?php echo $index;?>').removeAttribute('hidden');
            <?php }else{?>
                document.getElementById('reported<?php echo $index;?>').removeAttribute('hidden');
            <?php }?>
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('reported<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('report<?php echo $index;?>').setAttribute('hidden','');
            <?php if( ${'report_status'.$index}==0){?>
                document.report_form<?php echo $index;?>.submit();
            <?php }?>

        });
        document.getElementById('cancel_report<?php echo $index;?>').addEventListener('click',function(){
            document.getElementById('report_reason<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('report<?php echo $index;?>').removeAttribute('hidden','');
        })
        document.getElementById('report<?php echo $index;?>').addEventListener('click',function(){
            document.getElementById('report<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('report_reason<?php echo $index;?>').removeAttribute('hidden');
        });
        function submit_reason(){
            document.getElementById('report_reason<?php echo $index;?>').setAttribute('hidden','');
            document.getElementById('reported<?php echo $index;?>').removeAttribute('hidden');            
        };
    <?php }; ?>
</script>