<div>
    <div style="display:flex;">
        <!--緑の箱。paddingつける-->
        <!--hrefの中にagent_list_paginationのパラメータ取得していれる-->
        <?php 
        if(isset($_GET["agent_list_pagination"])){
            if($_GET["agent_list_pagination"]!=1&&$_GET["agent_list_pagination"]!=NULL){
                echo '<div><a href="index.php?agent_list_pagination=1">&lt;&lt;</a></div>';//<<
                echo '<div><a href="index.php?agent_list_pagination='.$_GET["agent_list_pagination"]-1;
                echo '">&lt;</a></div>';//<
            }
        }
        ?>
        <div>
        <?php
        if(isset($_GET["agent_list_pagination"])){
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
    if(isset($_GET["agent_list_pagination"])){
        if($_GET["agent_list_pagination"]!=ceil(count($all_agents)/$agents_per_page)){
            if($_GET["agent_list_pagination"]==NULL){//最初のページかつパラメータなし
                echo '<div><a href="index.php?agent_list_pagination=2">&gt;</a></div>';//>
            }else{
                echo '<div><a href="index.php?agent_list_pagination='.$_GET["agent_list_pagination"]+1;
                echo '">&gt;</a></div>';//>
            }
            echo '<div><a href="index.php?agent_list_pagination='.ceil(count($all_agents)/$agents_per_page);
            echo '">&gt;&gt;</a></div>';//>>
        }
    }else{
        echo '<div><a href="index.php?agent_list_pagination=2">&gt;</a></div>';//>
        echo '<div><a href="index.php?agent_list_pagination='.ceil(count($all_agents)/$agents_per_page);
        echo '">&gt;&gt;</a></div>';//>>
    }
    ?>
    </div>
</div>
