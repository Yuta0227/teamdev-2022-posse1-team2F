    <!--並び替え、就活ガイド、絞り込み-->
    <div class="sort-informations">
        <!--並び替え-->
        <div class="sorts">
            <!--横並び-->
            <form class="sort-box">
                <div>
                    <select class="sort-condition">
                        <option></option>
                        <option>エージェント拠点数</option>
                        <option>内定率</option>
                        <option>内定までの最短期間</option>
                    </select>
                </div>
                <div>
                    <input  class="sort-button" type="submit" value="並び替える">
                </div>
                <button type="button" id="filter-btn" class="filter-btn">絞り込む</button>
            </form>
        </div>
        <!--絞り込み-->
        <!-- <button style="display: none;">絞り込み</button> -->
        <!--ガイド-->
        <button class="beginner-button-pc" id="openModal">どの条件で絞り込めばいいかわからない方はこちら!</button>
    </div>
    <div class="result-beginner">
    <div class="result-number">検索結果：<span>10</span>/<span>30</span>件</div><button class="beginner-button-sp" id="openModal">どの条件で絞り込めばいいか<br>わからない方はこちら!</button>
    </div><!--検索結果下の方に表示した方がいいと思った。レスポンシブの時文字数きついかも。-->