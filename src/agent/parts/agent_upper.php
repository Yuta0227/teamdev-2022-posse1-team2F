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
        echo '<input type="button" id="open' . $index . '" value="▽">';
        echo '<input id="close' . $index . '" name="close' . $index . '" hidden value="△" type="submit">';
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
    }
} ?>
<div>
    <?php 
    if (!isset($_GET['month'])) {
        echo date('n');
    }else{
        echo $_GET['month'];
    }
    ?>
    月の申込一覧
</div>
<table>
    <?php
    $weeks_per_month=5; //月における週の数をとる
    $number_of_applies=[];//月の申込件数
    $calender_dates=[];//カレンダーで表示する日
    if(isset($_GET['year'])&&isset($_GET['month'])){
        //パラメータセット時
        echo date('w',strtotime($_GET['year'].'-'.$_GET['month'].'-01')).'曜日';
        for($i=date('w',strtotime($_GET['year'].'-'.$_GET['month'].'-01'))-1;$i>=0;$i--){
            $number_of_applies+=array((($_GET['month']-1).'/'.date('t',strtotime($_GET['year'].'-'.($_GET['month']-1)))-$i)=>3);
            //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
            array_push($calender_dates,(($_GET['month']-1).'/'.date('t',strtotime($_GET['year'].'-'.($_GET['month']-1)))-$i));
            //カレンダーで表示する日付を日付配列に追加
        }
        for($day=1;$day<=date('t',strtotime(''.$_GET['year'].'-'.$_GET['month']));$day++){
            $number_of_applies+=array($_GET['month'].'/'.$day=>4);
            //4には申込件数代入
            array_push($calender_dates,(($_GET['month'].'/'.$day)));
            echo (($_GET['month'].'/'.$day)).PHP_EOL;
            //カレンダーで表示する日付を日付配列に追加
        }
        echo '<pre>';
        var_dump($calender_dates);
        var_dump($number_of_applies);
        echo '</pre>';
    }else{
        //パラメータ未セット時
        echo date('w',strtotime(date('Y').'-'.date('m').'-01')).'曜日';
        //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
        for($i=date('w',strtotime(date('Y').'-'.date('m').'-01'))-1;$i>=0;$i--){
            echo $i;
            $number_of_applies+=array(((date('n')-1).'/'.date('t',strtotime(date('Y').'-'.(date('m')-1)))-$i)=>3);
            //先月の最後の件数を件数配列に追加
            array_push($calender_dates,(((date('n')-1).'/'.date('t',strtotime(date('Y').'-'.(date('m')-1))-$i))));
            //カレンダーで表示する日付を日付配列に追加
        }
        for($day=1;$day<=date('t');$day++){
            $number_of_applies+=array(date('n').'/'.$day=>4);
            //4には申込件数代入
            array_push($calender_dates,((date('n').'/'.$day)));
            //カレンダーで表示する日付を日付配列に追加
        }
        echo '<pre>';
        var_dump($calender_dates);
        var_dump($number_of_applies);
        echo '</pre>';
    }
    for($week=1;$week<=$weeks_per_month;$week++){
        echo '<tr>';
            for($i=1;$i<=7;$i++){
                    echo '<td id="'.$i-7+7*$week.'" style="position:relative;width:100px;height:100px;border:solid 1px black;">';
                    if(isset($_GET['year'])&&isset($_GET['month'])){
                        //パラメータセット時
                        if($i-7+7*$week<=date('t',strtotime($_GET['year'].'-'.$_GET['month']))){
                            //日数が月の日数を超えない場合
                            echo '<div id="date'.$i-7+7*$week.'" style="position:absolute;top:0;left:0;width:40%;height:40%;;text-align:center;">'.$number_of_applies[$i-7+7*$week-1].'</div>';
                            echo '<div id="number'.$i-7+7*$week.'" style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">'.$number_of_applies[$i-7+$week*7-1].'</div>';
                            echo $i-7+7*$week-1;
                        }
                    }else{
                        //パラメータ未セット時
                        if($i-7+7*$week<=date('t')){
                            //日数が月の日数を超えない場合
                            echo '<div style="position:absolute;top:0;left:0;width:40%;height:40%;text-align:center;">'.$number_of_applies[$i-7+$week*7-1].'</div>';
                            echo '<div style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">'.$number_of_applies[$i-7+$week*7-1].'</div>';
                            echo $i-7+7*$week-1;
                        }

                    }
                    echo '</td>';
            };
        echo '</tr>';
    }
    ?>
</table>
<script>
    function submitEvent() {
        // https://brainlog.jp/programming/post-538/
        //ここで変数を別phpファイルと受け渡しをする
        //そのファイルの変数が空っぽではなくなったら＝＝変数受け渡しがされたら新着一覧テーブルから学生の情報を消す
        console.log('テスト');
    }
    <?php
    $index = 0;
    foreach ($new_applies_array as $new_apply) { ?>
        document.getElementById('open<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php $index++;
    } ?>
</script>