<section class="agent-new-apply-unit">
    <div class="agent-welcome"><?php echo $_SESSION['agent_contract_information'][0]['agent_name']; ?>さんようこそ</div>
    <?php
    $new_applies_array = $db->prepare("select * from apply_list where agent_id=? and apply_new_status=true;");
    $new_applies_array->bindValue(1, $_SESSION['agent_id']);
    $new_applies_array->execute();
    $new_applies_array = $new_applies_array->fetchAll();
    if (count($new_applies_array) != 0) {
        //新着があったら
        echo '<div class="agent-new-apply-header">新着の申込一覧</div>';
        echo '<table class="agent-new-apply-explanations">';
        echo '    <tr>';
        echo '        <th class="agent-new-apply-explanation">申込日時</th>';
        echo '        <th class="agent-new-apply-explanation">メールアドレス</th>';
        echo '    </tr>';
        echo '</table>';
        for ($index = 0; $index < count($new_applies_array); $index++) {
            $year = $adjust->single(explode('-', explode(' ', $new_applies_array[$index]['apply_time'])[0])[0]);
            $month = $adjust->single(explode('-', explode(' ', $new_applies_array[$index]['apply_time'])[0])[1]);
            $date = $adjust->single(explode('-', explode(' ', $new_applies_array[$index]['apply_time'])[0])[2]);
            $hour = explode(':', explode(' ', $new_applies_array[$index]['apply_time'])[1])[0];
            $minute = explode(':', explode(' ', $new_applies_array[$index]['apply_time'])[1])[1];
            $second = explode(':', explode(' ', $new_applies_array[$index]['apply_time'])[1])[2];
            echo '<form method="POST" id="test' . $index . '" class="agent-new-apply-info-box">';
            echo '<div>' . $month . '/' .  $date . ' ' .  $hour . ':' . $minute . '</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_email_address'] . '</div>';
            echo '<input type="button" id="open_new_apply' . $index . '" value="詳細▽">';
            echo '<input hidden name="close_new_apply_id' . $index . '" value="' . $new_applies_array[$index]['apply_id'] . '">';
            echo '<input id="close_new_apply' . $index . '" hidden value="閉じる△" type="submit">';
            echo '</form>';
            echo '<div id="new_apply_detail' . $index . '" hidden class="agent-apply-detail-box">';
            echo '<div>' . $new_applies_array[$index]['applicant_name_kanji'] . '(' . $new_applies_array[$index]['applicant_name_furigana'] . ')</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_phone_number'] . '</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_university'] . ' ' . $new_applies_array[$index]['applicant_gakubu'] . ' ' . $new_applies_array[$index]['applicant_gakka'] . ' ' . $new_applies_array[$index]['applicant_graduation_year'] . '年卒</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_postal_code'] . '</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_address'] . '</div>';
            echo '<div>' . $new_applies_array[$index]['applicant_other_agents'] . '</div>';
            echo '<div>相談：' . $new_applies_array[$index]['applicant_consultation'] . '</div>';
            echo '<form name="report_form' . $index . '" onsubmit="submit_reason();" action="" method="POST">';
            echo '<div class="report-box">';
            if ($new_applies_array[$index]['apply_report_status'] == 0) {
                //通報されていない場合
                $current_datetime = new DateTime(date('Y-m-d H:i:s'));
                $deadline_datetime = new DateTime($new_applies_array[$index]['apply_report_deadline']);
                $diff = $deadline_datetime->diff($current_datetime);
                //期限から現在日時をひく
                if ($diff->format('%a') >= 0) {
                    if ($month != 12) {
                        //申込の月が12月ではない場合
                        echo '<div id="new_report' . $index . '"  class="agent-report-not-yet">通報する(' . $year . '年' . ($month + 1) . '月1日23:59まで)</div>';
                    } else {
                        //申込の月が12の場合=>翌年の一月まで
                        echo '<div id="new_report' . $index . '"  class="agent-report-not-yet">通報する(' . ($year + 1) . '年1月1日23:59まで)</div>';
                    }
                } else {
                    echo '<div class="agent-report-done" >通報期限過ぎてます</div>';
                }
            } else {
                //通報されている場合
                echo '<div id="new_reported' . $index . '" class="agent-report-done" >通報済み</div>';
            }
            echo '</div>';
            echo '<div id="new_report_reason' . $index . '" style="border:1px solid black;" hidden>';
            echo '<div style="display:flex;justify-content:center;align-items:center;">';
            echo '<span>通報理由：</span>';
            echo '<textarea type="text" name="new_report_reason' . $index . '" required placeholder="理由を記入してください"></textarea>';
            echo '<input hidden name="report_new_apply_id' . $index . '" value="' . $new_applies_array[$index]['apply_id'] . '">';
            echo '</div>';
            echo '<div style="display:flex;justify-content:center;"><div id="cancel_new_report' . $index . '">キャンセル</div><input type="submit" value="通報"></div></div>';
            echo '</form>';
            echo '</div>';
        };
    };
    ?>
</section>

<script>
    <?php for ($index = 0; $index < count($new_applies_array); $index++) { ?>
        document.getElementById('open_new_apply<?php echo $index; ?>').addEventListener('click', function() {
            //新着の詳細ボタン押すと
            document.getElementById('close_new_apply<?php echo $index; ?>').removeAttribute('hidden');
            //新着の閉じるボタン出現
            document.getElementById('open_new_apply<?php echo $index; ?>').setAttribute('hidden', '');
            //新着の詳細ボタンが消える
            document.getElementById('new_apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            //学生の情報が出現
            <?php if ($new_applies_array[$index]['apply_new_status'] == 0) { ?>
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
            <?php if ($new_applies_array[$index]['apply_new_status'] == 0) { ?>
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