<section>
    <div id="popup_filter" class="agent-profile-popup-filter" hidden></div>
    <!--青のフィルター。色は適当  -->
    <!-- クリックした編集ボタンのidで表示するポップアップ変更 -->
        <!-- 編集ポップアップ -->
        <form action="" method="POST" id="edit_form" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;" hidden>
            <div style="display:flex;justify-content:right;">
                <div id="close_edit_form">
                ×
                </div>
            </div>
            <table class="agent-profile-popup-table">
                <?php
                foreach ($assignee as $column => $data) {
                    if($column=='メールアドレス'){
                        echo '<tr>';
                        echo '<th class="agent-profile-popup-table-text">' . $column . '</th><td>'.$data.'</td>';
                        echo '</tr>';
                    }else{
                        echo '<tr>';
                        echo '<th class="agent-profile-popup-table-text">' . $column . '</th><td><input name="' . $column . '" value="' . $data . '"></td>';
                        echo '</tr>';
                    }
                    //編集内容記入欄
                }
                ?>
            </table>
            <div style="display:flex;justify-content:center;gap:15px;">
                <div id="cancel_edit" class="agent-profile-popup-edit-cancel" style="">キャンセル</div>
                <input class="agent-profile-popup-edit-confirm" type="submit" value="編集確定">
            </div>
        </form>
</section>
<script>
        function show_form(form_type_assignee_id) {
            document.getElementById(form_type_assignee_id).removeAttribute('hidden');
            document.getElementById('popup_filter').removeAttribute('hidden');
            //フォームを表示する関数を担当者の人数分つくる。編集と削除は対応できる。追加はわからない
        }

        function hide_form(form_type_assignee_id) {
            document.getElementById(form_type_assignee_id).setAttribute('hidden', '');
            document.getElementById('popup_filter').setAttribute('hidden', '');
            //フォームを消す関数を担当者の人数分つくる
        }
        document.getElementById('edit').addEventListener('click', function() {
            show_form('edit_form');
            //編集ボタン押すと編集フォームが表示される
        });
        document.getElementById('close_edit_form').addEventListener('click', function() {
            hide_form('edit_form');
            //×押すと編集フォームが消える
        });
        document.getElementById('cancel_edit').addEventListener('click',function(){
            location.reload();
        });
</script>