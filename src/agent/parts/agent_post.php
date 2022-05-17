<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['profile'])) {
        header("Location:/agent/pages/profile.php?year=" . $_GET['year'] . "&month=" . $_GET['month'] . "&date=" . $_GET['date']);
    }
    if (isset($_POST['list'])) {
        header("Location:/agent/pages/index.php?year=" . $_GET['year'] . "&month=" . $_GET['month'] . "&date=" . $_GET['date']);
    }
    if (isset($_POST['logout'])) {
        header("Location:/toppage/pages/login.php");
        session_destroy();
    }
    for ($index = 0; $index >= 0; $index++) {
        if (isset($_POST['new_report_reason' . $index]) && isset($_POST['update_apply_id' . $index])) {
            //新着通報されたら
            ${"applicant_stmt" . $index} = $db->prepare("select apply_id,agent_id,agent_name,apply_time,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents from apply_list where apply_id=?;");
            ${"applicant_stmt" . $index}->bindValue(1, $_POST['update_apply_id' . $index]);
            ${"applicant_stmt" . $index}->execute();
            ${"applicant_data" . $index} = ${"applicant_stmt" . $index}->fetchAll();
            mb_language("ja");
            mb_internal_encoding("utf-8");
            $to = 'admin@gmail.com';
            $subject = "通報";
            $msg = '';
            foreach (${"applicant_data" . $index}[0] as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                $msg .= $column . ':' . $data . "\n";
            }
            $msg .= '上記の学生を' . $_POST['new_report_reason' . $index] . 'の理由で通報します';
            $from = $_SESSION['agent_email'];
            $header = "From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
            if (!mb_send_mail($to, $subject, $msg, $header)) {
                echo 'メール送信失敗';
            }
            //通報メールに記入する学生の情報を取得
            //メール関数書く
            $update_stmt = $db->prepare("update apply_list set applicant_report_status=1, apply_new_status=0 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['update_apply_id' . $index]);
            $update_stmt->execute();
            //新着から消す・通報ステータスtrueにする
        }
        break;
    }
    for ($index = 0; $index >= 0; $index++) {
        if (isset($_POST['close_apply_id' . $index])) {
            $update_stmt = $db->prepare("update apply_list set apply_new_status=0 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['close_apply_id' . $index]);
            $update_stmt->execute();
            //新着から消す
            break;
        }
    }
}
