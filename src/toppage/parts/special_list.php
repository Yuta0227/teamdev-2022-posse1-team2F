<?php
$special_list_array = [
    [
        '記事タイトル' => '外資就活ドットコムに聞いた外資系エージェントの魅力',
        'ハッシュタグ' => ['理系', '外資系', '内定率が高い'],
        '投稿日' => '2022/02/27',
        'テキスト' => 'テキスト1 特集記事一覧に表示する簡単な文章を記入する ダミーテキストを追加する',
        '企業名' => '外資就活ドットコム',
        '画像' => '../../../img/dummy.png',
        'ページアドレス' => '',
    ],
    [
        '記事タイトル' => '特集記事タイトル',
        'ハッシュタグ' => [4, 5, 6],
        '投稿日' => '2022/03/26',
        'テキスト' => 'テキスト2',
        '企業名' => '外資就活ドットコム',
        '画像' => '../../../img/dummy.png',
        'ページアドレス' => '',
    ],
    [
        '記事タイトル' => '特集記事タイトル',
        'ハッシュタグ' => [7, 8, 9],
        '投稿日' => '2022/04/25',
        'テキスト' => 'テキスト3',
        '企業名' => '外資就活ドットコム',
        '画像' => '',
        'ページアドレス' => '',
    ],
]; //データベースから特集記事一覧取得。新しい順で。多次元多次元連想配列
$specials_per_page = 4;
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
        for ($i = 0; $i < $specials_per_page; $i++) {
            echo '<div>';
            echo '<a src="' . $special_list_array[($i + 1) * $specials_pagination - 1]['ページアドレス'] . '">';
            echo '<div class="special-list-each-box">';
            echo '<div class="special-list-img-box">';
            echo '<img class="special-list-img" src="' . $special_list_array[($i + 1) * $specials_pagination - 1]['画像'] . '" alt="特集記事用の画像' . ($i + 1) * $specials_pagination . '">';
            echo '</div>';
            echo '<div class="special-list-informations">';
            echo '<h1 class="special-list-information-header">';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['記事タイトル'];
            echo '</h1>';
            echo '<div class="special-list-information-tags">';
            foreach ($special_list_array[($i + 1) * $specials_pagination - 1]['ハッシュタグ'] as $data) {;
                echo '<div>#' . $data . '</div>';
            };
            echo '</div>';
            echo '<div class="special-list-information-explanation">';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['テキスト'];
            echo '</div>';
            echo '<div>';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['企業名'];
            echo '</div>';
            echo '<div>';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['投稿日'] . '投稿';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    }else{
        for ($i = 0; $i < count($special_list_array)%$specials_per_page; $i++) {
            echo '<div>';
            echo '<a src="' . $special_list_array[($i + 1) * $specials_pagination - 1]['ページアドレス'] . '">';
            echo '<div class="special-list-each-box">';
            echo '<div class="special-list-img-box">';
            echo '<img class="special-list-img" src="' . $special_list_array[($i + 1) * $specials_pagination - 1]['画像'] . '" alt="特集記事用の画像' . ($i + 1) * $specials_pagination . '">';
            echo '</div>';
            echo '<div class="special-list-informations">';
            echo '<h1 class="special-list-information-header">';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['記事タイトル'];
            echo '</h1>';
            echo '<div class="special-list-information-tags">';
            foreach ($special_list_array[($i + 1) * $specials_pagination - 1]['ハッシュタグ'] as $data) {;
                echo '<div>#' . $data . '</div>';
            };
            echo '</div>';
            echo '<div class="special-list-information-explanation">';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['テキスト'];
            echo '</div>';
            echo '<div>';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['企業名'];
            echo '</div>';
            echo '<div>';
            echo $special_list_array[($i + 1) * $specials_pagination - 1]['投稿日'] . '投稿';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }

    }
    ; ?>
</div>
</section>