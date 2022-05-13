<?php 
for($agent_branch_id=0;$agent_branch_id<count($agent_list_array);$agent_branch_id++){
echo '    <div id="mail_popup_filter" hidden style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:gray;opacity:50%;"></div>';
echo '    <form hidden action="" method="POST" id="mail_form'.$agent_branch_id.'" style="padding:10px;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:green;">';
echo '<div style="display:flex;">';
echo '    <div style="width:90%;font-weight:bold;">送信内容確認</div>    ';
echo '    <div style="width:10%;display:flex;justify-content:right;">';
echo '        <div id="close_mail_form'.$agent_branch_id.'">×</div>';
echo '    </div>';
echo '</div>';
echo '<div>';
echo '    <div>メールアドレス</div>';
echo '    <input value="'.$agent_list_array[$agent_branch_id][4].'"> ';
echo '    </div>';
echo '<div>';
echo '<div>担当者部署</div>';
echo '    <input value="'.'担当者部署'.'"> ';
echo '</div>';
echo '<div>';
echo '    <div>担当者指名</div>';
echo '    <input value="'.'担当者指名'.'"> ';
echo '</div>';
//    企業にメール送信する際担当者の情報って必要かな？
//    企業に送るのではなく担当者に直接送るならプルダウンで選ぶ機能必要だと思う 
echo '<div>';
echo '    <div>特集記事をお願いするメール本文</div>';
echo '    <textarea cols="30" rows="5" value="'.'メール文章テンプレ'.'"></textarea>';
echo '</div>';
echo '<input type="submit" value="メール送信">';
echo '';
echo '</form>';
}
?>
<script>
    <?php 
    for($agent_branch_id=0+($page_number-1)*$agents_per_page;$agent_branch_id<$agents_per_page*$page_number;$agent_branch_id++) {
        if($agent_branch_id+1<=count($agent_list_array)){
            ?>
        document.getElementById('invitation_button<?php echo $agent_branch_id+1;?>').addEventListener('click',function(){
            document.getElementById('mail_popup_filter').removeAttribute('hidden');
            document.getElementById('mail_form<?php echo $agent_branch_id+1;?>').removeAttribute('hidden');
        });
        document.getElementById('close_mail_form<?php echo $agent_branch_id+1;?>').addEventListener('click',function(){
            document.getElementById('mail_popup_filter').setAttribute('hidden','');
            document.getElementById('mail_form<?php echo $agent_branch_id+1;?>').setAttribute('hidden',''); 
        });
        <?php }};?>
</script>