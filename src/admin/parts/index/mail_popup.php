<?php
for ($agent_id = ($page_number - 1) * $agents_per_page; $agent_id < $agents_per_page * $page_number; $agent_id++) {
    if ($agent_id  <= count($agent_list_array)) {
        ${"mail_stmt" . $agent_list_array[$agent_id]['agent_id']} = $db->prepare("select * from agent_assignee_information where agent_id=?;");
        ${"mail_stmt" . $agent_list_array[$agent_id]['agent_id']}->bindValue(1, $agent_list_array[$agent_id]['agent_id']);
        ${"mail_stmt" . $agent_list_array[$agent_id]['agent_id']}->execute();
        ${"mail_data" . $agent_list_array[$agent_id]['agent_id']} = ${"mail_stmt" . $agent_list_array[$agent_id]['agent_id']}->fetchAll();
        echo '    <div id="mail_popup_filter' . $agent_list_array[$agent_id]['agent_id'] . '" hidden style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:gray;opacity:50%;"></div>';
        echo '    <form hidden action="" method="POST" id="mail_form' . $agent_list_array[$agent_id]['agent_id'] . '" class="admin-mail-popup-in-box" style="padding:10px;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;">';
        echo '<div style="display:flex;">';
        echo '    <div style="width:90%;font-weight:bold;">送信内容確認</div>    ';
        echo '    <div style="width:10%;display:flex;justify-content:right;">';
        echo '        <div id="close_mail_form' . $agent_list_array[$agent_id]['agent_id'] . '">×</div>';
        echo '    </div>';
        echo '</div>';
        $index = 0;
        foreach (${"mail_data" . $agent_list_array[$agent_id]['agent_id']} as $assignee) {
            echo '<div>';
            echo '<div>メールアドレス</div>';
            echo '<input name="address' . $index . '" value="' . $assignee['assignee_email_address'] . '"> ';
            echo '</div>';
            echo '<div>';
            echo '<div>';
            echo '    <div>特集記事をお願いするメール本文</div>';
            echo '    <textarea name="text' . $index . '" cols="30" rows="5">' . $assignee['agent_name'] . $assignee['agent_branch'] . 'の' . $assignee['assignee_name'] . 'さんへの特集記事招待メールテンプレ</textarea>';
            echo '</div>';
            $index++;
        }
        //    企業にメール送信する際担当者の情報って必要かな？
        //    企業に送るのではなく担当者に直接送るならプルダウンで選ぶ機能必要だと思う 
        echo '<input name="agent_id" value="' . $assignee['agent_id'] . '" hidden>';
        echo '<input type="submit" value="メール一斉送信">';
        echo '';
        echo '</form>';
        echo '</div>';
        echo '<script>';
    }
    if ($agent_id  <= count($agent_list_array)) {
?>
        document.getElementById('invitation_button<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').addEventListener('click', function() {
        document.getElementById('mail_popup_filter<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').removeAttribute('hidden');
        document.getElementById('mail_form<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_mail_form<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').addEventListener('click', function() {
        document.getElementById('mail_popup_filter<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').setAttribute('hidden', '');
        document.getElementById('mail_form<?php echo $agent_list_array[$agent_id]['agent_id']; ?>').setAttribute('hidden', '');
        });
<?php
        echo '</script>';
    }
}
?>