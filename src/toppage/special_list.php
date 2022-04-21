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
?>
<div>
    <!--sectionに変えるべきかも-->
    <!-- php for文はif。一ページにのせる数で割り切れる場合はその数をすべてのページでfor。割り切れないときは最後のページのみ余りの数分出力 -->
    <?php for ($i = 0; $i < count($special_list_array); $i++) {
        echo '<div>';
        echo '<div>';
        echo '<img src="' . $special_list_array[$i]['画像'] . '" alt="特集記事用の画像'.($i+1).'">';
        echo '</div>';
        echo '<div>';
        echo '<div style="display:flex;">';
        foreach ($special_list_array[$i]['ハッシュタグ'] as $data) {;
            echo '<div style="border:1px black solid;">#' . $data . '</div>';
        };
        echo '</div>';
        echo '<div>';
        echo $special_list_array[$i]['投稿日'];
        echo '</div>';
        echo '<div>';
        echo $special_list_array[$i]['テキスト'];
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }; ?>
</div>