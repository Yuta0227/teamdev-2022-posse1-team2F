<section class="agent-pagenation-frame">
    <!-- $agent_list_arrayの長さが$agents_per_pageを下回った際なんかバグってる -->
  <div class="agent-pagenation-parent">
    <div class="agent-pagenation-all-box">
        <!--緑の箱。paddingつける-->
        <!--hrefの中にagent_list_paginationのパラメータ取得していれる-->
        <?php
        if (count($agent_list_array) == $agents_per_page) {
        } //エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
        elseif (isset($_GET["agent_list_pagination"])) {
            if ($_GET["agent_list_pagination"] != 1 && $_GET["agent_list_pagination"] != NULL) {
                echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=1">&lt;&lt;</a></div>'; //<<
                echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=' . $_GET["agent_list_pagination"] - 1;
                echo '">&lt;</a></div>'; //<
            }
        }
        ?>
        <div class="admin-pagenation-number">
            <?php
            if (count($agent_list_array) == $agents_per_page) {
            } //エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
            elseif (isset($_GET["agent_list_pagination"])) {
                if ($_GET["agent_list_pagination"] != NULL) {
                    echo $_GET["agent_list_pagination"]; //真ん中の数字
                } else {
                    echo 1;
                }
            } else {
                echo 1;
            }
            ?>
        </div>
        <?php
        if (count($agent_list_array) == $agents_per_page) {
        } //エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
        elseif (isset($_GET["agent_list_pagination"])) {
            if ($_GET["agent_list_pagination"] != ceil(count($agent_list_array) / $agents_per_page)) {
                if ($_GET["agent_list_pagination"] == NULL) { //最初のページかつパラメータなし
                    echo '<div class="admin-pagenation-arrow"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=2">&gt;</a></div>'; //>
                } else {
                    echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=' . $_GET["agent_list_pagination"] + 1;
                    echo '">&gt;</a></div>'; //>
                }
                echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=' . ceil(count($agent_list_array) / $agents_per_page);
                echo '">&gt;&gt;</a></div>'; //>>
            }
        } else {
            echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=2">&gt;</a></div>'; //>
            echo '<div class="admin-pagenation-number"><a class="admin-pagenation-arrow" href="index.php?agent_list_pagination=' . ceil(count($agent_list_array) / $agents_per_page);
            echo '">&gt;&gt;</a></div>'; //>>
        }
        ?>
    </div>
    </div>
</section>