<?php
session_start();
require "../../dbconnect.php";
if (isset($_POST['go_to_detail']) && isset($_POST['check_agent_id'])) {
    header("Location: agent_detail.php?agent_id=" . $_POST['check_agent_id']);
}
if (isset($_POST['remove_from_apply']) && isset($_POST['remove_id'])) {
    $_SESSION['apply_list'] = array_diff($_SESSION['apply_list'], array($_POST['remove_id']));
    array_values($_SESSION['apply_list']);
    //削除される
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
    <title>買い物カート</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <section class="check-cart-unit">
        <div class="check-cart-header">申込企業</div>
        <?php
        if (isset($_POST['check_agent_id']) && isset($_POST['show_delete_popup'])) {
            $agent_name_picture_stmt = $db->query("select agent_name,picture_url from picture where agent_id=" . $_POST['check_agent_id'] . ";");
            $agent_name_picture = $agent_name_picture_stmt->fetchAll()[0];
        ?>
            <form class="check-cart-delete-check-unit " action="" method="POST" id="check_cart_delete_unit">
                <!--          削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく -->
                <div class="check-cart-delete-check-text">次の企業への申込をやめますか？</div>
                <div class="check-cart-delete-check-infos">
                    <div class="check-cart-delete-check-img-box">
                        <img alt="<?php echo $agent_name_picture['agent_name']; ?>の画像" src="<?php echo "../../img/" . $agent_name_picture['picture_url']; ?>">
                    </div>
                    <div class="check-cart-delete-check-agent-name-box">
                        <div class="check-cart-delete-check-agent-name"><?php echo $agent_name_picture['agent_name']; ?></div>
                    </div>
                </div>
                <div class="check-cart-delete-check-choices">
                    <input name="remove_id" value="<?php echo $_POST['check_agent_id']; ?>" hidden>
                    <input name="remove_from_apply" class="check-cart-delete-check-yes" type="submit" value="はい">
                    <input class="check-cart-delete-check-no" type="submit" value="いいえ" id="check_cart_delete_no">
                </div>
            </form>
            <div class="check-cart-next-btn-box" id="check_cart_next">
                <button class="check-cart-next-btn">
                    <a href="information_form.php">
                        情報を記入して上記のエージェントに申込する<br>->次のステップへ
                    </a>
                </button>
            </div>
        <?php
        } else {
        ?>
            <div class="check-cart-agent-all" id="check_cart_each_agent">
                <?php
                foreach ($_SESSION['apply_list'] as $selected_agent) {
                    $agent_name_picture_stmt = $db->query("select agent_name,picture_url from picture where agent_id=" . $selected_agent . ";");
                    $agent_name_picture = $agent_name_picture_stmt->fetchAll()[0];
                    echo '<div class="check-cart-each-agent-box">';
                    echo '<div class="check-cart-each-agent-info-box">';
                    echo '<div class="check-cart-agent-img-box">';
                    echo '<img alt="' . $agent_name_picture['agent_name'] . 'の画像" src="../../img/' . $agent_name_picture['picture_url'] . '">';
                    echo '</div>';
                    echo '<div>';
                    echo '<div>' . $agent_name_picture['agent_name'] . '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<form class="check-cart-agent-delete-btn-box" action="" method="POST">';
                    echo '<input name="check_agent_id" value="' . $selected_agent . '" hidden>';
                    //agent_idいれる
                    echo '<div style="display:flex;flex-direction:column;justify-content:center;">';
                    echo '<input type="submit" style="display:block;" name="go_to_detail" value="詳細を確認する">';
                    echo '<input name="show_delete_popup" style="display:block;" type="submit" value="削除" class="check-cart-agent-delete-btn">';
                    echo '</div>';
                    echo '</form>';
                    // echo '<div class="check-cart-agent-delete-btn-box">';
                    // echo '<button class="check-cart-agent-delete-btn" id="check_cart_delete_btn_'.$selected_agent.'">削除</button>';
                    // echo '</div>';
                    echo '</div>';
                }; ?>
            </div>
            <?php
            if (count($_SESSION['apply_list']) != 0) {
                echo '<div class="check-cart-next-btn-box" id="check_cart_next">
                <button class="check-cart-next-btn">
                    <a href="./information_form.php">
                        情報を記入して上記のエージェントに申込する<br>->次のステップへ
                    </a>
                </button>
            </div>';
            } else {
                echo '<div class="check-cart-next-btn-box" id="check_cart_next">
                <button class="check-cart-next-btn" style="background-color:red;">
                    <a href="./index.php">
                        エージェントを選択して申込しましょう
                    </a>
                </button>
            </div>';
            } ?>
        <?php
        }
        ?>
    </section>
    <?php require "../parts/footer.php"; ?>
</body>

</html>