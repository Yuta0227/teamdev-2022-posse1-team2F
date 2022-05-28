<div class="agent-whole-box" style="position:relative;">
    <!--エージェント一覧コンテナ-->
    <?php
    require "guide_popup.php";
    $page_number = $_GET['agent_list_pagination']; //URLからとってくる
    $agents_per_page = 3; //ページ毎に表示するエージェントの個数
    if (!isset($_SESSION['apply_list'])) {
        //配列のセッション登録されてなかったら初期化
        $_SESSION['apply_list'] = [];
    }
    if (!isset($_SESSION['comparison_list'])) {
        //配列のセッション登録されてなかったら初期化
        $_SESSION['comparison_list'] = [];
    }
    //agents_per_page=1,1->0,2->1,3->2
    //=2,1->01,2->23
    if (count($all_agents) == 0) {
        //検索結果が0の場合
        echo '<div>検索結果が見つかりませんでした</div>';
        echo '<div>別の条件で探しましょう</div>';
    } else {
        if ($page_number - 1 != floor(count($all_agents) / $agents_per_page)) {
            //ページ番号が最後以外
            for ($i = 0; $i < $agents_per_page; $i++) {
                $agent_name_picture_stmt = $db->query("select * from picture where agent_id=" . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . ";");
                $agent_name_picture = $agent_name_picture_stmt->fetchAll()[0];
                echo '<form class="agent-overview-box" method="POST" action="">';
                echo '<a href="./agent_detail.php?agent_id=' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . '" target="_blank" class="agent-overview-link">';
                echo '<div>';
                echo '<div class="agent-name">' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_name'] . '</div>';
                echo '</div>';
                echo '<div style="display: flex;">';
                echo '<div class="image-box">';
                echo '<img class="agent-list-image" src="../../../img/article/' . $agent_name_picture['picture_url'] . '" alt="' . $agent_name_picture['agent_name'] . 'の画像">';
                echo '</div>';
                echo '<div class="agent-article">';
                echo '<div class="agent-short-explanation"><table>';
                //テーブル
                echo '<tr><th style="border:1px solid black;">面談方式</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('面談方式', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_meeting_type']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">主な取り扱い企業規模</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('主な取り扱い企業規模', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_main_corporate_size']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">取り扱い企業カテゴリー</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('取り扱い企業カテゴリー', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_corporate_type']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">内定率(%)</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('内定率(%)', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_job_offer_rate']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">内定最短期間(週)</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('内定最短期間(週)', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_shortest_period']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">○○向き</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('○○向き', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_recommend_student_type']) . '</td></tr>';
                echo '</table></div>';
                echo '<div style="text-align: center;">';
                echo '<input name="agent_id" value="' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . '" hidden>';
                if (isset($_SESSION['apply_list'])) {
                    if ($check->exists_in_array($_SESSION['apply_list'], $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                }
                if (isset($_SESSION['comparison_list'])) {
                    if ($check->exists_in_array($_SESSION['comparison_list'], $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_comparison" class="like-button" value="比較リストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_comparison" class="like-button" value="比較リストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_comparison" class="like-button" value="比較リストに追加">';
                };
                echo '</div>';
                echo '</label>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</form>';
            };
        } elseif ($page_number - 1 == floor(count($all_agents) / $agents_per_page)) {
            //ページ番号が最後の場合。
            for ($i = 0; $i < count($all_agents) % $agents_per_page; $i++) {
                $agent_name_picture_stmt = $db->query("select * from picture where agent_id=" . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . ";");
                $agent_name_picture = $agent_name_picture_stmt->fetchAll()[0];
                //余りの個数出力
                echo '<form class="agent-overview-box" method="POST" action="">';
                echo '<a href="./agent_detail.php?agent_id=' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . '" target="_blank" class="agent-overview-link">';
                echo '<div>';
                echo '<div class="agent-name">企業' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_name'] . '</div>';
                echo '</div>';
                echo '<div style="display: flex;">';
                echo '<div class="image-box">';
                echo '<img class="agent-list-image" src="../../../img/article/' . $agent_name_picture['picture_url'] . '" alt="' . $agent_name_picture['agent_name'] . 'の画像">';
                echo '</div>';
                echo '<div class="agent-article">';
                echo '<div class="agent-short-explanation"><table>';
                //テーブル
                echo '<tr><th style="border:1px solid black;">面談方式</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('面談方式', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_meeting_type']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">主な取り扱い企業規模</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('主な取り扱い企業規模', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_main_corporate_size']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">取り扱い企業カテゴリー</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('取り扱い企業カテゴリー', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_corporate_type']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">内定率(%)</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('内定率(%)', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_job_offer_rate']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">内定最短期間(週)</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('内定最短期間(週)', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_shortest_period']) . '</td></tr>';
                echo '<tr><th style="border:1px solid black;">○○向き</th><td style="border:1px solid black;">' . $translate->translate_data_to_japanese('○○向き', $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_recommend_student_type']) . '</td></tr>';
                echo '</table></div>';
                echo '<div style="text-align: center;">';
                echo '<input name="agent_id" value="' . $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id'] . '" hidden>';
                if (isset($_SESSION['apply_list'])) {
                    if ($check->exists_in_array($_SESSION['apply_list'], $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                }
                if (isset($_SESSION['comparison_list'])) {
                    if ($check->exists_in_array($_SESSION['comparison_list'], $all_agents[$agents_per_page * ($_GET['agent_list_pagination'] - 1) + $i]['agent_id']) == true) {
                        echo '<input type="submit" name="remove_from_comparison" class="like-button" value="比較リストから削除">';
                    } else {
                        echo '<input type="submit" name="add_to_comparison" class="like-button" value="比較リストに追加">';
                    }
                } else {
                    echo '<input type="submit" name="add_to_comparison" class="like-button" value="比較リストに追加">';
                };
                echo '</div>';

                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</form>';
            };
        }
    ?>
</div>
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
        }
    } ?>

<script>
    //比較リストが存在しない間はエラー出るけど問題ない。ここでissetとかやるとなぜか動かなくなる
    document.getElementById('close_comparison_popup').addEventListener('click', function() {
        document.getElementById('comparison_box').setAttribute('hidden', '');
    });
</script>