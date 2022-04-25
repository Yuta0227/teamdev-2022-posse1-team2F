<section style="margin:0 50px;">
    <?php
    $agent_list_array = [
        ['サンプル企業名1', 'サンプル契約日1', 'サンプル学生人数1', 'サンプル請求額1','サンプルメールアドレス1'],
        ['サンプル企業名2', 'サンプル契約日2', 'サンプル学生人数2', 'サンプル請求額2','サンプルメールアドレス2'],
        ['サンプル企業名3', 'サンプル契約日3', 'サンプル学生人数3', 'サンプル請求額3','サンプルメールアドレス3'],
        ['サンプル企業名4', 'サンプル契約日4', 'サンプル学生人数4', 'サンプル請求額4','サンプルメールアドレス4'],
        ['サンプル企業名5', 'サンプル契約日5', 'サンプル学生人数5', 'サンプル請求額5','サンプルメールアドレス5'],
        ['サンプル企業名6', 'サンプル契約日6', 'サンプル学生人数6', 'サンプル請求額6','サンプルメールアドレス6'],
        ['サンプル企業名7', 'サンプル契約日7', 'サンプル学生人数7', 'サンプル請求額7','サンプルメールアドレス7'],
    ];
    $agents_per_page=2;
    $pagination_paramater_set=isset($_GET['agent_list_pagination']);
    if($pagination_paramater_set){
        if($_GET['agent_list_pagination']*$agents_per_page>count($agent_list_array)){
            $page_number=count($agent_list_array)/$agents_per_page;
        }
        $page_number=$_GET['agent_list_pagination'];
    }else{
        $page_number=1;
    }
    for($agent_index=0+($page_number-1)*$agents_per_page;$agent_index<$agents_per_page*$page_number;$agent_index++) {
        if($agent_index+1<=count($agent_list_array)){
            echo '<div id="agent'.($agent_index+1).'" style="display:flex;background-color:blue;margin-bottom:50px;">';
            echo '    <div style="width:75%;">';
            echo '        <div>'.$agent_list_array[$agent_index][0].'</div>';
            echo '        <div style="padding-left:20px;">';
            echo '            <div style="padding-bottom:10px;color:gray;">契約日：'.$agent_list_array[$agent_index][1].'</div>';
            echo '            <div style="padding-bottom:10px;color:gray;">学生：'.$agent_list_array[$agent_index][2].'人登録</div>';
            echo '            <div style="padding-bottom:10px;color:gray;">今月の請求額：'.$agent_list_array[$agent_index][3].'円</div>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div style="padding:0 10px 10px 0;width:25%;display:flex;flex-direction:column-reverse;align-items:bottom;">';
            echo '        <button id="invitation_button'.($agent_index+1).'" style="border-radius:10px;height:30px;color:white;background-color:lightgreen;">特集記事をお願いする</button>';
            echo '    </div>';
            echo '</div>';
        }
    }
    ?>
</section>
<script>
    <?php 
    for($agent_index=0+($page_number-1)*$agents_per_page;$agent_index<$agents_per_page*$page_number;$agent_index++) {
        if($agent_index+1<=count($agent_list_array)){
    ?>
    document.getElementById('agent<?php echo $agent_index+1;?>').addEventListener('click',function(){
        window.location="admin_agent_detail.php?agent_index=<?php echo $agent_index+1;?>";
    })
    <?php 
        }}
    ?>
</script>