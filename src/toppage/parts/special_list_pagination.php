<div class="top-pagenation-unit">
<div style="margin-right:10%;" class="top-pagenation-parent">
    <div class="top-pagenation-all-box">
        <!--緑の箱。paddingつける-->
        <!--hrefの中にspecial_list_paginationのパラメータ取得していれる-->
        <?php
        if (count($special_list_array) <= $specials_per_page) {
            //特集の数と一ページに表示する記事の数が同じだったらページネーションなし
        } elseif (isset($_GET["special_list_pagination"])) {
            if ($_GET["special_list_pagination"] != 1 && $_GET["special_list_pagination"] != NULL) {
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=1">&lt;&lt;</a></div>'; //<<
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=' . $_GET["special_list_pagination"] - 1;
                echo '">&lt;</a></div>'; //<
            }
        }
        ?>
        <div class="top-pagenation-each-box">
            <?php
            if (count($special_list_array) <= $specials_per_page) {
                //特集の数と一ページに表示する記事の数が同じだったらページネーションなし
            } elseif (isset($_GET["special_list_pagination"])) {
                if ($_GET["special_list_pagination"] != NULL) {
                    echo $_GET["special_list_pagination"]; //真ん中の数字
                } else {
                    echo 1;
                }
            } else {
                echo 1;
            }
            ?>
        </div>
        <?php
        if (count($special_list_array) <= $specials_per_page) {
            //特集の数と一ページに表示する記事の数が同じだったらページネーションなし
        } elseif (isset($_GET["special_list_pagination"])) {
            if ($_GET["special_list_pagination"] != ceil(count($special_list_array) / $specials_per_page)) {
                if ($_GET["special_list_pagination"] == NULL) { //最初のページかつパラメータなし
                    echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=2">&gt;</a></div>'; //>
                } else {
                    echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=' . $_GET["special_list_pagination"] + 1;
                    echo '">&gt;</a></div>'; //>
                }
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=' . ceil(count($special_list_array) / $specials_per_page);
                echo '">&gt;&gt;</a></div>'; //>>
            }
        } else {
            echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=2">&gt;</a></div>'; //>
            echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="special_list_index.php?special_list_pagination=' . ceil(count($special_list_array) / $specials_per_page);
            echo '">&gt;&gt;</a></div>'; //>>
        }
        ?>
    </div>
</div>
</div>