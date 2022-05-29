<?php
session_start();
require "../../dbconnect.php";
require "../../function.php";
$agent_public_information_stmt = $db->query("select agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period,agent_recommend_student_type from agent_public_information where agent_id=" . $_GET['agent_id'] . ";");
$agent_public_information = $agent_public_information_stmt->fetchAll()[0];
//掲載情報
$agent_picture_stmt = $db->query("select agent_name,picture_url from picture where agent_id=" . $_GET['agent_id'] . ";");
$agent_picture = $agent_picture_stmt->fetchAll()[0];
//画像情報
$agent_address_stmt = $db->query("select agent_prefecture from agent_address where agent_id=" . $_GET['agent_id'] . ";");
$agent_address = $agent_address_stmt->fetchAll();
//拠点地情報
$agent_corporate_stmt = $db->query("select manufacturer,retail,service,software_transmission,trading,finance,media,government from agent_corporate_amount where agent_id=" . $_GET['agent_id'] . ";");
$agent_corporate = $agent_corporate_stmt->fetchAll()[0];
//キャッチコピー
$agent_sales_copy_stmt = $db->query("select sales_copy from sales_copy where agent_id=" . $_GET['agent_id'] . ";");
$agent_sales_copy = $agent_sales_copy_stmt->fetchAll()[0]['sales_copy'];
//説明文
$agent_explanation_stmt = $db->query("select agent_explanation from agent_explanation where agent_id=" . $_GET['agent_id'] . ";");
$agent_explanation = $agent_explanation_stmt->fetchAll()[0]['agent_explanation'];
// print_r('<pre>');
// var_dump($agent_explanation);
// print_r('</pre>');
if (!isset($_SESSION['apply_list'])) {
    $_SESSION['apply_list'] = [];
}
if (!isset($_SESSION['comparison_list'])) {
    $_SESSION['comparison_list'] = [];
}
if (isset($_POST['add_to_comparison']) && isset($_GET['agent_id'])) {
    array_push($_SESSION['comparison_list'], $_GET['agent_id']);
    //追加押したら比較リストに追加される
    header("Location:agent_detail.php?agent_id=" . $_GET['agent_id']);
}
if (isset($_POST['remove_from_comparison']) && isset($_GET['agent_id'])) {
    $_SESSION['comparison_list'] = array_diff($_SESSION['comparison_list'], array($_GET['agent_id']));
    array_values($_SESSION['comparison_list']);
    header("Location:agent_detail.php?agent_id=" . $_GET['agent_id']);
    //削除押したら比較リストから削除される
}
if (isset($_POST['add_to_apply']) && isset($_GET['agent_id'])) {
    array_push($_SESSION['apply_list'], $_GET['agent_id']);
    header("Location:agent_detail.php?agent_id=" . $_GET['agent_id']);
    //追加押したら問い合わせリストに追加される
}
if (isset($_POST['remove_from_apply']) && isset($_GET['agent_id'])) {
    $_SESSION['apply_list'] = array_diff($_SESSION['apply_list'], array($_GET['agent_id']));
    array_values($_SESSION['apply_list']);
    header("Location:agent_detail.php?agent_id=" . $_GET['agent_id']);
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
    <title>エージェント詳細</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    ?>
    <section class="agent-detail">
        <div class="agent-detail-box">
            <div class="agent-detail-top-box">
                <img alt="<?php echo $agent_picture['agent_name']; ?>の画像" src="../../../img/article/<?php echo $agent_picture['picture_url']; ?>">
                <div class="detail-recommend" style="width:75%;">
                    <div class="agent-detail-name" style="width:100%;">
                        <h1><?php echo $agent_picture['agent_name']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="agent-detail-table-box">
                <table class="agent-detail-table-whole">
                    <?php
                    foreach ($agent_public_information as $column => $data) {
                        $column = $translate->translate_column_to_japanese($column);
                        $data = $translate->translate_data_to_japanese($column, $data);
                        echo '<tr>';
                        echo '<th class="agent-detail-table agent-detail-table-th">' . $column . '</th>';
                        echo '<td class="agent-detail-table agent-detail-table-td">' . $data . '</td>';
                        echo '</tr>';
                    }
                    echo '<tr>';
                    echo '<th class="agent-detail-table agent-detail-table-th">拠点地</th>';
                    echo '<td class="agent-detail-table agent-detail-table-td">';
                    foreach ($agent_address as $prefecture) {
                        if ($agent_address[count($agent_address) - 1]['agent_prefecture'] == $prefecture['agent_prefecture']) {
                            //最後の場合
                            echo  $prefecture['agent_prefecture'];
                        } else {
                            echo  $prefecture['agent_prefecture'] . ',';
                        }
                    }
                    echo '</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<th class="agent-detail-table agent-detail-table-th">業界別取り扱い企業数</th>';
                    echo '<td class="agent-detail-table agent-detail-table-td">';
                    foreach ($agent_corporate as $column => $data) {
                        if ($column == 'government') {
                            //最後のgovernmentの場合
                            echo  $translate->translate_column_to_japanese($column) . '(' . $data . ')';
                        } else {
                            echo  $translate->translate_column_to_japanese($column) . '(' . $data . '),';
                        }
                    }
                    echo '</td>';
                    echo '</tr>';
                    ?>
                </table>
            </div>

            <div class="detail-feature">
                <div style="text-align:center;">
                    <h2><?php echo nl2br($agent_sales_copy); ?></h2>
                </div>
                <div>
                    <p>
                        <?php
                        //改行をnl2br,改行後のスペースをstr_replace
                        $replace = str_replace('<space>', '&emsp;', nl2br($agent_explanation));
                        echo $replace;
                        ?>
                    </p>
                </div>
            </div>
            <form style="display:flex;justify-content:center;" action="" method="POST">
                <?php
                if (isset($_SESSION['apply_list'])) {
                    if ($check->exists_in_array($_SESSION['apply_list'], $_GET['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                }
                if (isset($_SESSION['comparison_list'])) {
                    if ($check->exists_in_array($_SESSION['comparison_list'], $_GET['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_comparison" class="top-compare-compare-btn" value="比較リストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_comparison" class="top-compare-compare-btn" value="比較リストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_comparison" class="top-compare-compare-btn" value="比較リストに追加">';
                }; ?>
            </form>
            <?php
            if (isset($_SESSION['comparison_list'])) {
                if ($_SESSION['comparison_list'] != NULL) {

                    echo '
        <div id="comparison_box" class="top-compare-over-lay">
        <span id="close_comparison_popup" class="compare-over-lay-close-btn"><i class="fa-solid fa-xmark compare-close-btn-icon"></i></span>
        <p class="top-compare-head">
        比較企業全' . count($_SESSION['comparison_list']) . '件
        </p>
        <div>
        
        </div>
        <div class="top-compare-in-box">';
                }
            }
            ?>
            <?php foreach ($_SESSION['comparison_list'] as $agent) {
                $agent_name_picture_stmt = $db->query("select * from picture where agent_id=" . $agent . ";");
                $agent_name_picture = $agent_name_picture_stmt->fetchAll()[0];
            ?>
                <!-- <div class="top-compare-each-box-all"> -->
                <form action="" method="POST" class="top-compare-each-box">
                    <!-- <div style="text-align: right;"> -->
                    <input name="agent_id" value="<?php echo $agent; ?>" hidden>
                    <input class="compare-each-close-btn" type="submit" name="remove_from_comparison" value="×">
                    <!-- </div> -->
                    <div style="display: flex;">
                        <img class="top-compare-each-img" src="../../img/article/<?php echo $agent_name_picture['picture_url']; ?>" alt="<?php echo $agent_name_picture['agent_name'] . 'の画像'; ?>">
                        <p class="top-compare-each-name"><?php echo $agent_name_picture['agent_name']; ?></p>
                    </div>
                </form>
                <!-- </div> -->
            <?php }; ?>
            <?php if (isset($_SESSION['comparison_list'])) {
                if ($_SESSION['comparison_list'] != NULL) {
                    echo '
        </div>
        <form action="" method="POST" class="top-compare-btn-box">
        <input class="top-compare-compare-btn" name="jump_to_comparison" type="submit" value="以上の企業を比較する">
        </form>
        </div>
        ';
                }
            } ?>

        </div>
    </section>
</body>
<?php require "../parts/footer.php"; ?>

</html>
<script>
    // 比較リストが存在しない間はエラー出るけど問題ない。ここでissetとかやるとなぜか動かなくなる
    document.getElementById('close_comparison_popup').addEventListener('click', function() {
        document.getElementById('comparison_box').setAttribute('hidden', '');
    });
</script>