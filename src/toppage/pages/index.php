<?php
session_start();
require "../../dbconnect.php";
require "../parts/toppage_post.php";
require "../../function.php";

if(!isset($_GET['agent_list_pagination'])){
    header("Location:index.php?agent_list_pagination=1");
}
if(!isset($_SESSION['apply_list'])){
    $_SESSION['apply_list']=[];
}
if (isset($_POST['add_to_comparison']) && isset($_POST['agent_id'])) {
    array_push($_SESSION['comparison_list'], $_POST['agent_id']);
    //追加押したら比較リストに追加される
    header("Location:index.php?agent_list_pagination=".$_GET['agent_list_pagination']);
}
if (isset($_POST['remove_from_comparison']) && isset($_POST['agent_id'])) {
    $_SESSION['comparison_list'] = array_diff($_SESSION['comparison_list'], array($_POST['agent_id']));
    array_values($_SESSION['comparison_list']);
    header("Location:index.php?agent_list_pagination=".$_GET['agent_list_pagination']);
    //削除押したら比較リストから削除される
}
if (isset($_POST['add_to_apply']) && isset($_POST['agent_id'])) {
    array_push($_SESSION['apply_list'], $_POST['agent_id']);
    header("Location:index.php?agent_list_pagination=".$_GET['agent_list_pagination']);
    //追加押したら問い合わせリストに追加される
}
if (isset($_POST['remove_from_apply']) && isset($_POST['agent_id'])) {
    $_SESSION['apply_list'] = array_diff($_SESSION['apply_list'], array($_POST['agent_id']));
    array_values($_SESSION['apply_list']);
    header("Location:index.php?agent_list_pagination=".$_GET['agent_list_pagination']);
    //削除押したら問い合わせリストから削除される
}
if(isset($_POST['jump_to_comparison'])){
    header("Location:comparison.php");
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css?v=<?php echo date('s');?>">
</head>

<body>
<div class="topbox">
<?php require "../parts/header.php"; ?>
<?php require "../parts/indicator.php"; ?>
</div>

<div class="main-informations">
        <section class="modal-size">
            <?php require "../parts/sort_filter_guide.php"; ?>
            
            <!--場所変更の可能性大-->
            <?php require "../parts/agent_list.php"; ?>
            <?php require "../parts/guide_popup.php"; ?>
            <?php require "../parts/agent_list_pagination.php"; ?>
        </section>
    
    <div class="filter-box none" id="filter-box">
        <?php require "../parts/filter_popup.php"; ?>
    </div>
</div>



<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../../js/script.js?v=<?php echo date('s');?>"></script>

</body>
<?php require "../parts/footer.php"; ?>

</html>