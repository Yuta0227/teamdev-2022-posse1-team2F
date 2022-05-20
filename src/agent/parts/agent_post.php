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
    $count_new_stmt = $db->prepare("select count(apply_id) from apply_list where apply_new_status=1 and agent_id=?;");
    $count_new_stmt->bindValue(1, $_SESSION['agent_id']);
    $count_new_stmt->execute();
    $count_new_data = $count_new_stmt->fetchAll()[0]['count(apply_id)'];

    for ($index = 0; $index < $count_new_data; $index++) {
        if (isset($_POST['new_report_reason' . $index]) && isset($_POST['report_new_apply_id' . $index])) {
            //新着通報されたら
            $applicant_stmt = $db->prepare("select apply_id,agent_id,agent_name,apply_time,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents from apply_list where apply_id=?;");
            $applicant_stmt->bindValue(1, $_POST['report_new_apply_id' . $index]);
            $applicant_stmt->execute();
            $applicant_data = $applicant_stmt->fetchAll();

            //通報期限より前なら
            //日数の差を取得
            mb_language("ja");
            mb_internal_encoding("utf-8");
            $to='';
            for($mail_index=0;$mail_index<count($_SESSION['admin_email']);$mail_index++){
                switch($mail_index){
                    case count($_SESSION['admin_email'])-1:
                        $to.=$_SESSION['admin_email'][$mail_index];
                        break;
                    default:
                    $to.=$_SESSION['admin_email'][$mail_index].',';
                    break;
                }
            }
            $subject = "通報";
            $msg = $_SESSION['agent_name'].$_SESSION['agent_branch'].'の'.$_SESSION['assignee_name']."です。\n";
            foreach ($applicant_data[$index] as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                $msg .= $column . ':' . $data . "\n";
            }
            $msg .= '上記の学生を' . $_POST['new_report_reason' . $index] . 'の理由で通報します';
            $from = $_SESSION['agent_email'];
            $header = "From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
            if (!mb_send_mail($to, $subject, $msg, $header)) {
                echo 'メール送信失敗';
            }
            $delete_request_stmt=$db->prepare("insert into delete_request (apply_id,agent_id,request_reason,assignee_email) values (?,?,?,?);");
            $delete_request_stmt->bindValue(1,$_POST['report_new_apply_id'.$index]);
            $delete_request_stmt->bindValue(2,$_SESSION['agent_id']);
            $delete_request_stmt->bindValue(3,$_POST['new_report_reason'.$index]);
            $delete_request_stmt->bindValue(4,$_SESSION['agent_email']);
            $delete_request_stmt->execute();
            //通報を通報テーブルに追加
            //通報メールに記入する学生の情報を取得
            //メール関数書く
            $update_stmt = $db->prepare("update apply_list set apply_report_status=1, apply_new_status=0 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['report_new_apply_id' . $index]);
            $update_stmt->execute();
            //通報押して新着から消す・通報ステータスtrueにする
            break;
        }
        if (isset($_POST['close_new_apply_id' . $index])) {
            $update_stmt = $db->prepare("update apply_list set apply_new_status=0 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['close_new_apply_id' . $index]);
            $update_stmt->execute();
            //閉じる押して新着から消す
        }
    }
    $count_apply_stmt = $db->prepare("select count(apply_id) from apply_list where agent_id=?;");
    $count_apply_stmt->bindValue(1, $_SESSION['agent_id']);
    $count_apply_stmt->execute();
    $count_apply_data = $count_apply_stmt->fetchAll()[0]['count(apply_id)'];
    for ($index = 0; $index < $count_apply_data; $index++) {
        if (isset($_POST['close_apply_id' . $index])) {
            $update_stmt = $db->prepare("update apply_list set apply_new_status=0 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['close_apply_id' . $index]);
            $update_stmt->execute();
            var_dump($_POST);
            //新着から消す
            break;
        }
        if (isset($_POST['report_apply_id' . $index]) && isset($_POST['report_reason' . $index])) {
            //一覧から通報
            var_dump($_POST);
            $applicant_stmt = $db->prepare("select apply_id,agent_id,agent_name,apply_time,applicant_email_address,applicant_name_kanji,applicant_name_furigana,applicant_phone_number,applicant_university,applicant_gakubu,applicant_gakka,applicant_graduation_year,applicant_postal_code,applicant_address,applicant_consultation,applicant_other_agents from apply_list where apply_id=?;");
            $applicant_stmt->bindValue(1, $_POST['report_apply_id' . $index]);
            $applicant_stmt->execute();
            $applicant_data = $applicant_stmt->fetchAll();
            $update_stmt = $db->prepare("update apply_list set apply_report_status=1 where apply_id=?;");
            $update_stmt->bindValue(1, $_POST['report_apply_id' . $index]);
            $update_stmt->execute();
            mb_language("ja");
            mb_internal_encoding("utf-8");
            $to='';
            for($mail_index=0;$mail_index<count($_SESSION['admin_email']);$mail_index++){
                switch($mail_index){
                    case count($_SESSION['admin_email'])-1:
                        $to.=$_SESSION['admin_email'][$mail_index];
                        break;
                    default:
                    $to.=$_SESSION['admin_email'][$mail_index].',';
                    break;
                }
            }
            $subject = "通報";
            $msg = $_SESSION['agent_name'].$_SESSION['agent_branch'].'の'.$_SESSION['assignee_name']."です。\n";
            foreach ($applicant_data[0] as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                $msg .= $column . ':' . $data . "\n";
            }
            $msg .= '上記の学生を' . $_POST['report_reason' . $index] . 'の理由で通報します';
            $from = $_SESSION['agent_email'];
            $header = "From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
            if (!mb_send_mail($to, $subject, $msg, $header)) {
                echo 'メール送信失敗';
            }
            $delete_request_stmt=$db->prepare("insert into delete_request (apply_id,agent_id,request_reason,assignee_email) values (?,?,?,?);");
            $delete_request_stmt->bindValue(1,$_POST['report_apply_id'.$index]);
            $delete_request_stmt->bindValue(2,$_SESSION['agent_id']);
            $delete_request_stmt->bindValue(3,$_POST['report_reason'.$index]);
            $delete_request_stmt->bindValue(4,$_SESSION['agent_email']);
            $delete_request_stmt->execute();
            //通報を通報テーブルに追加
        }
    }
}
