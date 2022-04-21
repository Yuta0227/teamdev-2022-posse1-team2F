<div>
    <div style="display:flex;">
        <!--緑の箱。paddingつける-->
        <!--hrefの中にspecial_list_paginationのパラメータ取得していれる-->
        <?php 
        if(isset($_GET["special_list_pagination"])){
            if($_GET["special_list_pagination"]!=1&&$_GET["special_list_pagination"]!=NULL){
                echo '<div><a href="special_list_index.php?special_list_pagination=1">&lt;&lt;</a></div>';//<<
                echo '<div><a href="special_list_index.php?special_list_pagination='.$_GET["special_list_pagination"]-1;
                echo '">&lt;</a></div>';//<
            }
        }
        ?>
        <div>
        <?php
        if(isset($_GET["special_list_pagination"])){
            if($_GET["special_list_pagination"]!=NULL){
                echo $_GET["special_list_pagination"];//真ん中の数字
            }else{
                echo 1;
            }
        }
        ?> 
    </div>
    <?php 
    if(isset($_GET["special_list_pagination"])){
        if($_GET["special_list_pagination"]!=ceil(count($special_list_array)/$specials_per_page)){
            if($_GET["special_list_pagination"]==NULL){//最初のページかつパラメータなし
                echo '<div><a href="special_list_index.php?special_list_pagination=2">&gt;</a></div>';//>
            }else{
                echo '<div><a href="special_list_index.php?special_list_pagination='.$_GET["special_list_pagination"]+1;
                echo '">&gt;</a></div>';//>
            }
            echo '<div><a href="special_list_index.php?special_list_pagination='.ceil(count($special_list_array)/$specials_per_page);
            echo '">&gt;&gt;</a></div>';//>>
        }
    }
    ?>
    </div>
</div>
