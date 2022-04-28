<div class="agent-whole-box">
    <!--エージェント一覧コンテナ-->
    <?php 
    $all_agents=[1,2,3,4,5,6];//連想配列でエージェントの情報すべてが入る
    $page_number=3;//URLからとってくる

    $agents_per_page=2;//ページ毎に表示するエージェントの個数 

    if($page_number-1!=floor(count($all_agents)/$agents_per_page)){//ページ番号が最後以外
        for ($i = 0; $i < $agents_per_page; $i++) {
            echo '<div class="agent-overview-box">';
            echo '<div style="display:flex;">';
            echo '<img class="agent-list-image" src="../img/dummy.png" alt="エージェントの画像">';
            echo '<div>';
            echo '<div>企業'.$all_agents[$i].'</div>';
            echo '<div>何が入るのか忘れたからとりあえずdiv</div>';
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<div>テキスト</div>';
            echo '</div>';
            echo '</div>';
        }; 
    }elseif($page_number-1==floor(count($all_agents)/$agents_per_page)){//ページ番号が最後の場合。数字にずれたぶんある。0か1。
        for ($i = 0; $i < count($all_agents)%$agents_per_page; $i++) {//余りの個数出力
            echo '<div>';
            echo '<div style="display:flex;">';
            echo '<img class="agent-list-image" src="../img/dummy.png" alt="エージェントの画像">';
            echo '<div>';
            echo '<div>何が入るのか忘れたからとりあえずdiv</div>';
            echo '<div>何が入るのか忘れたからとりあえずdiv</div>';
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<div>テキスト</div>';
            echo '</div>';
            echo '</div>';            
        }; 
    }
    ?>
</div>