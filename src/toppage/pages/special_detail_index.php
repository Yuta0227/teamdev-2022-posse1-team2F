<?php
session_start();
require "../../dbconnect.php";
require "../../function.php";
$featured_article_detail_stmt = $db->query("select * from featured_article where featured_article_id=" . $_GET['featured_article_id'] . ";");
$featured_article_detail = $featured_article_detail_stmt->fetchAll()[0];

if(!isset($_SESSION['apply_list'])){
    $_SESSION['apply_list']=[];
}
if(!isset($_SESSION['comparison_list'])){
    $_SESSION['comparison_list']=[];
}
if (isset($_POST['add_to_apply']) && isset($_POST['agent_id'])) {
    array_push($_SESSION['apply_list'], $_POST['agent_id']);
    // header("Location:special_detail_index.php?featured_article_id=".$_GET['featured_article_id']);
    //追加押したら問い合わせリストに追加される
}
if (isset($_POST['remove_from_apply']) && isset($_POST['agent_id'])) {
    $_SESSION['apply_list'] = array_diff($_SESSION['apply_list'], array($_POST['agent_id']));
    array_values($_SESSION['apply_list']);
    // header("Location:special_detail_index.php?featured_article_id=".$_GET['featured_article_id']);
    //削除押したら問い合わせリストから削除される
}
if (isset($_POST['add_to_comparison']) && isset($_POST['agent_id'])) {
    array_push($_SESSION['comparison_list'], $_POST['agent_id']);
    //追加押したら比較リストに追加される
    // header("Location:special_detail_index.php?featured_article_id=" . $_GET['featured_article_id']);
}
if (isset($_POST['remove_from_comparison']) && isset($_POST['agent_id'])) {
    $_SESSION['comparison_list'] = array_diff($_SESSION['comparison_list'], array($_POST['agent_id']));
    array_values($_SESSION['comparison_list']);
    // header("Location:special_detail_index.php?featured_article_id=" . $_GET['featured_article_id']);
    //削除押したら比較リストから削除される
}
if(isset($_POST['jump_to_comparison'])){
    header("Location:comparison.php");
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
    <link rel="stylesheet" href="../../css/special.css">
    <title>特集詳細</title>
</head>

<body>
    <?php require "../parts/header.php"; ?>
    <?php require "../parts/indicator_step1.php"; ?>
    <section class="special-detail-all">
        <div class="special-detail-all-box">
            <div style="display:flex;">
                <div class="special-detail-img-box">
                    <img alt="<?php echo $featured_article_detail['agent_name']; ?>の特集記事用画像" src="../../img/article/<?php echo $featured_article_detail['picture']; ?>" class="special-detail-img">
                </div>
                <div class="special-detail-header-box">
                    <h1 class="special-detail-header"><?php echo $featured_article_detail['title']; ?></h1>
                </div>
            </div>
            <?php
            $question_answer_set = explode(';', $featured_article_detail['questions_answers']);
            $question_answer_array = [];
            foreach ($question_answer_set as $set) {
                $question_answer_array[] = explode(',', $set);
            }
            $question_answer_array[] = ['最後に一言', $featured_article_detail['last_comment']];
            // print_r('<pre>');
            // var_dump($question_answer_array);
            // print_r('</pre>');
            foreach ($question_answer_array as $question_answer) {
                echo '<div><p class="special-detail-question">Q.';
                echo $question_answer[0];
                echo '</p></div>';
                echo '<div><p class="special-detail-answer">A.';
                echo $question_answer[1];
                echo '</p></div>';
            };
            ?>
            <form action="" method="POST" style="display:flex;flex-direction:column;justify-content:center;">
                <div style="text-align:center;display:flex;justify-content:center;">
                    <input value="<?php echo $featured_article_detail['agent_id']; ?>" name="agent_id" hidden>
                    <?php if (isset($_SESSION['apply_list'])) {
                        if ($check->exists_in_array($_SESSION['apply_list'], $featured_article_detail['agent_id'])== true) {
                            echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                        } else {
                            echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                        }
                    } else {
                        echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                    }
                    if (isset($_SESSION['comparison_list'])) {
                        if ($check->exists_in_array($_SESSION['comparison_list'], $featured_article_detail['agent_id']) == true) {
                            echo '<input type="submit" name="remove_from_comparison" class="top-compare-compare-btn" value="比較リストから削除">';
                        } else {
                            echo '<input type="submit" name="add_to_comparison" class="top-compare-compare-btn" value="比較リストに追加">';
                        }
                    } else {
                        echo '<input type="submit" name="add_to_comparison" class="top-compare-compare-btn" value="比較リストに追加">';
                    }; ?>
                </div>
                <div class="special-detail-transition" style="display:flex;justify-content:center;">
                    <a href="agent_detail.php?agent_id=<?php echo $featured_article_detail['agent_id'];?>" target="_blank">企業の詳細ページへ</a>
                </div>
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
    $agent_name_picture_stmt=$db->query("select * from picture where agent_id=".$agent.";");
    $agent_name_picture=$agent_name_picture_stmt->fetchAll()[0];
    ?>
    <!-- <div class="top-compare-each-box-all"> -->
    <form action="" method="POST" class="top-compare-each-box">
        <!-- <div style="text-align: right;"> -->
        <input name="agent_id" value="<?php echo $agent; ?>" hidden>
        <input class="compare-each-close-btn" type="submit" name="remove_from_comparison" value="×">
        <!-- </div> -->
        <div class="form-img-p">
            <img class="top-compare-each-img" src="../../img/article/<?php echo $agent_name_picture['picture_url'];?>" alt="<?php echo $agent_name_picture['agent_name'].'の画像';?>">
            <p class="top-compare-each-name"><?php echo $agent_name_picture['agent_name'];?></p>
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

    <?php require "../parts/footer.php"; ?>
</body>


</html>
<script>
    // 比較リストが存在しない間はエラー出るけど問題ない。ここでissetとかやるとなぜか動かなくなる
    document.getElementById('close_comparison_popup').addEventListener('click', function() {
        document.getElementById('comparison_box').setAttribute('hidden', '');
    })
</script>