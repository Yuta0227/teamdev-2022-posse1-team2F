<div class="agent-whole-box" style="position:relative;">
    <!--エージェント一覧コンテナ-->
    <?php 
    require "guide_popup.php";
    $page_number=$_GET['agent_list_pagination'];//URLからとってくる

    $agents_per_page=6;//ページ毎に表示するエージェントの個数 

    if($page_number-1!=floor(count($all_agents)/$agents_per_page)){//ページ番号が最後以外
        for ($i = 0; $i < $agents_per_page; $i++) {
            echo '<div class="agent-overview-box">';
            echo '<a href="./agent_detail.php?agent_id='.$all_agents[$i]['agent_id'].'" target="_blank" class="agent-overview-link">';
            echo '<div>';
            echo '<div class="agent-name">'.$all_agents[$i]['agent_name'].'</div>';
            echo '<div>#理系企業#外資系企業</div>';
            echo '</div>';
            echo '<div style="display: flex;">';
            echo '<div class="image-box">';
            echo '<img class="agent-list-image" src="../../../img/dummy.png" alt="エージェントの画像">';
            echo '</div>';
            echo '<div class="agent-article">';
            echo '<div class="agent-short-explanation">各エージェントの概要説明を記入する。文章の長さにもよるけど3~4行目安</div>';
            echo '<div style="text-align: center;">';
            echo '<div class="like-button">お気に入りに追加<i class="fa-regular fa-heart like-icon"></i></div>';
            echo '</div>';
            echo '<label for="compare'.$all_agents[$i]['agent_id'].'">';
            echo '<input id="compare'.$all_agents[$i]['agent_id'].'" type="checkbox" name="" value="" method="POST">比較する';
            echo '</label>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }; 
    }elseif($page_number-1==floor(count($all_agents)/$agents_per_page)){//ページ番号が最後の場合。数字にずれたぶんある。0か1。
        for ($i = 0; $i < count($all_agents)%$agents_per_page; $i++) {//余りの個数出力
            echo '<div class="agent-overview-box">';
            echo '<a href="./agent_detail.php?agent_id='.$all_agents[$i]['agent_id'].'" target="_blank" class="agent-overview-link">';
            echo '<div>';
            echo '<div class="agent-name">企業'.$all_agents[$i]['agent_name'].'</div>';
            echo '<div>#理系企業#外資系企業</div>';
            echo '</div>';
            echo '<div style="display: flex;">';
            echo '<div class="image-box">';
            echo '<img class="agent-list-image" src="../../../img/dummy.png" alt="エージェントの画像">';
            echo '</div>';
            echo '<div class="agent-article">';
            echo '<div class="agent-short-explanation">各エージェントの概要説明を記入する。文章の長さにもよるけど3~4行目安</div>';
            echo '<div style="text-align: center;">';
            echo '<div class="like-button">お気に入りに追加<i class="fa-regular fa-heart like-icon"></i></div>';
            echo '</div>';
            echo '<input id="compare'.$all_agents[$i]['agent_id'].'" type="checkbox" name="" value="" method="POST">';
            echo '<label for="compare'.$all_agents[$i]['agent_id'].'">比較する</label>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';  
        }; 
    }
    ?>
    <div class="top-compare-over-lay">
        <span class="compare-over-lay-close-btn"><i class="fa-solid fa-xmark compare-close-btn-icon"></i></span>
        <p class="top-compare-head">
            比較企業全？件
        </p>
        <div>

        </div>
        <div class="top-compare-in-box">
            <?php  for ($i = 0; $i < 4; $i++){;?>
                <!-- <div class="top-compare-each-box-all"> -->
                    <div class="top-compare-each-box">
                        <!-- <div style="text-align: right;"> -->
                        <span class="compare-each-close-btn"><i class="fa-solid fa-xmark compare-each-close-btn-icon"></i></span>
                        <!-- </div> -->
                        <div style="display: flex;">
                        <img class="top-compare-each-img" src="../../img/dummy.png" alt="">
                        <p class="top-compare-each-name">企業名</p>
                        </div>
            </div>
            <!-- </div> -->
        <?php };?>
        </div>
        <form action="" class="top-compare-btn-box">
        <input class="top-compare-compare-btn" type="submit" value="以上の企業を比較する">
        </form>
    </div>
</div>

<script>

</script>
