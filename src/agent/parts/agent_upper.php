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
    } else {
        echo $_GET['month'];
    }
    ?>
    月の申込一覧
</div>
<table>
    <?php
    $number_of_applies = []; //月の申込件数
    $calender_dates = []; //カレンダーで表示する日
    $year_month_parameter_set = isset($_GET['year']) && isset($_GET['month']);
    if ($year_month_parameter_set) {
        if ($_GET['month'] != 1) {
            //パラメータのmonthが1じゃないなら普通に月減らす
            $decrease_month = $_GET['month'] - 1;
            $decrease_year = $_GET['year'];
        } else {
            $decrease_month = 12;
            $decrease_year = $_GET['year'] - 1;
        };
    }
    if ($year_month_parameter_set) {
        if ($_GET['month'] != 12) {
            //パラメータのmonthが12じゃないなら普通に月増やす
            $increase_month = $_GET['month'] + 1;
            $increase_year = $_GET['year'];
        } else {
            $increase_month = 1;
            $increase_year = $_GET['year'] + 1;
        };
    }
    if ($year_month_parameter_set) {
        //パラメータセット時
        $year_month = $_GET['year'] . '-' . $_GET['month']; //パラメータの年月
        $year_last_month = $_GET['year'] . '-' . ($_GET['month'] - 1); //パラメータの年月の先月
        $date = date($year_month . '-' . date('t', strtotime($year_month))); //yearパラメータ-monthパラメータ-パラメータ年月の最終日
        $weeks_per_month = ceil((date('d', strtotime($date)) - date('w', strtotime($date)) - 1) / 7) + 1; //月における週の数をとる
        for ($day = date('w', strtotime($year_month . '-01')) - 1; $day >= 0; $day--) {
            $number_of_applies += array(($decrease_month . '/' . date('t', strtotime($year_last_month)) - $day) => 3);
            //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
            array_push($calender_dates, ($decrease_month . '/' . date('t', strtotime($year_last_month)) - $day));
            //カレンダーで表示する日付を日付配列に追加
        }
        for ($day = 1; $day <= date('t', strtotime($year_month)); $day++) {
            $number_of_applies += array($_GET['month'] . '/' . $day => 4);
            //4には申込件数代入
            array_push($calender_dates, (($_GET['month'] . '/' . $day)));
            //カレンダーで表示する日付を日付配列に追加
        }
        for ($day = 1; $day <= 6 - date('w', strtotime($year_month . '-' . date('t', strtotime($year_month)))); $day++) { //来月の何日分出力するか今月の最終日の曜日をもとにきめる
            array_push($calender_dates, ($increase_month . '/' . $day));
            //来月の日付を日付配列に追加
            $number_of_applies += array(($increase_month . '/' . $day) => 6);
        }
    } else {
        //パラメータ未セット時
        $year_month = date('Y') . '-' . date('n');
        $year_last_month = date('Y') . (date('n') - 1);
        $last_month = date('n') - 1;
        $date = date('Y-m-' . date('t')); //2022/04/30
        $weeks_per_month = ceil((date('d', strtotime($date)) - date('w', strtotime($date)) - 1) / 7) + 1; //月における週の数をとる
        //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
        for ($i = date('w', strtotime($year_month . '-01')) - 1; $i >= 0; $i--) { //今月の一日の曜日をもとに先月の何日分出力するか
            $number_of_applies += array(($last_month . '/' . date('t', strtotime($year_last_month)) - $i) => 3);
            //先月の最後の件数を件数配列に追加
            array_push($calender_dates, (($last_month . '/' . date('t', strtotime($year_last_month) - $i))));
            //カレンダーで表示する日付を日付配列に追加
        }
        for ($day = 1; $day <= date('t'); $day++) {
            $number_of_applies += array(date('n') . '/' . $day => 4);
            //4には申込件数代入
            array_push($calender_dates, ((date('n') . '/' . $day)));
            //カレンダーで表示する日付を日付配列に追加
        }
    }
    for ($week = 1; $week <= $weeks_per_month; $week++) {
        echo '<tr>';
        for ($i = 1; $i <= 7; $i++) {
            echo '<td id="each_day' . $i - 7 + 7 * $week . '" style="position:relative;width:100px;height:100px;border:solid 1px black;">';
            if ($year_month_parameter_set) {
                //パラメータセット時
                echo '<div id="date' . $i - 7 + 7 * $week . '" style="position:absolute;top:0;left:0;width:40%;height:40%;;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
                echo '<div id="number' . $i - 7 + 7 * $week . '" style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]] . '</div>';
            } else {
                //パラメータ未セット時
                echo '<div style="position:absolute;top:0;left:0;width:40%;height:40%;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
                echo '<div style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]] . '</div>';
            }
            echo '</td>';
        };
        echo '</tr>';
    }
    ?>
</table>
<div style="display:flex;width:100%;justify-content:center;">
    <div>
        <a href="
        <?php
        if ($year_month_parameter_set) {
            if ($_GET['month'] != 1) {
                //パラメータのmonthが1じゃないなら普通に月減らす
                $decrease_month = $_GET['month'] - 1;
                $decrease_year = $_GET['year'];
            } else {
                $decrease_month = 12;
                $decrease_year = $_GET['year'] - 1;
            };
            echo $agent_toppage_url . '?year=' . $decrease_year . '&month=' . $decrease_month;
        }
        ?>
        ">
            &lt;
        </a>
    </div>
    <div>
        <?php
        if ($year_month_parameter_set) {
            echo $_GET['year'] . '/' . $_GET['month'];
        } else {
            echo date('Y') . '/' . date('n');
        }
        ?>
    </div>
    <div>
        <?php if ($year_month_parameter_set) {
            if ($_GET['year'] . '/' . $_GET['month'] != date('Y') . '/' . date('n')) {
                //パラメータがあるかつそれがページを開いたときの年月と一致してないとき==最新月ではないときのみ矢印表示する
        ?>
                <a href="
        <?php
                if ($year_month_parameter_set) {
                    if ($_GET['month'] != 12) {
                        //パラメータのmonthが12じゃないなら普通に月増やす
                        $increase_month = $_GET['month'] + 1;
                        $increase_year = $_GET['year'];
                    } else {
                        $increase_month = 1;
                        $increase_year = $_GET['year'] + 1;
                    };
                    echo $agent_toppage_url . '?year=' . $increase_year . '&month=' . $increase_month;
                }

        ?>">
                    &gt;
                </a>
        <?php }
        } ?>
    </div>
</div>
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