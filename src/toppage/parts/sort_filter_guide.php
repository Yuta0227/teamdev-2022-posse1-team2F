    <!--並び替え、就活ガイド、絞り込み-->
    <div class="sort-informations">
        <!--並び替え-->
        <div class="sorts">
            <!--横並び-->
            <form action="" method="POST" class="sort-box">
                <div>
                    <select name="sort" class="sort-condition">
                        <?php
                        $sort_type = [
                            '<option value="default">デフォルト</option>',
                            '<option value="job_offer_rate">内定率</option>',
                            '<option value="shortest_period">内定最短期間</option>'
                        ];
                        if (isset($_POST['sort'])) {
                            switch ($_POST['sort']) {
                                case 'default':
                                    $sort_type = array_diff($sort_type, array('<option value="default">デフォルト</option>'));
                                    array_unshift($sort_type, '<option value="default">デフォルト</option>');
                                    break;
                                case 'job_offer_rate':
                                    $sort_type = array_diff($sort_type, array('<option value="job_offer_rate">内定率</option>'));
                                    array_unshift($sort_type, '<option value="job_offer_rate">内定率</option>');
                                    break;
                                case 'shortest_period':
                                    $sort_type = array_diff($sort_type, array('<option value="shortest_period">内定最短期間</option>'));
                                    array_unshift($sort_type, '<option value="shortest_period">内定最短期間</option>');
                                    break;
                            }
                            foreach ($sort_type as $sort) {
                                echo $sort;
                            }
                         } else {
                            foreach ($sort_type as $sort) {
                                echo $sort;
                            }
                        } ?>
                    </select>
                </div>
                <div>
                    <input class="sort-button" type="submit" value="並び替える">
                </div>
            </form>
            <button type="button" id="filter-btn" class="filter-btn">絞り込む</button>
        </div>
        <!--絞り込み-->
        <button style="display: none;">絞り込み</button>
        <!--ガイド-->
        <button class="beginner-button" id="openModal">どの条件で絞り込めばいいかわからない方はこちら!</button>
    </div>
    <div class="result-number">検索結果：<span><?php echo count($all_agents);?></span>件</div>
    <!--検索結果下の方に表示した方がいいと思った。レスポンシブの時文字数きついかも。-->