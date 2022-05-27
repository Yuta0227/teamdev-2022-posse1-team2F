<?php
$special_list_array_stmt=$db->query("select featured_article_id,title,agent_name,publish_date,picture from featured_article;");
$special_list_array=$special_list_array_stmt->fetchAll();
//データベースから特集記事一覧取得。新しい順で。多次元多次元連想配列
$specials_per_page = 2;
if (isset($_GET["special_list_pagination"])) {
    $specials_pagination = $_GET["special_list_pagination"];
} else {
    $specials_pagination = 1; //パラメータ未セットの時のバグの対策
}
count($special_list_array) == $specials_per_page
//この場合バグる。最後のページで表示できるものがないと発生

?>
<section class="special-list-section">
<div class="special-list-all">
    <!--sectionに変えるべきかも-->
    <!-- php for文はif。一ページにのせる数で割り切れる場合はその数をすべてのページでfor。割り切れないときは最後のページのみ余りの数分出力 -->
    <?php 
    if($specials_pagination-1!=floor(count($special_list_array)/$specials_per_page)){
        //最後のページ以外
        for ($i = 0; $i < $specials_per_page; $i++) {
            $year_month_date=explode(' ',$special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['publish_date'])[0];
            $adjust_year_month_date=explode('-',$year_month_date)[0].'年'.explode('-',$year_month_date)[1].'月'.explode('-',$year_month_date)[2].'日';
            echo '<div>';
            echo '<div class="special-list-each-box">';
            echo '<div class="special-list-img-box">';
            echo '<img class="special-list-img" src="../../img/article/'.$special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['picture'] .'" alt="'.$special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['agent_name'].'の特集記事用の画像">';
            echo '</div>';
            echo '<div class="special-list-informations">';
            echo '<a href="special_detail_index.php?featured_article_id=' . $special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['featured_article_id'] . '">';
            echo '<h1 class="special-list-information-header">';
            echo $special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['title'];
            echo '</h1>';
            echo '</a>';
            echo '<div>';
            echo $adjust_year_month_date. '投稿';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }else{
        //最後のページ
        for ($i = 0; $i < count($special_list_array)%$specials_per_page; $i++) {
            $year_month_date=explode(' ',$special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['publish_date'])[0];
            $adjust_year_month_date=explode('-',$year_month_date)[0].'年'.explode('-',$year_month_date)[1].'月'.explode('-',$year_month_date)[2].'日';
            echo '<div>';
            echo '<div class="special-list-each-box">';
            echo '<div class="special-list-img-box">';
            echo '<img class="special-list-img" src="../../img/article/' . $special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['picture'] . '" alt="'.$special_list_array[($i+1)*$specials_pagination-1]['agent_name'].'の特集記事用の画像">';
            echo '</div>';
            echo '<div class="special-list-informations">';
            echo '<a href="special_detail_index.php?featured_article_id=' . $special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['featured_article_id'] . '">';
            echo '<h1 class="special-list-information-header">';
            echo $special_list_array[$i+$specials_per_page * ($specials_pagination-1)]['title'];
            echo '</h1>';
            echo '</a>';
            echo '<div>';
            echo $adjust_year_month_date. '投稿';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

    }
    ; ?>
</div>
</section>