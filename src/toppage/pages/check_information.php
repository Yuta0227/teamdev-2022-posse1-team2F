<?php
session_start();
// if (isset($_POST)) {
//     var_dump($_POST);
// }
require "../../dbconnect.php";
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
    <title>入力内容確認画面</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    require "../parts/indicator_step3.php";
    ?>
    <!-- セッションに入力内容保存してそこから引っ張ってくる -->
    <form action="thanks.php" method="POST" class="check-information-unit">
        <div class="check-information-head">入力情報確認</div>
        <div class="check-info-alert">＊送信は完了しておりません</div>
        <table class="check-info-table">
            <?php
            $information_array = [
                'お名前' => $_POST['applicant_name_kanji'],
                'フリガナ' => $_POST['applicant_name_furigana'],
                'メールアドレス' => $_POST['applicant_email_address'],
                '電話番号' => $_POST['applicant_phone_number'],
                '大学名' => $_POST['applicant_university'],
                '学部名' => $_POST['applicant_gakubu'],
                '学科名' => $_POST['applicant_gakka'],
                '何年卒' => $_POST['applicant_graduation_year'],
                '郵便番号' => $_POST['applicant_postal_code'],
                '都道府県' => $_POST['address1'],
                '市区町村' => $_POST['address2'],
                '町域名' => $_POST['address3'],
                '番地など' => $_POST['address4'],
            ];
            foreach ($information_array as $column => $data) {
                echo '<tr>';
                echo '<th class="check-info-table-text">' . $column . '</th>';
                echo '<td class="check-info-table-content">' . $data . '</td>';
                echo '</tr>';
            };
            $_SESSION['consultation']=[];
            foreach($_SESSION['id_name_set'] as $id_name_set){
                //入力フォームに戻ったとき用にセッションに保存
                $tmp_array=['name'=>$id_name_set[1],'id'=>$id_name_set[0],'consultation'=> $_POST['consultation'.$id_name_set[0]]];
                $_SESSION['consultation'][]=$tmp_array;
            }
            foreach ($_SESSION['consultation'] as $consultation) {
                echo '<tr>';
                echo '<th class="check-info-table-text">' . $consultation['name'] . 'に対する自由記入欄</th>';
                echo '<td class="check-info-table-content">' . $consultation['consultation'] . '</td>';
                echo '</tr>';
            };
            $_SESSION['information_array']=$information_array;
            //入力フォームに戻ったとき用にセッションに保存
            ?>
        </table>
        <div style="display:flex;" class="check-info-check-btns">
            <input class="check-info-back-btn" type="button" value="フォーム記入に戻る" onclick="location.href='./information_form.php'">
            <input class="check-info-ok-btn" type="submit" name="send_form" value="この内容で送る">
        </div>
    </form>
    <?php require "../parts/footer.php"; ?>
</body>

</html>