<div>
    <?php
    if (!isset($_GET['month'])) {
        echo date('n');
    } else {
        echo $adjust->single($_GET['month']);
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
        if ($adjust->single($_GET['month']) != 1) {
            //パラメータのmonthが1じゃないなら普通に月減らす
            $decrease_month = $adjust->single($_GET['month']) - 1;
            $decrease_year = $_GET['year'];
        } else {
            $decrease_month = 12;
            $decrease_year = $_GET['year'] - 1;
        };
    }
    if ($year_month_parameter_set) {
        if ($_GET['month'] != 12) {
            //パラメータのmonthが12じゃないなら普通に月増やす
            $increase_month = $adjust->single($_GET['month']) + 1;
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
                echo '<div id="number' . $i - 7 + 7 * $week . '" style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]] . '件</div>';
            } else {
                //パラメータ未セット時
                echo '<div id="date'.$i-7+7*$week.'" style="position:absolute;top:0;left:0;width:40%;height:40%;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
                echo '<div id="number'.$i-7+7*$week.'" style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]] . '件</div>';
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
        }else{
            if (date('n') != 1) {
                //パラメータのmonthが1じゃないなら普通に月減らす
                $decrease_month = date('n') - 1;
                $decrease_year = date('Y');
            } else {
                $decrease_month = 12;
                $decrease_year = date('Y') - 1;
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
            echo '<span id="calender_year">'.$_GET['year'].'</span>' . '/' . $_GET['month'];
        } else {
            echo '<span id="calender_year">'.date('Y').'</span>' . '/' . date('n');
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
<div>
    <?php
    if ($year_month_parameter_set) {
        echo $_GET['year'] . '/' . $_GET['month'];
    } else {
        echo date('Y') . '/' . date('n');
    } ?>
    月の合計：
    <?php 
    echo 4;
    ?>
    人、
    <?php
    if ($year_month_parameter_set) {
        echo $_GET['year'] . '/' . $_GET['month'];
    } else {
        echo date('Y') . '/' . date('n');
    }?>
    月の請求額：
    <?php
    echo 7;
    ?>
    万円
</div>

<script>
    for(let index=1;index<=35;index++){
        document.getElementById(`each_day${index}`).addEventListener('click',function(){
            let selected_year=document.getElementById('calender_year').innerHTML;
            let selected_month=document.getElementById(`date${index}`).innerHTML.split('/')[0];
            let selected_date=document.getElementById(`date${index}`).innerHTML.split('/')[1];
            window.location=`selected_date.php?year=${selected_year}&month=${selected_month}&date=${selected_date}`;
        });
    }
</script>