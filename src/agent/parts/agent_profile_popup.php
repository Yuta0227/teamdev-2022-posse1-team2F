<section>
    <div id="popup_filter" style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:blue;opacity:50%;" hidden></div>
    <!--青のフィルター。色は適当  -->
        <!-- クリックした編集ボタンのidで表示するポップアップ変更 -->
    <?php for($assignee_id=0;$assignee_id<count($agent_assignee_array);$assignee_id++){?>
        <form action="" method="POST" id="edit_form<?php echo $assignee_id;?>" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;" hidden>
        <div id="close<?php echo $assignee_id;?>">×</div>
        <table>
        <?php 
        foreach ($agent_assignee_array[$assignee_id] as $column=>$data) {
            echo '<tr>';
            echo '<th>'.$column.'</th><td>'.$data.'</td>';
            echo '</tr>';
            //編集前情報
        }
        ?>
        </table>
        <div style="text-align:center;">↓↓</div>
        <table>
        <?php 
        foreach($agent_assignee_array[$assignee_id] as $column=>$data){
            echo '<tr>';
            echo '<th>'.$column.'</th><td><input name="'.$column.'" value="'.$data.'"></td>';
            echo '</tr>';
            //編集内容記入欄
        }
        ?>
        </table>
        <div style="display:flex;justify-content:center;">
            <input type="submit" value="編集確定">
        </div>
        </form>
        <!-- 編集ポップアップ -->
        <form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;" hidden></form>
        <!-- 削除ポップアップ -->
    <?php };?>
    <form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;" hidden></form>
    <!-- 追加ポップアップ -->
</section>
<script>
    <?php 
    for($assignee_id=0;$assignee_id<count($agent_assignee_array);$assignee_id++){?>
    function show_form(form_type,assignee_id){
        document.getElementById(form_type+assignee_id).removeAttribute('hidden');
        document.getElementById('popup_filter').removeAttribute('hidden');
        //フォームを表示する関数を担当者の人数分つくる。編集と削除は対応できる。追加はわからない
    }
    function hide_form(form_type,assignee_id){
        document.getElementById(form_type+assignee_id).setAttribute('hidden','');
        document.getElementById('popup_filter').setAttribute('hidden','');
        //フォームを消す関数を担当者の人数分つくる
    }
    document.getElementById('edit<?php echo $assignee_id;?>').addEventListener('click',function(){
        show_form('edit_form',<?php echo $assignee_id;?>);
        //編集ボタン押すと編集フォームが表示される
    });
    document.getElementById('close<?php echo $assignee_id;?>').addEventListener('click',function(){
        hide_form('edit_form',<?php echo $assignee_id;?>);
        //×押すと編集フォームが消える
    });
    <?php }?>
</script>