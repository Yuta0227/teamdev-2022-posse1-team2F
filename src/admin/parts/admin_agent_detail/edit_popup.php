<div id="edit_popup_filter" style="position:absolute;width:100%;height:100%;background-color:red;top:0;left:0;opacity:50%;" hidden>
    <!-- ページ全体にかかるフィルターつける -->
</div>
<form id="edit_public_information_form" style="position:absolute;background-color:white;top:50%;left:50%;transform:translate(-50%,-50%);" hidden method="post" action="">
    <div style="text-align:center;">掲載情報編集</div>
    <table>
        <?php
        $public_information_array = [
            '取り扱い企業数' => '企業数サンプル',
            '住所' => '住所サンプル',
            '特色' => '特色サンプル',
            '就活方式' => '就活方式サンプル',
            'おすすめする学生の特徴' => 'おすすめサンプル',
        ];
        foreach ($public_information_array as $column => $data) {
            echo '<tr>';
            echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;"><input name="'.$column.'" value="'.$data.'"></td>';
            echo '</tr>';
        }
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
    <div>エージェント説明文編集</div>
    <textarea name="エージェント説明文" cols="50" rows="20"><?php echo 'テキストデータベースから取得';?></textarea>
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