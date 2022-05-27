<?php
if (isset($_POST['delete_assignee_id']) || isset($_POST['add_assignee'])) {
    echo '<div id="edit_popup_filter" style="position:absolute;width:100%;height:100%;background-color:red;top:0;left:0;opacity:50%;"></div>';
    //  ページ全体にかかるフィルターつける 
} else {
    echo '<div id="edit_popup_filter" style="position:absolute;width:100%;height:100%;background-color:red;top:0;left:0;opacity:50%;" hidden></div>';
}
?>

<form enctype="multipart/form-data" id="edit_public_information_form" style="position:absolute;background-color:white;top:50%;left:50%;transform:translate(-50%,-50%);" hidden method="post" action="">
    <div style="text-align:center;">掲載情報編集</div>
    <table>
        <?php
        foreach ($agent_public_information_array[0] as $column => $data) {
            $column = $translate->translate_column_to_japanese($column);
            //カラムを日本語に変換する
            $data = $translate->translate_data_to_japanese($column, $data);
            //データを必要に応じて数字から日本語に変換
            if ($column == '面談方式') {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">';
                if ($data == '対面のみ') {
                    echo '<label><label><input type="radio" name="' . $column . '" value="0" checked>対面のみ</label>';
                } else {
                    echo '<label><label><input type="radio" name="' . $column . '" value="0">対面のみ</label>';
                }
                if ($data == 'オンライン可') {
                    echo '<label><label><input type="radio" name="' . $column . '" value="1" checked>オンライン可</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="1">オンライン可</label>';
                }
                if ($data == 'オンラインのみ') {
                    echo '<label><input type="radio" name="' . $column . '" value="2" checked>オンラインのみ</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="2">オンラインのみ</label>';
                }
                echo '</td>';
                echo '</tr>';
            } elseif ($column == '主な取り扱い企業規模') {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">';
                if ($data == '大手') {
                    echo '<label><input type="radio" name="' . $column . '" value="0" checked>大手</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="0">大手</label>';
                }
                if ($data == '中小') {
                    echo '<label><input type="radio" name="' . $column . '" value="1" checked>中小</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="1">中小</label>';
                }
                if ($data == 'ベンチャー') {
                    echo '<label><input type="radio" name="' . $column . '" value="2" checked>ベンチャー</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="2">ベンチャー</label>';
                }
                if ($data == '総合') {
                    echo '<label><input type="radio" name="' . $column . '" value="3" checked>総合</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="3">総合</label>';
                }
                echo '</td>';
                echo '</tr>';
            } elseif ($column == '取り扱い企業カテゴリー') {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">';
                if ($data == '外資系含む') {
                    echo '<label><input type="radio" name="' . $column . '" value="0" checked>外資系含む</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="0">外資系含む</label>';
                }
                if ($data == '外資系含まない') {
                    echo '<label><input type="radio" name="' . $column . '" value="1" checked>外資系含まない</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="1">外資系含まない</label>';
                }
                echo '</td>';
                echo '</tr>';
            } elseif ($column == 'エージェント名') {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            } elseif ($column == '○○向き') {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">';
                if ($data == '理系') {
                    echo '<label><input type="radio" name="' . $column . '" value="0" checked >理系</label>';
                    echo '<label><input type="radio" name="' . $column . '" value="1">文系</label>';
                } else {
                    echo '<label><input type="radio" name="' . $column . '" value="0">理系</label>';
                    echo '<label><input type="radio" name="' . $column . '" value="1" checked>文系</label>';
                }
                echo '</td>';
                echo '</tr>';
            } else {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;"><input name="' . $column . '" value="' . $data . '"></td>';
                echo '</tr>';
            }
        }
        echo '<tr>';
        echo '<th style="border:1px solid black;">拠点地</th>';
        echo '<td style="border:1px solid black;">';
        //チェックボックス　都道府県 filter_prefectureから*とってくる。
        //連想配列でカラムをprefecture_idとする。
        //POSTではcolumnをbindValueにする
        //valueはprefecture_id
        $prefecture_stmt = $db->query("select prefecture_id,area_name,prefecture_name from filter_prefecture;");
        $prefecture_array = $prefecture_stmt->fetchAll();
        //存在する拠点地確認
        $prefecture_check_array = [];
        foreach ($agent_address as $address) {
            $prefecture_check_array += array($address['prefecture_id'] => $address['agent_prefecture']);
        }
        for ($index = 1; $index < count($prefecture_array) + 1; $index++) {
            if (isset($prefecture_check_array[$index])) {
                echo '<label><input type="checkbox" value="' . $prefecture_array[$index - 1]['prefecture_id'] . '" name="prefecture[]" checked>' . $prefecture_array[$index - 1]['prefecture_name'] . '</label>';
            } else {
                echo '<label><input type="checkbox" value="' . $prefecture_array[$index - 1]['prefecture_id'] . '" name="prefecture[]">' . $prefecture_array[$index - 1]['prefecture_name'] . '</label>';
            }
        }
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th style="border:1px solid black;">業界別取り扱い企業数</th>';
        echo '<td style="border:1px solid black;">';
        echo '<div>メーカー<input size="4" name="manufacturer" value="' . $corporate_amount[0]['manufacturer'] . '"></div>';
        echo '<div>小売り<input size="4" name="retail" value="' . $corporate_amount[0]['retail'] . '"></div>';
        echo '<div>サービス<input size="4" name="service" value="' . $corporate_amount[0]['service'] . '"></div>';
        echo '<div>ソフトウェア・通信<input size="4" name="software_transmission" value="' . $corporate_amount[0]['software_transmission'] . '"></div>';
        echo '<div>商社<input size="4" name="trading" value="' . $corporate_amount[0]['trading'] . '"></div>';
        echo '<div>金融<input size="4" name="finance" value="' . $corporate_amount[0]['finance'] . '"></div>';
        echo '<div>マスコミ<input size="4" name="media" value="' . $corporate_amount[0]['media'] . '"></div>';
        echo '<div>官公庁・公社・団体<input size="4" name="government" value="' . $corporate_amount[0]['government'] . '"></div></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th style="border:1px solid black;">キャッチコピー</th>';
        echo '<td style="border:1px solid black;">';
        echo '<input name="sales_copy" value="' . $sales_copy_data . '">';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th style="border:1px solid black;">画像</th>';
        echo '<td style="border:1px solid black;">';
        echo '<img style="width:100%;height:100%;" src="../../img/article/' . $agent_picture . '" alt="' . $agent_public_information_array[0]['agent_name'] . 'の画像">';
        echo '<input name="img_file" type="file">';
        echo '</td>';
        echo '</tr>';
        ?>
    </table>
    <div style="display:flex;">
        <div style="width:50%;display:flex;justify-content:center;">
            <div id="close_edit_public_information_form" style="border:1px solid black;border-radius:10px;">編集キャンセル</div>
        </div>
        <div style="width:50%;display:flex;justify-content:center;">
            <input style="border-radius:10px;" type="submit" value="編集確定">
        </div>
    </div>
</form>
<form id="edit_agent_explanation_form" style="position:absolute;background-color:white;top:50%;left:50%;transform:translate(-50%,-50%);" hidden method="post" action="">
    <div>エージェント説明文編集(スペースを入れるには&lt;space&gt;と記入してください</space>)</div>
    <textarea name="agent_explanation" cols="50" rows="20"><?php echo $explanation[0]['agent_explanation']; ?></textarea>
    <div style="display:flex;">
        <div style="width:50%;display:flex;justify-content:center;">
            <div id="close_edit_agent_explanation_form" style="border:1px solid black;border-radius:10px;">編集キャンセル</div>
        </div>
        <div style="width:50%;display:flex;justify-content:center;">
            <input style="border-radius:10px;" type="submit" value="編集確定">
        </div>
    </div>
</form>

<script>
    //契約情報に編集ボタンの必要性を感じなかった。担当者についてはエージェント画面で編集追加削除できるし契約情報そんな簡単に触れちゃうのよくない気がする。間違えて契約解除日いじったら取返しつかないし
    document.getElementById('edit_public_information_button').addEventListener('click', function() {
        //掲載情報の編集ボタン押したとき
        document.getElementById('edit_popup_filter').removeAttribute('hidden');
        document.getElementById('edit_public_information_form').removeAttribute('hidden');
    });
    document.getElementById('close_edit_public_information_form').addEventListener('click', function() {
        //掲載情報編集フォーム閉じるボタン
        document.getElementById('edit_popup_filter').setAttribute('hidden', '');
        document.getElementById('edit_public_information_form').setAttribute('hidden', '');
    })
    document.getElementById('edit_agent_explanation_button').addEventListener('click', function() {
        //エージェント説明文の編集ボタン押したとき
        document.getElementById('edit_popup_filter').removeAttribute('hidden');
        document.getElementById('edit_agent_explanation_form').removeAttribute('hidden');
    });
    document.getElementById('close_edit_agent_explanation_form').addEventListener('click', function() {
        //エージェント説明文フォーム閉じるボタン
        document.getElementById('edit_popup_filter').setAttribute('hidden', '');
        document.getElementById('edit_agent_explanation_form').setAttribute('hidden', '');
    })
</script>