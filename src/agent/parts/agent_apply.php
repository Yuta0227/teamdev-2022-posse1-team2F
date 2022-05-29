<section class="agent-apply-unit">
    <div class="agent-apply-head">
        <?php
        $year = $_GET['year'];
        $month = $adjust->single($_GET['month']);
        $date = $adjust->single($_GET['date']);
        echo $year . '年' . $month . '月' . $date . '日の申込一覧';
        ?></div>
    <table class="agent-apply-box-texts">
        <tr>
            <th class="agent-apply-box-text">申込日時</th>
            <th class="agent-apply-box-text">メールアドレス</th>
        </tr>
    </table>
    <?php
    $applies_array = $db->prepare("select * from apply_list where agent_id=? and apply_time between ? and ?;");
    $applies_array->bindValue(1, $_SESSION['agent_id']);
    $applies_array->bindValue(2, $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['date'] . ' 00:00:00');
    $applies_array->bindValue(3, $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['date'] . ' 23:59:59');
    $applies_array->execute();
    $applies_array = $applies_array->fetchAll();
    for ($index = 0; $index < count($applies_array); $index++) {
        $year = explode('-', explode(' ', $applies_array[$index]['apply_time'])[0])[0];
        $month = $adjust->single(explode('-', explode(' ', $applies_array[$index]['apply_time'])[0])[1]);
        $date = $adjust->single(explode('-', explode(' ', $applies_array[$index]['apply_time'])[0])[2]);
        $hour = explode(':', explode(' ', $applies_array[$index]['apply_time'])[1])[0];
        $minute = explode(':', explode(' ', $applies_array[$index]['apply_time'])[1])[1];
        echo '<form method="POST" action="" id="test' . $index . '" class="agent-new-apply-info-box">';
        echo '<div>' . $month . '/' . $date . ' ' . $hour . ':' . $minute . '</div>';
        echo '<div>' . $applies_array[$index]['applicant_email_address'] . '</div>';
        echo '<input class="agent-apply-open-close-detail" type="button" id="open_apply' . $index . '" value="詳細▽">';
        echo '<input hidden name="close_apply_id' . $index . '" value="' . $applies_array[$index]['apply_id'] . '">';
        echo '<input class="agent-apply-open-close-detail" id="close_apply' . $index . '" hidden value="閉じる△" type="submit">';
        echo '</form>';
        echo '<div id="apply_detail' . $index . '" hidden class="agent-apply-detail-box">';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_name_kanji'] . '(' . $applies_array[$index]['applicant_name_furigana'] . ')</div>';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_phone_number'] . '</div>';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_university'] . $applies_array[$index]['applicant_gakubu'] . $applies_array[$index]['applicant_gakka'] . $applies_array[$index]['applicant_graduation_year'] . '年卒</div>';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_postal_code'] . '</div>';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_address'] . '</div>';
        echo '<div class="agent-apply-student-detail">' . $applies_array[$index]['applicant_other_agents'] . '</div>';
        echo '<div class="agent-apply-student-detail">相談：' . $applies_array[$index]['applicant_consultation'] . '</div>';
        echo '<form name="report_form' . $index . '"  action="" method="POST">';
        echo '<div style="justify-content:center;display:flex;">';
        if ($applies_array[$index]['apply_report_status'] == 0) {
            //通報していない場合
            $current_datetime = new DateTime(date('Y-m-d H:i:s'));
            $deadline_datetime = new DateTime($applies_array[$index]['apply_report_deadline']);
            $diff = $current_datetime->diff($deadline_datetime);
            //期限から現在日時をひく
            if (($diff->format('%R%Y') >= 0) && ($diff->format('%R%M') >= 0) && ($diff->format('%R%D') >= 0) && ($diff->format('%R%H') >= 0) && ($diff->format('%R%I') >= 0)) {
                //期限を過ぎていない
                $is_past_deadline = false;
            } else {
                $is_past_deadline = true;
            }
            if ($is_past_deadline == false) {
                echo '<input hidden name="report_apply_id' . $index . '" value="' . $applies_array[$index]['apply_id'] . '">';
                if ($_GET['month'] == 12) {
                    echo '<div id="report' . $index . '" hidden class="agent-report-not-yet">通報する(' . $_GET['year'] + 1 . '年 1月1日23:59まで)</div>';
                } else {
                    echo '<div id="report' . $index . '" hidden class="agent-report-not-yet">通報する(' . $_GET['year'] . '年' . $_GET['month'] + 1 . '月1日23:59まで)</div>';
                }
            } else {
                echo '<div class="agent-report-done" >通報期限過ぎてます</div>';
            }
        } else {
            //通報した場合
            $check_delete_request_stmt = $db->prepare("select check_status from delete_request where apply_id=?;");
            $check_delete_request_stmt->bindValue(1, $applies_array[$index]['apply_id']);
            $check_delete_request_stmt->execute();
            $check_delete_request_data = $check_delete_request_stmt->fetchAll();
            //delete_requestテーブルを参照しadminが確認してるか判定
            if ($check_delete_request_data[0]['check_status'] == 0) {
                //未確認だったら
                echo '<div class="agent-apply-report-done" id="reported' . $index . '" hidden>通報済み</div>';
            } else {
                //確認済みだったら
                echo '<div class="agent-report-done" >通報却下されました</div>';
            }
        }
        echo '</div>';
        echo '<div id="report_reason' . $index . '" hidden><div class="agent-apply-student-report-reason"><span>通報理由：</span><textarea class="agent-apply-student-report-reason-text" type="text" name="report_reason' . $index . '" required placeholder="理由を記入してください"></textarea></div>';
        echo '<div style="display:flex;justify-content:center;"><div class="agent-apply-student-report-cancel" id="cancel_report' . $index . '">キャンセル</div><input class="agent-apply-student-report-submit" type="submit" value="送信する"></div></div>';
        echo '</form>';
        echo '</div>';
    };
    echo '<div class="agent-apply-all-amout">' . $month . '月' . $date . '日の合計：' . count($applies_array) . '人</div>';
    ?>
</section>

<script>
    <?php for ($index = 0; $index < count($applies_array); $index++) {
        $current_datetime = new DateTime(date('Y-m-d H:i:s'));
        $deadline_datetime = new DateTime($applies_array[$index]['apply_report_deadline']);
        $diff = $current_datetime->diff($deadline_datetime);
        //期限から現在日時をひく
        if (($diff->format('%R%Y') >= 0) && ($diff->format('%R%M') >= 0) && ($diff->format('%R%D') >= 0) && ($diff->format('%R%H') >= 0) && ($diff->format('%R%I') >= 0)) {
            //期限を過ぎていない
            $is_past_deadline = false;
        } else {
            $is_past_deadline = true;
        }
    ?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            //詳細ボタン押すと
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            //閉じるボタンが出現
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            //詳細ボタンが消える
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            //学生の情報が出現
            <?php if ($applies_array[$index]['apply_report_status'] == 0) { ?>
                //通報済みステータスがゼロの場合
                <?php if ($is_past_deadline == false) { ?>
                    document.getElementById('report<?php echo $index; ?>').removeAttribute('hidden');
                    //通報するボタンが出現
                <?php } ?>
            <?php } else { ?>
                document.getElementById('reported<?php echo $index; ?>').removeAttribute('hidden');
                //通報済みボタンが出現
            <?php } ?>
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            //閉じるボタン押すと
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            //閉じるボタンが消える
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            //詳細ボタンが出現
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            //学生の情報が消える
            <?php if ($applies_array[$index]['apply_report_status'] == 0) { ?>
                <?php if ($is_past_deadline == false) { ?>
                    //通報済みステータスがゼロの場合==通報してない場合
                    document.getElementById('report<?php echo $index; ?>').setAttribute('hidden', '');
                    //通報するボタンが消える
                <?php } ?>
            <?php } else { ?>
                //通報済みステータスがゼロじゃない場合==通報済みの場合
                document.getElementById('reported<?php echo $index; ?>').setAttribute('hidden', '');
                //通報済みボタンが消える
            <?php } ?>
        });
        <?php if ($is_past_deadline == false) { ?>
            document.getElementById('cancel_report<?php echo $index; ?>').addEventListener('click', function() {
                //通報キャンセルボタン押すと
                document.getElementById('report_reason<?php echo $index; ?>').setAttribute('hidden', '');
                //通報理由記入フォームが消える
                document.getElementById('report<?php echo $index; ?>').removeAttribute('hidden', '');
                //通報するボタンが出現する
            });
            <?php if ($applies_array[$index]['apply_report_status'] == 0) { ?>
                document.getElementById('report<?php echo $index; ?>').addEventListener('click', function() {
                    //通報するボタン押すと
                    document.getElementById('report<?php echo $index; ?>').setAttribute('hidden', '');
                    //通報するボタンが消える
                    document.getElementById('report_reason<?php echo $index; ?>').removeAttribute('hidden');
                    //通報理由記入フォームが出現する
                });
    <?php }
        }
    } ?>
</script>