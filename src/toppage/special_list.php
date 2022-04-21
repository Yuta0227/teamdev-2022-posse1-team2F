<?php
$special_list_array = [
    [
        'ハッシュタグ' => [1, 2, 3],
        '投稿日' => '2022/02/27',
        'テキスト' => 'テキスト1',
        '画像' => '',
    ],
    [
        'ハッシュタグ' => [4, 5, 6],
        '投稿日' => '2022/03/26',
        'テキスト' => 'テキスト2',
        '画像' => '',
    ],
    [
        'ハッシュタグ' => [7, 8, 9],
        '投稿日' => '2022/04/25',
        'テキスト' => 'テキスト3',
        '画像' => '',
    ],
]; //データベースから特集記事一覧取得。新しい順で。多次元多次元連想配列
$specials_per_page=1;
count($special_list_array)==$specials_per_page//この場合バグる

?>
<div>
    <!--sectionに変えるべきかも-->
    <!-- php for文はif。一ページにのせる数で割り切れる場合はその数をすべてのページでfor。割り切れないときは最後のページのみ余りの数分出力 -->
    <?php for ($i = 0; $i < $specials_per_page; $i++) {
        echo '<div>';
        echo '<div>';
        echo '<img src="' . $special_list_array[($i+1)*$_GET["special_list_pagination"]-1]['画像'] . '" alt="特集記事用の画像'.($i+1)*$_GET["special_list_pagination"].'">';
        echo '</div>';
        echo '<div>';
        echo '<div style="display:flex;">';
        foreach ($special_list_array[($i+1)*$_GET["special_list_pagination"]-1]['ハッシュタグ'] as $data) {;
            echo '<div style="border:1px black solid;">#' . $data . '</div>';
        };
        echo '</div>';
        echo '<div>';
        echo $special_list_array[($i+1)*$_GET["special_list_pagination"]-1]['投稿日'];
        echo '</div>';
        echo '<div>';
        echo $special_list_array[($i+1)*$_GET["special_list_pagination"]-1]['テキスト'];
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }; ?>
</div>