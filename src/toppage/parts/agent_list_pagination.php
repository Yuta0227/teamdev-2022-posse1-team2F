<section class="top-pagenation-unit">
<div class="top-pagenation-parent">
    <div style="display:flex;" class="top-pagenation-all-box">
        <!--緑の箱。paddingつける-->
        <!--hrefの中にagent_list_paginationのパラメータ取得していれる-->
        <?php 
        if(count($all_agents)<=$agents_per_page){
        }//エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
        elseif(isset($_GET["agent_list_pagination"])){
            if($_GET["agent_list_pagination"]!=1&&$_GET["agent_list_pagination"]!=NULL){
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="index.php?agent_list_pagination=1">&lt;&lt;</a></div>';//<<
                echo '<div class="top-pagenation-each-box"><><a class="top-pagenation-arrow" href="index.php?agent_list_pagination='.$_GET["agent_list_pagination"]-1;
                echo '">&lt;</a></div>';//<
            }
        }
        ?>
        <div>
        <?php
        if(count($all_agents)<=$agents_per_page){
        }//エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
        elseif(isset($_GET["agent_list_pagination"])){
            if($_GET["agent_list_pagination"]!=NULL){
                echo $_GET["agent_list_pagination"];//真ん中の数字
            }else{
                echo 1;
            }
        }else{
            echo 1;
        }
        ?> 
    </div>
    <?php 
    if(count($all_agents)<=$agents_per_page){
    }//エージェントの数が一ページに表示するエージェントの数と同じだったらページネーション表示しない
    elseif(isset($_GET["agent_list_pagination"])){
        if($_GET["agent_list_pagination"]!=ceil(count($all_agents)/$agents_per_page)){
            if($_GET["agent_list_pagination"]==NULL){//最初のページかつパラメータなし
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="index.php?agent_list_pagination=2">&gt;</a></div>';//>
            }else{
                echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="index.php?agent_list_pagination='.$_GET["agent_list_pagination"]+1;
                echo '">&gt;</a></div>';//>
            }
            echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="index.php?agent_list_pagination='.ceil(count($all_agents)/$agents_per_page);
            echo '">&gt;&gt;</a></div>';//>>
        }
    }else{
        echo '<div class="top-pagenation-each-box"><a class="top-pagenation-arrow" href="index.php?agent_list_pagination=2">&gt;</a></div>';//>
        echo '<div class="top-pagenation-each-box"><a class="top-pagenatio-narrow" href="index.php?agent_list_pagination='.ceil(count($all_agents)/$agents_per_page);
        echo '">&gt;&gt;</a></div>';//>>
    }
    ?>
    </div>
</div>
</section>
