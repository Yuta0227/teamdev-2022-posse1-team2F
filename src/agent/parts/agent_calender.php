<div>
    <?php
    echo $_GET['year'].'年';
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
    $number_of_applies_array = []; //月の申込件数
    $calender_dates = []; //カレンダーで表示する日
    if ($adjust->single($_GET['month']) != 1) {
        //パラメータのmonthが1じゃないなら普通に月減らす
        $decrease_month = $adjust->single($_GET['month']) - 1;
        $decrease_year = $_GET['year'];
    } else {
        $decrease_month = 12;
        $decrease_year = $_GET['year'] - 1;
    };

    if ($_GET['month'] != 12) {
        //パラメータのmonthが12じゃないなら普通に月増やす
        $increase_month = $adjust->single($_GET['month']) + 1;
        $increase_year = $_GET['year'];
    } else {
        $increase_month = 1;
        $increase_year = $_GET['year'] + 1;
    };

    //パラメータセット時
    $year_month = $_GET['year'] . '-' . $_GET['month']; //パラメータの年月
    $year_last_month = $_GET['year'] . '-' . ($adjust->double($adjust->single($_GET['month']) - 1)); //パラメータの年月の先月
    $date = date($year_month . '-' . date('t', strtotime($year_month))); //yearパラメータ-monthパラメータ-パラメータ年月の最終日
    $weeks_per_month = ceil((date('d', strtotime($date)) - date('w', strtotime($date)) - 1) / 7) + 1; //月における週の数をとる
    for ($day = date('w', strtotime($year_month . '-01')) - 1; $day >= 0; $day--) {
        $number_of_applies_stmt = $db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
        $number_of_applies_stmt->bindValue(1, $_SESSION['agent_id']);
        $number_of_applies_stmt->bindValue(2, $year_last_month . '-' . date('t', strtotime($year_last_month)) - $day . ' 00:00:00');
        $number_of_applies_stmt->bindValue(3, $year_last_month . '-' . date('t', strtotime($year_last_month)) - $day . ' 23:59:59');
        $number_of_applies_stmt->execute();
        $number_of_applies_data = $number_of_applies_stmt->fetchAll();
        $number_of_applies_array += array(($decrease_month . '/' . date('t', strtotime($year_last_month)) - $day) => $number_of_applies_data[0]['count(apply_id)']);
        //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
        array_push($calender_dates, ($decrease_month . '/' . date('t', strtotime($year_last_month)) - $day));
        //カレンダーで表示する日付を日付配列に追加
    }
    for ($day = 1; $day <= date('t', strtotime($year_month)); $day++) {
        $number_of_applies_stmt = $db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
        $number_of_applies_stmt->bindValue(1, $_SESSION['agent_id']);
        $number_of_applies_stmt->bindValue(2, $_GET['year'] . '-' . $_GET['month'] . '-' . $adjust->double($day) . ' 00:00:00');
        $number_of_applies_stmt->bindValue(3, $_GET['year'] . '-' . $_GET['month'] . '-' . $adjust->double($day) . ' 23:59:59');
        $number_of_applies_stmt->execute();
        $number_of_applies_data = $number_of_applies_stmt->fetchAll();

        array_push($calender_dates, ($adjust->single(($_GET['month'])) . '/' . $day));
        //カレンダーで表示する日付を日付配列に追加
        $number_of_applies_array += array($adjust->single($_GET['month']) . '/' . $day => $number_of_applies_data[0]['count(apply_id)']);
    }
    for ($day = 1; $day <= 6 - date('w', strtotime($year_month . '-' . date('t', strtotime($year_month)))); $day++) { //来月の何日分出力するか今月の最終日の曜日をもとにきめる
        $number_of_applies_stmt = $db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
        $number_of_applies_stmt->bindValue(1, $_SESSION['agent_id']);
        $number_of_applies_stmt->bindValue(2, $increase_year . '-' . $adjust->double($increase_month) . '-' . $adjust->double($day) . ' 00:00:00');
        $number_of_applies_stmt->bindValue(3, $increase_year . '-' . $adjust->double($increase_month) . '-' . $adjust->double($day) . ' 23:59:59');
        $number_of_applies_stmt->execute();
        $number_of_applies_data = $number_of_applies_stmt->fetchAll();
        array_push($calender_dates, ($increase_month . '/' . $day));
        //来月の日付を日付配列に追加
        $number_of_applies_array += array(($increase_month . '/' . $day) => $number_of_applies_data[0]['count(apply_id)']);
    }

    for ($week = 1; $week <= $weeks_per_month; $week++) {
        echo '<tr>';
        for ($i = 1; $i <= 7; $i++) {
            echo '<td id="each_day' . $i - 7 + 7 * $week . '" style="position:relative;width:100px;height:100px;border:solid 1px black;">';
            echo '<div id="date' . $i - 7 + 7 * $week . '" style="position:absolute;top:0;left:0;width:40%;height:40%;;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
            echo '<div id="number' . $i - 7 + 7 * $week . '" style="position:absolute;bottom:0;right:0;width:60%;height:60%;text-align:center;">' . $number_of_applies_array[$calender_dates[$i - 7 + $week * 7 - 1]] . '件</div>';
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
        if ($adjust->single($_GET['month']) != 1) {
            //パラメータのmonthが1じゃないなら普通に月減らす
            $decrease_month = $adjust->single($_GET['month']) - 1;
            $decrease_year = $_GET['year'];
        } else {
            $decrease_month = 12;
            $decrease_year = $_GET['year'] - 1;
        };
        echo  'index.php?year=' . $decrease_year . '&month=' . $adjust->double($decrease_month) . '&date=' . date('d');

        ?>
        ">
            &lt;
        </a>
    </div>
    <div>
        <?php
        echo '<span id="calender_year">' . $_GET['year'] . '</span>' . '年' . $adjust->single($_GET['month']).'月';
        ?>
    </div>
    <div>
        <?php
        if ($_GET['year'] . '/' . $adjust->single($_GET['month']) != date('Y') . '/' . date('n')) {
            //パラメータがあるかつそれがページを開いたときの年月と一致してないとき==最新月ではないときのみ矢印表示する
        ?>
            <a href="
        <?php
            if ($adjust->single($_GET['month']) != 12) {
                //パラメータのmonthが12じゃないなら普通に月増やす
                $increase_month = $adjust->single($_GET['month']) + 1;
                $increase_year = $_GET['year'];
            } else {
                $increase_month = 1;
                $increase_year = $_GET['year'] + 1;
            };
            echo 'index.php?year=' . $increase_year . '&month=' . $adjust->double($increase_month);


        ?>">
                &gt;
            </a>
        <?php
        } ?>
    </div>
</div>
<div>
    <?php
    echo $_GET['year'] . '年' . $adjust->single($_GET['month']);
    ?>
    月の請求額：
    <?php
    $number_of_applies_per_month=$db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
    $number_of_applies_per_month->bindValue(1,$_SESSION['agent_id']);
    $number_of_applies_per_month->bindValue(2,$_GET['year'].'-'.$_GET['month'].'-01 00:00:00');
    $number_of_applies_per_month->bindValue(3,$_GET['year'].'-'.$adjust->double($increase_month).'-01 00:00:00');
    $number_of_applies_per_month->execute();
    $number_of_applies_per_month=$number_of_applies_per_month->fetchAll();
    echo $number_of_applies_per_month[0]['count(apply_id)']*$_SESSION['price_per_apply'];
    ?>
    円(
        <?php echo $number_of_applies_per_month[0]['count(apply_id)'].'件';?>
    )
</div>

<script>
    for (let index = 1; index <= 35; index++) {
        document.getElementById(`each_day${index}`).addEventListener('click', function() {
            let selected_year = document.getElementById('calender_year').innerHTML;
            let selected_month = document.getElementById(`date${index}`).innerHTML.split('/')[0];
            let selected_date = document.getElementById(`date${index}`).innerHTML.split('/')[1];
            window.location = `selected_date.php?year=${selected_year}&month=${selected_month}&date=${selected_date}`;
        });
    }
</script>