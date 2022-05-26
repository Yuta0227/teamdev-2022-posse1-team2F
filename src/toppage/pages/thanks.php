<?php
session_start();
date_default_timezone_set('Asia/Tokyo');
require "../../dbconnect.php";
require "../../function.php";
unset($_SESSION['selected_agents']);
if (isset($_SESSION['form_sent'])) {
    if ($_SESSION['form_sent'] == true) {
        //送信済みの場合リロードすると自動でindex.phpにもどる
        header("Location:index.php");
    }
}
$_SESSION['already_applied'] = [];
if (isset($_POST['send_form'])) {
    //formの情報受け取って問い合わせ送信する
    if (isset($_SESSION['consultation'])) {

        $other_agents = '';
        for ($index = 0; $index <= count($_SESSION['consultation']) - 1; $index++) {
            if ($_SESSION['consultation'][$index]['name'] == $_SESSION['consultation'][count($_SESSION['consultation']) - 1]['name']) {
                //最後なら
                $other_agents .= $_SESSION['consultation'][$index]['name'];
            } else {
                $other_agents .= $_SESSION['consultation'][$index]['name'] . ',';
            }
        }
        foreach ($_SESSION['consultation'] as $applied_agent) {
            //エージェントの数分
            $insert_stmt = $db->prepare("insert into apply_list (
            agent_id,
            agent_name,
            apply_time,
            applicant_email_address,
            applicant_name_kanji,
            applicant_name_furigana,
            applicant_phone_number,
        applicant_university,
        applicant_gakubu,
        applicant_gakka,
        applicant_graduation_year,
        applicant_postal_code,
        applicant_address,
        applicant_consultation,
        applicant_other_agents,
        apply_report_deadline) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
            //相談ありの場合
            $insert_stmt->bindValue(1, $applied_agent['id']);
            $insert_stmt->bindValue(2, $applied_agent['name']);
            $insert_stmt->bindValue(3, date('Y-m-d H:i:s', strtotime('now')));
            $insert_stmt->bindValue(4, $_SESSION['information_array']['メールアドレス']);
            $insert_stmt->bindValue(5, $_SESSION['information_array']['お名前']);
            $insert_stmt->bindValue(6, $_SESSION['information_array']['フリガナ']);
            $insert_stmt->bindValue(7, $_SESSION['information_array']['電話番号']);
            $insert_stmt->bindValue(8, $_SESSION['information_array']['大学名']);
            $insert_stmt->bindValue(9, $_SESSION['information_array']['学部名']);
            $insert_stmt->bindValue(10, $_SESSION['information_array']['学科名']);
            $insert_stmt->bindValue(11, $_SESSION['information_array']['何年卒']);
            $insert_stmt->bindValue(12, $_SESSION['information_array']['郵便番号']);
            $insert_stmt->bindValue(13, $_SESSION['information_array']['都道府県'] . $_SESSION['information_array']['市区町村'] . $_SESSION['information_array']['町域名'] . $_SESSION['information_array']['番地など']);
            if ($applied_agent['consultation'] != NULL) {
                $insert_stmt->bindValue(14, $applied_agent['consultation']);
            } else {
                $insert_stmt->bindValue(14, 'なし');
            }
            $insert_stmt->bindValue(15, $other_agents);
            $insert_stmt->bindValue(16, date('Y-m-01 23:59:59', mktime(0, 0, 0, date('n') + 1, 1, date('Y'))));
            //同メアドからの問い合わせはじく
            $check_same_mail_stmt = $db->query("select applicant_email_address from apply_list where agent_id=" . $applied_agent['id'] . ";");
            $check_same_mail = $check_same_mail_stmt->fetchAll();
            if ($check->exists_in_multi_array($check_same_mail, 'applicant_email_address', $_SESSION['information_array']['メールアドレス']) == true) {
                //過去に同じメアドの応募がある場合
                array_push($_SESSION['already_applied'], $applied_agent['name']);
            } else {
                //初めての応募
                $insert_stmt->execute();
                //メール送信
                mb_language("ja");
                mb_internal_encoding("utf-8");
                $to_stmt = $db->query("select email_address from apply_notice_email where agent_id=" . $applied_agent['id'] . ";");
                $to = $to_stmt->fetchAll()[0]['email_address'];
                $from_stmt = $db->query("select email_address from send_notice_mail;");
                $from = $from_stmt->fetchAll()[0]['email_address'];
                $subject = "問い合わせの通知";
                $msg = $applied_agent['name'] . "さん宛てに問い合わせが来ました。\nログインして確認しましょう。\nhttp://localhost/toppage/pages/login.php";
                $header = "From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
                if (!mb_send_mail($to, $subject, $msg, $header)) {
                    echo 'メール送信失敗';
                }
                //学生にも確認メール送信
            };
            print_r('<pre>');
            var_dump($check_same_mail);
            print_r('</pre>');
        }
        $_SESSION['form_sent'] = true;
        //form送信済みにする。二重送信防止
    }
    unset($_SESSION['apply_list']);
}
//カート右上の数字0になる
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/others.css">
    <title>サンクスページ</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <section class="thanks-unit">
        <div class="thanks-texts">
            <p class="thanks-message">
                お申込みありがとうございます。送信完了いたしました!
            </p>
            お申し込みは以下のエージェントです!<br>
            <div class="thanks-agent-lists">
                <?php
                foreach ($_SESSION['consultation'] as $applied_agent) {
                    echo '<div style="text-align:center;">';
                    echo $applied_agent['name'];
                    echo '</div>';
                }
                ?>
            </div>
            <?php if (isset($_SESSION['already_applied'])) {
                echo '以下のエージェントには既にお申込み済みですので送信されませんでした<br>
            <div class="thanks-agent-lists">';
                foreach ($_SESSION['already_applied'] as $agent) {
                    echo '<div style="text-align:center;">
                    ' . $agent . '
                    </div>';
                }
                echo '</div>';
            } ?>
            申込内容の詳細は登録したメールアドレスに送信されているので、メールボックスからご確認ください<br>
            メールが届かないなど、ご不明な点等ございましたら以下のメールアドレスにご連絡ください<br>
            <?php echo $_SESSION['help_email']; ?>
        </div>
        <a class="thanks-top-back-btn" href="./index.php">
            <div>
                トップページに戻る
            </div>
        </a>
        <?php
        require "../parts/footer.php";
        unset($_SESSION['consultation']);
        unset($_SESSION['information_array']);
        unset($_SESSION['sort_order']);
        unset($_SESSION['comparison_list']);
        ?>
</body>

</html>