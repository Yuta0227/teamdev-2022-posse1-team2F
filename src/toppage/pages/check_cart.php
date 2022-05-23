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
        <!-- <div class="check-cart-agent-all" id="check_cart_each_agent">
            <?php
            // $selected_agents_array = [1, 2, 3, 4, 5]; //連想か多次元。これ専用のテーブルつくるけどどの情報をひっぱるかはまだ考えていない
            // foreach ($selected_agents_array as $selected_agent) {
            //     echo '<div class="check-cart-each-agent-box">';
            //     echo '<div class="check-cart-agent-name">企業名</div>';
            //     echo '<div class="check-cart-each-agent-info-box">';
            //     echo '<div class="check-cart-agent-img-box">';
            //     echo '<img alt="企業の画像" src="../../img/dummy.png">';
            //     echo '</div>';
            //     echo '<div>';
            //     echo '<div>簡単な説明を記入</div>';
            //     echo '<div>タグ</div>';
            //     echo '</div>';
            //     echo '</div>';
            //     echo '<form class="check-cart-agent-delete-btn-box" action="" method="POST">';
            //     echo '<input name="check_agent_id" value="3" hidden>';
                //agent_idいれる
                // echo '<input name="show_delete_popup" type="submit" value="削除" class="check-cart-agent-delete-btn">';
                // echo '</form>';
                // echo '<div class="check-cart-agent-delete-btn-box">';
                // echo '<button class="check-cart-agent-delete-btn" id="check_cart_delete_btn_'.$selected_agent.'">削除</button>';
                // echo '</div>';
                // echo '</div>';
                // }; ?>
        </div>
        <div class="check-cart-next-btn-box" id="check_cart_next">
            <button class="check-cart-next-btn">
                <a href="">
                    情報を記入して上記のエージェントに申込する<br>->次のステップへ
                </a>
            </button>
        </div> -->
        <!-- <form action="" method="POST" hidden> -->
            <?php 
        if (isset($_POST['check_agent_id']) && isset($_POST['show_delete_popup'])) { ?>
            <div class="check-cart-agent-all hide" id="check_cart_each_agent">
            <?php
            $selected_agents_array = [1, 2, 3, 4, 5]; //連想か多次元。これ専用のテーブルつくるけどどの情報をひっぱるかはまだ考えていない
            foreach ($selected_agents_array as $selected_agent) {
                echo '<div class="check-cart-each-agent-box">';
                echo '<div class="check-cart-agent-name">企業名</div>';
                echo '<div class="check-cart-each-agent-info-box">';
                echo '<div class="check-cart-agent-img-box">';
                echo '<img alt="企業の画像" src="../../img/dummy.png">';
                echo '</div>';
                echo '<div>';
                echo '<div>簡単な説明を記入</div>';
                echo '<div>タグ</div>';
                echo '</div>';
                echo '</div>';
                echo '<form class="check-cart-agent-delete-btn-box" action="" method="POST">';
                echo '<input name="check_agent_id" value="3" hidden>';
                //agent_idいれる
                echo '<input name="show_delete_popup" type="submit" value="削除" class="check-cart-agent-delete-btn">';
                echo '</form>';
                // echo '<div class="check-cart-agent-delete-btn-box">';
                // echo '<button class="check-cart-agent-delete-btn" id="check_cart_delete_btn_'.$selected_agent.'">削除</button>';
                // echo '</div>';
                echo '</div>';
            }; ?>
        </div>
        <!-- echo 50~のform　hideついてない版 -->
        <form class="check-cart-delete-check-unit " action="" method="POST" id="check_cart_delete_unit">
            <!--削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく-->
            <div class="check-cart-delete-check-text">次の企業への申込をやめますか？</div>
            <div class="check-cart-delete-check-infos">
                <div class="check-cart-delete-check-img-box">
                    <img alt="企業の画像" src="../../img/dummy.png">
                </div>
                <div class="check-cart-delete-check-agent-name-box">
                    <div class="check-cart-delete-check-agent-name">企業名</div>
                </div>
            </div>
            <div class="check-cart-delete-check-choices">
                <input class="check-cart-delete-check-yes" type="submit" value="はい">
                <input class="check-cart-delete-check-no" type="submit" value="いいえ" id="check_cart_delete_no">
            </div>
        </form>
        <div class="check-cart-next-btn-box" id="check_cart_next">
            <button class="check-cart-next-btn">
                <a href="">
                    情報を記入して上記のエージェントに申込する<br>->次のステップへ
                </a>
            </button>
        </div>
        <?php } else { ?>
            <div class="check-cart-agent-all" id="check_cart_each_agent">
            <?php
            $selected_agents_array = [1, 2, 3, 4, 5]; //連想か多次元。これ専用のテーブルつくるけどどの情報をひっぱるかはまだ考えていない
            foreach ($selected_agents_array as $selected_agent) {
                echo '<div class="check-cart-each-agent-box">';
                echo '<div class="check-cart-agent-name">企業名</div>';
                echo '<div class="check-cart-each-agent-info-box">';
                echo '<div class="check-cart-agent-img-box">';
                echo '<img alt="企業の画像" src="../../img/dummy.png">';
                echo '</div>';
                echo '<div>';
                echo '<div>簡単な説明を記入</div>';
                echo '<div>タグ</div>';
                echo '</div>';
                echo '</div>';
                echo '<form class="check-cart-agent-delete-btn-box" action="" method="POST">';
                echo '<input name="check_agent_id" value="3" hidden>';
                //agent_idいれる
                echo '<input name="show_delete_popup" type="submit" value="削除" class="check-cart-agent-delete-btn">';
                echo '</form>';
                // echo '<div class="check-cart-agent-delete-btn-box">';
                // echo '<button class="check-cart-agent-delete-btn" id="check_cart_delete_btn_'.$selected_agent.'">削除</button>';
                // echo '</div>';
                echo '</div>';
            }; ?>
        </div>
        <!-- echo 50~のform hideついてる版 -->
        <form class="check-cart-delete-check-unit hide" action="" method="POST" id="check_cart_delete_unit">
            <!--削除押したらhiddenはずれて、申込企業、選択済み企業一覧、ボタンにhiddenつく-->
            <div class="check-cart-delete-check-text">次の企業への申込をやめますか？</div>
            <div class="check-cart-delete-check-infos">
                <div class="check-cart-delete-check-img-box">
                    <img alt="企業の画像" src="../../img/dummy.png">
                </div>
                <div class="check-cart-delete-check-agent-name-box">
                    <div class="check-cart-delete-check-agent-name">企業名</div>
                </div>
            </div>
            <div class="check-cart-delete-check-choices">
                <input class="check-cart-delete-check-yes" type="submit" value="はい">
                <input class="check-cart-delete-check-no" type="submit" value="いいえ" id="check_cart_delete_no">
            </div>
        </form>
        <div class="check-cart-next-btn-box" id="check_cart_next">
            <button class="check-cart-next-btn">
                <a href="./information_form.php" >
                    情報を記入して上記のエージェントに申込する<br>->次のステップへ
                </a>
            </button>
        </div>
        <?php } ?>
    </section>
    <?php require "../parts/footer.php"; ?>

        <!-- // 数字ついてない

        <?php foreach ($selected_agents_array as $selected_agent) {; ?>
            // var delete_btn = document.getElementById('check_cart_delete_btn_<?php echo $selected_agent ?>');

            //   document.getElementById("check_cart_delete_no_<?php echo $selected_agent; ?>").addEventListener('click', function() {
            document.getElementById('check_cart_delete_btn_<?php echo $selected_agent ?>').addEventListener('click', function() {
                console.log("ok");
                document.getElementById('check_cart_delete_unit').classList.remove("hide");
                document.getElementById('check_cart_each_agent').classList.add("hide");
                document.getElementById('check_cart_next').classList.add("hide");
            });
        <?php }; ?> -->

    <!-- //    delete_btn.addEventListener('click', function(){
        //       document.getElementById('check_cart_delete_unit').classList.remove("hide");
        //       document.getElementById('check_cart_each_agent').classList.add("hide");
        //       document.getElementById('check_cart_next').classList.add("hide");
        //    })

        //    function click_delete() {
        //       document.getElementById('check_cart_delete_unit').classList.add("hide");
        //       document.getElementById('check_cart_each_agent').classList.remove("hide");
        //       document.getElementById('check_cart_next').classList.remove("hide");
        //    }
        //    foreachに直す
        //    <?php for ($s = 1; $s < 6; $s++) {; ?>
        //         document.getElementById("check_cart_delete_no_<?php echo $s; ?>").addEventListener('click', function() {
        //             document.getElementById('check_cart_delete_unit').classList.add("hide");
        //       document.getElementById('check_cart_each_agent').classList.remove("hide");
        //       document.getElementById('check_cart_next').classList.remove("hide");
        //         });
        //   <?php }; ?>
        //functionのなかのunitとかもidまわさないと
        // document.getElementById('check_cart_delete_no').addEventListener('click', click_delete) -->
    <!-- </script> -->
</body>

</html>