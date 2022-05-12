<section style="margin:0 50px;">
    <?php
    $admin_agent_list_stmt=$db->query("select * from admin_agent_list order by agent_branch_id desc;");
    $_SESSION['admin_agent_list']=$admin_agent_list_stmt->fetchAll();
    //エージェント一覧にのせる情報をセッションに保存
    $agent_list_array = $_SESSION['admin_agent_list'];
    $agents_per_page=2;
    $pagination_parameter_set=isset($_GET['agent_list_pagination']);
    if($pagination_parameter_set){
        if($_GET['agent_list_pagination']*$agents_per_page>count($agent_list_array)){
            $page_number=count($agent_list_array)/$agents_per_page;
        }
        $page_number=$_GET['agent_list_pagination'];
    }else{
        $page_number=1;
    }
    for($agent_branch_id=0+($page_number-1)*$agents_per_page;$agent_branch_id<$agents_per_page*$page_number;$agent_branch_id++) {
        if($agent_branch_id+1<=count($agent_list_array)){
            echo '<div style="display:flex;background-color:blue;margin-bottom:50px;">';
            echo '    <div style="width:75%;">';
            echo '        <div>'.$agent_list_array[$agent_branch_id]['agent_name'].$agent_list_array[$agent_branch_id]['agent_branch'].'</div>';
            echo '        <div style="padding-left:20px;">';
            echo '            <div style="padding-bottom:10px;color:gray;">契約日：'.$agent_list_array[$agent_branch_id]['start_contract'].'</div>';
            echo '            <div style="padding-bottom:10px;color:gray;">学生：'.$agent_list_array[$agent_branch_id]['apply_amount'].'人登録</div>';
            echo '            <div style="padding-bottom:10px;color:gray;">今月の請求額：'.$agent_list_array[$agent_branch_id]['apply_amount'].'円</div>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div style="padding:0 10px 10px 0;width:30%;display:flex;flex-direction:column;align-items:bottom;">';
            echo '<div style="height:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;">';
            echo '<button id="agent'.$agent_list_array[$agent_branch_id]['agent_branch_id'].'" style="width:95%;border-radius:10px;height:30px;color:white;background-color:skyblue;">エージェント詳細を見る</button>';
            echo '</div>';
            echo '<div style="height:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;">';
            if($agent_list_array[$agent_branch_id]['featured_article_bool']==0){
                //特集記事お願い済みステータスがゼロの場合＝＝お願いしてない
                echo '        <button id="invitation_button'.($agent_branch_id+1).'" style="width:95%;border-radius:10px;height:30px;color:white;background-color:lightgreen;">特集記事をお願いする</button>';
            }else{    
                //特集記事お願い済みステータスがゼロではない場合＝＝お願い済み
                echo '        <button id="already_invited'.($agent_branch_id+1).'" style="width:95%;pointer-events:none;border-radius:10px;height:30px;color:white;background-color:red;">特集記事をお願い済み</button>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</section>
<script>
    <?php 
    for($agent_branch_id=0+($page_number-1)*$agents_per_page;$agent_branch_id<$agents_per_page*$page_number;$agent_branch_id++) {
        if($agent_branch_id+1<=count($agent_list_array)){
    ?>
    document.getElementById('agent<?php echo $agent_list_array[$agent_branch_id]['agent_branch_id'];?>').addEventListener('click',function(){
        window.location="admin_agent_detail.php?agent_branch_id=<?php echo $agent_list_array[$agent_branch_id]['agent_branch_id'];?>&year=<?php echo date('Y');?>&month=<?php echo date('m');?>";
    })
    <?php 
        }}
    ?>
</script>