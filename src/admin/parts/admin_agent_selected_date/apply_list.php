<!-- agent画面の方で削除の申請したらadmin画面にその通知が来るようにしたい。申込一覧の通報が来てるものにNEW!をつけるべきか、通報が来てるもののみ表示するか -->
<section>
    <div class="admin-agent-apply-list-head"><?php echo $_GET['year'] . '年' . $_GET['month'] . '月' . $_GET['date'] . '日'; ?>の申込学生情報一覧</div>
    <?php
    $applies_stmt = $db->prepare("select * from apply_list where agent_id=? and apply_time between ? and ?;");
    $applies_stmt->bindValue(1, $_GET['agent_id']);
    $applies_stmt->bindValue(2, $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['date'] . ' 00:00:00');
    $applies_stmt->bindValue(3, $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['date'] . ' 23:59:59');
    $applies_stmt->execute();
    $applies_array = $applies_stmt->fetchAll();
    $index = 0;
    foreach ($applies_array as $apply) {
        $delete_request_stmt = $db->prepare("select * from delete_request where apply_id=?;");
        $delete_request_stmt->bindValue(1, $apply['apply_id']);
        $delete_request_stmt->execute();
        $delete_request_data = $delete_request_stmt->fetchAll();
        $year = explode('-', explode(' ', $apply['apply_time'])[0])[0];
        $month = explode('-', explode(' ', $apply['apply_time'])[0])[1];
        $date = explode('-', explode(' ', $apply['apply_time'])[0])[2];
        $time = explode(':', explode(' ', $apply['apply_time'])[1])[0] . ':' . explode(':', explode(' ', $apply['apply_time'])[1])[1];
        $apply = array_merge($apply, array('year' => $year));
        $apply = array_merge($apply, array('month' => $month));
        $apply = array_merge($apply, array('date' => $date));
        $apply = array_merge($apply, array('time' => $time));
        if ($apply['apply_report_status'] == 1) {
            //通報されてる場合
            echo '<form method="POST" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
            if ($delete_request_data[0]['check_status'] == 0) {
                echo '<div style="background-color:red;">通報申請きてます!!!</div>';
            }else{
                echo '<div style="background-color:blue;">通報申請却下済み</div>';
            }
            echo '<div style="width:20%;">' . $apply['month'] . '/' . $apply['date'] . ' ' . $apply['time'] . '</div>';
            echo '<div style="width:20%;">' . $apply['applicant_email_address'] . '</div>';
            echo '<div style="width:60%;padding:0 20px 0 20px;display:flex;justify-content:right;"><input type="button" id="open_apply' . $index . '" value="詳細▽"></div>';
            echo '<input id="close_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
            echo '</form>';
            echo '<div id="apply_detail' . $index . '" hidden style="border:1px solid black;">';
            echo '<div>' . $apply['applicant_name_kanji'] . '(' . $apply['applicant_name_furigana'] . ')</div>';
            echo '<div>' . $apply['applicant_phone_number'] . '</div>';
            echo '<div>' . $apply['applicant_university'] . ',' . $apply['applicant_gakubu'] . ',' . $apply['applicant_gakka'] . ',' . $apply['applicant_graduation_year'] . '年卒</div>';
            echo '<div>' . $apply['applicant_postal_code'] . '</div>';
            echo '<div>' . $apply['applicant_address'] . '</div>';
            echo '<div>' . $apply['applicant_other_agents'] . '</div>';
            if ($apply['applicant_consultation'] != '') {
                echo '<div>相談：' . $apply['applicant_consultation'] . '</div>';
            }
            echo '</div>';
            if ($delete_request_data[0]['check_status'] == 0) {
                echo '<form id="delete_form' . $index . '" action="" method="POST" hidden style="padding;10px;border:1px solid black;">';
                echo '<div>通報理由：' . $delete_request_data[0]['request_reason'] . '</div>';
                echo '<div style="display:flex;justify-content:center;">';
                echo '<div style="width:50%;display:flex;justify-content:center;align-items:center;height:200px;">';
                echo '<input hidden name="approve_decline_apply_id" value="' . $apply['apply_id'] . '">';
                echo '<input type="submit" name="accept_delete_request" value="削除申請承認">'; //自動でメール送信
                echo '</div>';
                echo '<div style="width:50%;display:flex;justify-content:center;align-items:center;height:200px;">';
                echo '<input type="submit" name="decline_delete_request" value="削除申請却下">';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            }
        } else {
            //通報されていない場合
            echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" class="admin-agent-new-apply-info-box">';
            echo '<div style="width:20%;">' . $apply['month'] . '/' . $apply['date'] . ' ' . $apply['time'] . '</div>';
            echo '<div style="width:20%;padding:0 20px 0 20px;">' . $apply['applicant_email_address'] . '</div>';
            echo '<div style="width:60%;display:flex;justify-content:right;"><input class="admin-agent-apply-open-close-detail" type="button" id="open_apply' . $index . '" value="詳細▽"></div>';
            echo '<input class="admin-agent-apply-open-close-detail" id="close_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
            echo '</form>';
            echo '<div id="apply_detail' . $index . '" hidden class="admin-agent-apply-detail-box">';
            echo '<div class="admin-agent-apply-student-detail">' . $apply['applicant_name_kanji'] . '(' . $apply['applicant_name_furigana'] . ')</div>';
            echo '<div class="admin-agent-apply-student-detail">' . $apply['applicant_phone_number'] . '</div>';
            echo '<div class="admin-agent-apply-student-detail">' . $apply['applicant_university'] . ',' . $apply['applicant_gakubu'] . ',' . $apply['applicant_gakka'] . ',' . $apply['applicant_graduation_year'] . '年卒</div>';
            echo '<div class="admin-agent-apply-student-detail">' . $apply['applicant_postal_code'] . '</div>';
            echo '<div class="admin-agent-apply-student-detail">' . $apply['applicant_address'] . '</div>';
            if ($apply['applicant_consultation'] != '') {
                echo '<div class="admin-agent-apply-student-detail">相談：' . $apply['applicant_consultation'] . '</div>';
            }
            echo '</div>';
        }
        $index++;
    }
    echo '<div class="admin-agent-apply-all-amount">' . $_GET['month'] . '月' . $_GET['date'] . '日の合計：' . count($applies_array) . '人</div>';
    ?>
    <div style="text-align:center;"><a class="admin-agent-apply-back-btn" href="admin_agent_detail.php?agent_id=<?php echo $_GET['agent_id']; ?>&year=<?php echo $_GET['year']; ?>&month=<?php echo $_GET['month']; ?>">企業詳細ページに戻る</a></div>
</section>
<script>
    <?php for ($index = 0; $index < count($applies_array); $index++) { ?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('delete_form<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('delete_form<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php }; ?>
</script>