<section class="admin-agent-detail-calender-unit">
    <div class="admin-agent-detail-calender-head">
        <div>
            <a class="admin-agent-detail-calender-month-move" href="
            <?php
            $number_of_applies = []; //月の申込件数
            $calender_dates = []; //カレンダーで表示する日
            $year_month_parameter_set = isset($_GET['year']) && isset($_GET['month']);
        if ($year_month_parameter_set) {
            if ($_GET['month'] != '1') {
                //パラメータのmonthが1じゃないなら普通に月減らす
                $decrease_month = $adjust->double($adjust->single($_GET['month']) - 1);
                $decrease_year = $_GET['year'];
            } else {
                $decrease_month = '12';
                $decrease_year = $_GET['year'] - 1;
            };
            echo $admin_agent_detail_url . '?year=' . $decrease_year . '&month=' . $decrease_month.'&agent_id='.$_GET['agent_id'];
        } else {
            if (date('n') != 1) {
                //パラメータのmonthが1じゃないなら普通に月減らす
                $decrease_month = date('n') - 1;
                $decrease_year = date('Y');
            } else {
                $decrease_month = '12';
                $decrease_year = date('Y') - 1;
            };
            echo $admin_agent_detail_url . '?year=' . $decrease_year . '&month=' . $decrease_month.'&agent_id='.$_GET['agent_id'];
        }
        ?>
        ">
                &lt;
            </a>
        </div>
        <div>
            <?php
            if ($year_month_parameter_set) {
                echo '<span id="calender_year">' . $_GET['year'] . '</span>' . '年' . $adjust->single($_GET['month']).'月の申込一覧';
            } else {
                echo '<span id="calender_year">' . date('Y') . '</span>' . '年' . date('n').'月の申込一覧';
            }
            ?>
        </div>
        <div>
            <?php if ($year_month_parameter_set) {
                if ($_GET['year'] . '/' . $_GET['month'] != date('Y') . '/' . date('m')) {
                    //パラメータがあるかつそれがページを開いたときの年月と一致してないとき==最新月ではないときのみ矢印表示する
            ?>
                    <a class="admin-agent-detail-calender-month-move" href="
        <?php
                    if ($year_month_parameter_set) {
                        if ($_GET['month'] != '12') {
                            //パラメータのmonthが12じゃないなら普通に月増やす
                            $increase_month = $adjust->double($adjust->single($_GET['month']) + 1);
                            $increase_year = $_GET['year'];
                        } else {
                            $increase_month = '01';
                            $increase_year = $_GET['year'] + 1;
                        };
                        echo $admin_agent_detail_url . '?year=' . $increase_year . '&month=' . $increase_month.'&agent_id='.$_GET['agent_id'];
                    }

        ?>">
                        &gt;
                    </a>
            <?php }
            } ?>
        </div>
    </div>
    <table class="admin-agent-detail-calender-table">
        <?php
        if ($year_month_parameter_set) {
            if ($_GET['month'] != '01') {
                //パラメータのmonthが1じゃないなら普通に月減らす
                $decrease_month=$adjust->single($_GET['month'])-1;
                $decrease_month=$adjust->double($decrease_month);
                $decrease_year = $_GET['year'];
            } else {
                $decrease_month = '12';
                $decrease_year = $_GET['year'] - 1;
            };
        }
        if ($year_month_parameter_set) {
            if ($_GET['month'] != '12') {
                //パラメータのmonthが12じゃないなら普通に月増やす
                $increase_month=$adjust->single($_GET['month'])+1;
                $increase_month=$adjust->double($increase_month);
                $increase_year = $_GET['year'];
            } else {
                $increase_month = '01';
                $increase_year = $_GET['year'] + 1;
            };
        }
        if ($year_month_parameter_set) {
            //パラメータセット時
            $year_month = $_GET['year'] . '-' . $_GET['month']; //パラメータの年月
            $year_last_month = $_GET['year'] . '-' . $decrease_month; //パラメータの年月の先月
            $date = date($year_month . '-' . date('t', strtotime($year_month))); //yearパラメータ-monthパラメータ-パラメータ年月の最終日
            $weeks_per_month = ceil((date('d', strtotime($date)) - date('w', strtotime($date)) - 1) / 7) + 1; //月における週の数をとる
            for ($day = date('w', strtotime($year_month . '-01')) - 1; $day >= 0; $day--) {
                $decrease_date=date('t',strtotime($year_last_month))-$adjust->double($day);
                $start_decrease_year_month_date=$decrease_year."-".$decrease_month."-".$decrease_date." 00:00:00";
                $end_decrease_year_month_date=$decrease_year."-".$decrease_month."-".$decrease_date." 23:59:59";
                $applies_per_day_stmt=$db->prepare("select count(apply_id) from apply_list where apply_id=? and apply_time between ? and ?;");
                $applies_per_day_stmt->bindValue(1,$_GET['agent_id']);                
                $applies_per_day_stmt->bindValue(2,$start_decrease_year_month_date);     
                $applies_per_day_stmt->bindValue(3,$end_decrease_year_month_date);
                $applies_per_day_stmt->execute();
                $applies_per_day_data=$applies_per_day_stmt->fetchAll();                
                $number_of_applies += array(($adjust->single($decrease_month) . '/' . $adjust->single(date('t', strtotime($year_last_month)) - $day)) => $applies_per_day_data);
                //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
                array_push($calender_dates, ($adjust->single($decrease_month) . '/' . $adjust->single(date('t', strtotime($year_last_month)) - $day)));
                //カレンダーで表示する日付を日付配列に追加
            }
            for ($day = 1; $day <= date('t', strtotime($year_month)); $day++) {
                $start_year_month_date=$_GET['year']."-".$_GET['month']."-".$day." 00:00:00";
                $end_year_month_date=$_GET['year']."-".$_GET['month']."-".$day." 23:59:59";
                $applies_per_day_stmt=$db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
                $applies_per_day_stmt->bindValue(1,$_GET['agent_id']);                
                $applies_per_day_stmt->bindValue(2,$start_year_month_date);                
                $applies_per_day_stmt->bindValue(3,$end_year_month_date);
                $applies_per_day_stmt->execute();
                $applies_per_day_data=$applies_per_day_stmt->fetchAll();  
                $number_of_applies += array($adjust->single($_GET['month']) . '/' . $adjust->single($day) => $applies_per_day_data);
                //4には申込件数代入
                array_push($calender_dates, (($adjust->single($_GET['month']) . '/' . $adjust->single($day))));
                //カレンダーで表示する日付を日付配列に追加
            }
            for ($day = 1; $day <= 6 - date('w', strtotime($year_month . '-' . date('t', strtotime($year_month)))); $day++) { //来月の何日分出力するか今月の最終日の曜日をもとにきめる
                $start_increase_year_month_date=$increase_year."-".$increase_month."-".$adjust->double($day)." 00:00:00";
                $end_increase_year_month_date=$increase_year."-".$increase_month."-".$adjust->double($day)." 23:59:59";
                $applies_per_day_stmt=$db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
                $applies_per_day_stmt->bindValue(1,$_GET['agent_id']);                
                $applies_per_day_stmt->bindValue(2,$start_increase_year_month_date);                
                $applies_per_day_stmt->bindValue(3,$end_increase_year_month_date);
                $applies_per_day_stmt->execute();
                $applies_per_day_data=$applies_per_day_stmt->fetchAll();                
                array_push($calender_dates, ($adjust->single($increase_month) . '/' . $adjust->single($day)));
                //来月の日付を日付配列に追加
                $number_of_applies += array(($adjust->single($increase_month) . '/' . $adjust->single($day)) => $applies_per_day_data);
            }
        } 
        // else {
        //     //パラメータ未セット時
        //     $year_month = date('Y') . '-' . date('n');
        //     $year_last_month = date('Y') .'-'. (date('n') - 1);
        //     $last_month = date('n') - 1;
        //     $date = date('Y-m-' . date('t')); //2022/04/30
        //     $weeks_per_month = ceil((date('d', strtotime($date)) - date('w', strtotime($date)) - 1) / 7) + 1; //月における週の数をとる
        //     //該当月の1日の曜日を数字で取得して先月の最後の方を配列に追加する
        //     for ($i = date('w', strtotime($year_month . '-01')) - 1; $i >= 0; $i--) { //今月の一日の曜日をもとに先月の何日分出力するか
        //         $applies_per_day_stmt->bindValue(1,$_GET['agent_id']);                
        //         $applies_per_day_stmt->bindValue(2,$year_last_month.'-'.date('t',strtotime($year_last_month)-$i));                
        //         $applies_per_day_stmt->bindValue(3,$year_last_month.'-'.date('t',strtotime($year_last_month)-$i));
        //         $applies_per_day_stmt->execute();
        //         $applies_per_day_data=$applies_per_day_stmt->fetchAll();                
        //         $number_of_applies += array(($last_month . '/' . date('t', strtotime($year_last_month)) - $i) => $applies_per_day_data);
        //         //先月の最後の件数を件数配列に追加
        //         array_push($calender_dates, (($last_month . '/' . date('t', strtotime($year_last_month) - $i))));
        //         //カレンダーで表示する日付を日付配列に追加
        //     }
        //     for ($day = 1; $day <= date('t'); $day++) {
        //         $applies_per_day_stmt->bindValue(1,$_GET['agent_id']);                
        //         $applies_per_day_stmt->bindValue(2,$year_month.'-'.$day);                
        //         $applies_per_day_stmt->bindValue(3,$year_month.'-'.$day);
        //         $applies_per_day_stmt->execute();
        //         $applies_per_day_data=$applies_per_day_stmt->fetchAll();                
        //         $number_of_applies += array(date('n') . '/' . $day => $applies_per_day_data);
        //         //4には申込件数代入
        //         array_push($calender_dates, ((date('n') . '/' . $day)));
        //         //カレンダーで表示する日付を日付配列に追加
        //     }
        // }
        for ($week = 1; $week <= $weeks_per_month; $week++) {
            echo '<tr>';
            for ($i = 1; $i <= 7; $i++) {
                echo '<td id="each_day' . $i - 7 + 7 * $week . '" style="position:relative;width:100px;height:100px;border:solid 1px black;cursor:pointer;">';
                if ($year_month_parameter_set) {
                    //パラメータセット時
                    echo '<div id="date' . $i - 7 + 7 * $week . '" style="position:absolute;top:0;left:0;width:40%;height:40%;;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
                    echo '<div id="number' . $i - 7 + 7 * $week . '" class="admin-agent-detail-calender-number">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]][0]['count(apply_id)'] . '件</div>';
                } else {
                    //パラメータ未セット時
                    echo '<div id="date' . $i - 7 + 7 * $week . '" style="position:absolute;top:0;left:0;width:40%;height:40%;text-align:center;">' . $calender_dates[$i - 7 + $week * 7 - 1] . '</div>';
                    echo '<div id="number' . $i - 7 + 7 * $week . '" class="admin-agent-detail-calender-number">' . $number_of_applies[$calender_dates[$i - 7 + $week * 7 - 1]][0]['count(apply_id)'] . '件</div>';
                }
                echo '</td>';
            };
            echo '</tr>';
        }
        ?>
    </table>
    <div class="admin-agent-detail-year-month">
        <?php
        if ($year_month_parameter_set) {
            echo $_GET['year'] . '年' . $adjust->single($_GET['month']);
        } else {
            echo date('Y') . '年' . date('n');
        } ?>
        月の合計：
        <?php
        $start_year_month=$year_month."-01 00:00:00";
        $end_year_month=$year_month."-".date('t',strtotime($year_month))." 23:59:59";
        $applies_per_month_stmt=$db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
        $applies_per_month_stmt->bindValue(1,$_GET['agent_id']);
        $applies_per_month_stmt->bindValue(2,$start_year_month);
        $applies_per_month_stmt->bindValue(3,$end_year_month);
        $applies_per_month_stmt->execute();
        $applies_per_month_data=$applies_per_month_stmt->fetchAll();
        echo $applies_per_month_data[0]['count(apply_id)'];
        ?>
        人、
        <?php
        if ($year_month_parameter_set) {
            echo $_GET['year'] . '年' . $adjust->single($_GET['month']);
        } else {
            echo date('Y') . '年' . date('n');
        } ?>
        月の請求額：
        <?php
        echo $applies_per_month_data[0]['count(apply_id)']*$_SESSION['price_per_apply'];
        ?>
        円
    </div>
</section>

<script>
    for (let index = 1; index <= 35; index++) {
        document.getElementById(`each_day${index}`).addEventListener('click', function() {
            let selected_year = document.getElementById('calender_year').innerHTML;
            let selected_month = document.getElementById(`date${index}`).innerHTML.split('/')[0];
            if(selected_month<=9){
                selected_month='0'+selected_month;
            }
            let selected_date = document.getElementById(`date${index}`).innerHTML.split('/')[1];
            if(selected_date<=9){
                selected_date='0'+selected_date;
            }
            window.location = `<?php echo $admin_agent_selected_date_url; ?>?agent_id=<?php echo $_GET['agent_id'];?>&year=${selected_year}&month=${selected_month}&date=${selected_date}`;
        });
    }
</script>