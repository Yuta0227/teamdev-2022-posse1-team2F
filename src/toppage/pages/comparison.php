<?php
session_start();
require "../../dbconnect.php";
if (isset($_POST['add_to_apply']) && isset($_POST['agent_id'])) {
    array_push($_SESSION['apply_list'], $_POST['agent_id']);
    header("Location:comparison.php");
    //追加押したら問い合わせリストに追加される
}
if (isset($_POST['remove_from_comparison']) && isset($_POST['agent_id'])) {
    $_SESSION['comparison_list'] = array_diff($_SESSION['comparison_list'], array($_POST['agent_id']));
    array_values($_SESSION['comparison_list']);
    header("Location:comparison.php");
    //削除押したら比較リストから削除される
}
if (isset($_POST['remove_from_apply']) && isset($_POST['agent_id'])) {
    $_SESSION['apply_list'] = array_diff($_SESSION['apply_list'], array($_POST['agent_id']));
    array_values($_SESSION['apply_list']);
    header("Location:comparison.php");
    //削除押したら問い合わせリストから削除される
}
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
    <title>比較画面</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    require "../parts/indicator.php";
    require "../../function.php";
    ?>
    <div>比較リスト選択中<?php echo count($_SESSION['comparison_list']); ?>件</div>
    <form action="" method="POST">
        <select name="comparison_condition">
            <?php
            $sort_type = [
                'agent_meeting_type' => '<option value="agent_meeting_type">面談方式</option>',
                'agent_main_corporate_size' => '<option value="agent_main_corporate_size">主な取り扱い企業規模</option>',
                'agent_corporate_type' => '<option value="agent_corporate_type">取り扱い企業カテゴリー</option>',
                'agent_job_offer_rate' => '<option value="agent_job_offer_rate">内定率</option>',
                'agent_shortest_period' => '<option value="agent_shortest_period">内定最短期間</option>',
                'agent_recommend_student_type' => '<option value="agent_recommend_student_type">○○向き</option>',
                'agent_prefecture' => '<option value="agent_prefecture">拠点地</option>',
                'total' => '<option value="total">取り扱い企業数合計</option>',
                'manufacturer' => '<option value="manufacturer">メーカー企業数</option>',
                'retail' => '<option value="retail">小売り企業数</option>',
                'service' => '<option value="service">サービス企業数</option>',
                'software_transmission' => '<option value="software_transmission">ソフトウェア・通信企業数</option>',
                'trading' => '<option value="trading">商社企業数</option>',
                'finance' => '<option value="finance">金融企業数</option>',
                'media' => '<option value="media">マスコミ企業数</option>',
                'government' => '<option value="government">官公庁・公社・団体企業数</option>',
            ];
            foreach ($sort_type as $column => $data) {
                if (isset($_POST['comparison_condition'])) {
                    if ($_POST['comparison_condition'] == $column) {
                        $sort_type = array_diff($sort_type, array($column => $data));
                        $add_set = array($sort_type, $column => $data);
                        $changed_sort_type = array_merge($add_set, $sort_type);
                    }
                }
            }
            if (isset($_POST['comparison_condition'])) {
                foreach ($changed_sort_type as $column => $data) {
                    echo $data;
                }
            } else {
                foreach ($sort_type as $column => $data) {
                    echo $data;
                }
            }
            //プルダウン選択したらそれが一番上にくる
            ?>
        </select>
        <input type="submit" value="比較項目を選択する">
    </form>
    <div style="display:flex;border-bottom:1px solid black;">
        <div style="width:25%;">画像</div>
        <div style="width:25%;">エージェント名</div>
        <div style="width:25%;">
            <?php if (isset($_POST['comparison_condition'])) {
                $japanese_condition = $translate->translate_column_to_japanese($_POST['comparison_condition']);
                echo $japanese_condition;
            } else {
                echo '面談方式';
            }; ?></div>
    </div>
    <?php
    if (!isset($_SESSION['apply_list'])) {
        //配列のセッション登録されてなかったら初期化
        $_SESSION['apply_list'] = [];
    }
    if (isset($_POST['comparison_condition'])) {
        foreach ($_SESSION['comparison_list'] as $agent) {
            ${"comparison" . $agent} = [];
            $agent_public_information_stmt = $db->query("select * from agent_public_information where agent_id=" . $agent . ";");
            $agent_public_information = $agent_public_information_stmt->fetchAll()[0];
            foreach ($agent_public_information as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                $data = $translate->translate_data_to_japanese($column, $data);
                ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array($column => $data));
                //面談方式から○○向きまで
            }
            $agent_picture_stmt = $db->query("select picture_url from picture where agent_id=" . $agent . ";");
            $agent_picture = $agent_picture_stmt->fetchAll()[0];
            ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array('画像' => $agent_picture['picture_url']));
            $agent_corporate_stmt = $db->query("select * from agent_corporate_amount where agent_id=" . $agent . ";");
            $agent_corporate = $agent_corporate_stmt->fetchAll()[0];
            $sum = 0;
            foreach ($agent_corporate as $corporate => $number) {
                $sum = $sum + $number;
                $japanese_column = $translate->translate_column_to_japanese($corporate);
                ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array($japanese_column => $number));
            }
            ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array('取り扱い企業数合計' => $sum));
            ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array('画像' => $agent_picture['picture_url']));
            $agent_address_stmt=$db->query("select agent_prefecture from agent_address where agent_id=".$agent.";");
            $agent_address=$agent_address_stmt->fetchAll();
            $prefecture_text="";
            for($index=0;$index<=count($agent_address)-1;$index++){
                if($index==count($agent_address)-1){
                    $prefecture_text.=$agent_address[$index]['agent_prefecture'];
                }else{
                    $prefecture_text.=$agent_address[$index]['agent_prefecture'].',';
                }
            }
            ${"comparison".$agent}=${"comparison".$agent}=array_merge(${"comparison".$agent},array("拠点地"=>$prefecture_text));
            echo '<form method="POST" action="" style="display:flex;">
            <div style="width:25%;"><img alt="' . ${"comparison" . $agent}['エージェント名'] . 'の画像" src="' . ${"comparison" . $agent}['画像'] . '"></div>
            <div style="width:25%;">' . ${"comparison" . $agent}['エージェント名'] . '</div>
            <div style="width:25%;">' . ${"comparison" . $agent}[$japanese_condition] . '</div>
            <div style="width:25%;">
            <input type="submit" name="remove_from_comparison" value="比較リストから削除">';
            if ($check->exists_in_array($_SESSION['apply_list'], $agent) == true) {
                echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
            } else {
                echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
            }
            echo '</div>
                <input name="agent_id" value="' . $agent . '" hidden>
                </form>';
        }
    } else {
        foreach ($_SESSION['comparison_list'] as $agent) {
            ${"comparison" . $agent} = [];
            $agent_public_information_stmt = $db->query("select * from agent_public_information where agent_id=" . $agent . ";");
            $agent_public_information = $agent_public_information_stmt->fetchAll()[0];
            foreach ($agent_public_information as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                $data = $translate->translate_data_to_japanese($column, $data);
                ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array($column => $data));
            }
            $agent_picture_stmt = $db->query("select picture_url from picture where agent_id=" . $agent . ";");
            $agent_picture = $agent_picture_stmt->fetchAll()[0];
            ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array('画像' => $agent_picture['picture_url']));
            $agent_corporate_stmt = $db->query("select * from agent_corporate_amount where agent_id=" . $agent . ";");
            $agent_corporate = $agent_corporate_stmt->fetchAll()[0];
            $sum = 0;
            foreach ($agent_corporate as $corporate => $number) {
                $sum = $sum + $number;
                $japanese_column = $translate->translate_column_to_japanese($corporate);
                ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array($japanese_column => $number));
            }
            ${"comparison" . $agent} = ${"comparison" . $agent} = array_merge(${"comparison" . $agent}, array('取り扱い企業数合計' => $sum));
            $agent_address_stmt=$db->query("select agent_prefecture from agent_address where agent_id=".$agent.";");
            $agent_address=$agent_address_stmt->fetchAll();
            $prefecture_text="";
            for($index=0;$index<=count($agent_address)-1;$index++){
                if($index==count($agent_address)-1){
                    $prefecture_text.=$agent_address[$index]['agent_prefecture'];
                }else{
                    $prefecture_text.=$agent_address[$index]['agent_prefecture'].',';
                }
            }
            ${"comparison".$agent}=${"comparison".$agent}=array_merge(${"comparison".$agent},array("拠点地"=>$prefecture_text));
            echo '<form method="POST" action="" style="display:flex;">
                    <div style="width:25%;"><img alt="' . ${"comparison" . $agent}['エージェント名'] . 'の画像" src="' . ${"comparison" . $agent}['画像'] . '"></div>
                    <div style="width:25%;">' . ${"comparison" . $agent}['エージェント名'] . '</div>
                    <div style="width:25%;">' . ${"comparison" . $agent}['面談方式'] . '</div>
                    <div style="width:25%;">
                    <input type="submit" name="remove_from_comparison" value="比較リストから削除">';
            if ($check->exists_in_array($_SESSION['apply_list'], $agent) == true) {
                echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
            } else {
                echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
            }
            echo '</div>
                    <input name="agent_id" value="' . $agent . '" hidden>
                    </form>';
        }
    }
    ?>

</body>

</html>