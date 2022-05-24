<div class="agent-whole-box" style="position:relative;">
    <!--エージェント一覧コンテナ-->
    <?php
    require "guide_popup.php";
    $page_number = $_GET['agent_list_pagination']; //URLからとってくる
    $agents_per_page = 6; //ページ毎に表示するエージェントの個数
    if(!isset($_SESSION['apply_list'])){
        //配列のセッション登録されてなかったら初期化
        $_SESSION['apply_list']=[];
    }
    if(!isset($_SESSION['comparison_list'])){
        //配列のセッション登録されてなかったら初期化
        $_SESSION['comparison_list']=[];
    }
    
    if ($page_number - 1 != floor(count($all_agents) / $agents_per_page)) {
        //ページ番号が最後以外
        for ($i = 0; $i < $agents_per_page; $i++) {
            echo '<form class="agent-overview-box" method="POST" action="">';
            echo '<a href="./agent_detail.php?agent_id=' . $all_agents[$i]['agent_id'] . '" target="_blank" class="agent-overview-link">';
            echo '<div>';
            echo '<div class="agent-name">' . $all_agents[$i]['agent_name'] . '</div>';
            echo '</div>';
            echo '<div style="display: flex;">';
            echo '<div class="image-box">';
            echo '<img class="agent-list-image" src="../../../img/dummy.png" alt="エージェントの画像">';
            echo '</div>';
            echo '<div class="agent-article">';
            echo '<div class="agent-short-explanation"><table>';
            //てーぶる
            echo '<tr><th>面談方式</th><th>主な取り扱い企業規模</th><th>取り扱い企業カテゴリー</th><th>内定率</th><th>内定最短期間</th><th>○○向き</th></tr>';
            echo '<tr><td>'.$all_agents[$i]['agent_meeting_type'].'</td><td>'.$all_agents[$i]['agent_main_corporate_size'].'</td><td>'.$all_agents[$i]['agent_corporate_type'].'</td><td>'.$all_agents[$i]['agent_job_offer_rate'].'</td><td>'.$all_agents[$i]['agent_shortest_period'].'</td><td>'.$all_agents[$i]['agent_recommend_student_type'].'</td></tr>';
            echo '</table></div>';
            echo '<div style="text-align: center;">';
            echo '<input name="agent_id" value="' . $all_agents[$i]['agent_id'] . '" hidden>';
            if (isset($_SESSION['apply_list'])) {
                if ($check->exists_in_array($_SESSION['apply_list'], $all_agents[$i]['agent_id']) == true) {
                    echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                } else {
                    echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                }
            } else {
                echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
            }
            if (isset($_SESSION['comparison_list'])) {
                if ($check->exists_in_array($_SESSION['comparison_list'], $all_agents[$i]['agent_id']) == true) {
                    echo '<input type="submit" name="remove_from_comparison" class="like-button" value="比較リストから削除">';
                }else{
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
    } elseif ($page_number - 1 == floor(count($all_agents) / $agents_per_page)) {
        //ページ番号が最後の場合。
        for ($i = 0; $i < count($all_agents) % $agents_per_page; $i++) {
            //余りの個数出力
            echo '<form class="agent-overview-box" method="POST" action="">';
            echo '<a href="./agent_detail.php?agent_id=' . $all_agents[$i]['agent_id'] . '" target="_blank" class="agent-overview-link">';
            echo '<div>';
            echo '<div class="agent-name">企業' . $all_agents[$i]['agent_name'] . '</div>';
            echo '</div>';
            echo '<div style="display: flex;">';
            echo '<div class="image-box">';
            echo '<img class="agent-list-image" src="../../../img/dummy.png" alt="エージェントの画像">';
            echo '</div>';
            echo '<div class="agent-article">';
            echo '<div class="agent-short-explanation"><table>';
            //テーブル
            echo '<tr><th>面談方式</th><th>主な取り扱い企業規模</th><th>取り扱い企業カテゴリー</th><th>内定率</th><th>内定最短期間</th><th>○○向き</th></tr>';
            echo '<tr><td>'.$all_agents[$i]['agent_meeting_type'].'</td><td>'.$all_agents[$i]['agent_main_corporate_size'].'</td><td>'.$all_agents[$i]['agent_corporate_type'].'</td><td>'.$all_agents[$i]['agent_job_offer_rate'].'</td><td>'.$all_agents[$i]['agent_shortest_period'].'</td><td>'.$all_agents[$i]['agent_recommend_student_type'].'</td></tr>';
            echo '</table></div>';
            echo '<div style="text-align: center;">';
            echo '<input name="agent_id" value="' . $all_agents[$i]['agent_id'] . '" hidden>';
            if (isset($_SESSION['apply_list'])) {
                if ($check->exists_in_array($_SESSION['apply_list'], $all_agents[$i]['agent_id']) == true) {
                    echo '<input type="submit" name="remove_from_apply" class="like-button" value="問い合わせリストから削除">';
                } else {
                    echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
                }
            } else {
                echo '<input type="submit" name="add_to_apply" class="like-button" value="問い合わせリストに追加">';
            }
            if (isset($_SESSION['comparison_list'])) {
                if ($check->exists_in_array($_SESSION['comparison_list'], $all_agents[$i]['agent_id']) == true) {
                    echo '<input type="submit" name="remove_from_comparison" class="like-button" value="比較リストから削除">';
                }else{
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