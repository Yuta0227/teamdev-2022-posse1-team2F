<?php
//絞り込みの流れ
// ベースとなる配列を用意する(すべてのagent_idを格納)
//これに特定の条件絞り込みがセットされていたら共通項を取り出しそれをベースとなる配列に代入する
//これをすべての種類の条件において行い最後に残ったagent_idを並び替えのwhereにforeachでいれる
$agent_id_stmt=$db->query("select agent_id from agent_contract_information;");
$agent_id_array=$agent_id_stmt->fetchAll();
$base_agent_id_array=[];
foreach($agent_id_array as $agent){
    array_push($base_agent_id_array,$agent['agent_id']);
};
if(isset($_POST['industries'])){
    $industry_stmt='select agent_id from agent_corporate_amount where ';
    foreach($_POST['industries'] as $industry){
        if($industry==$_POST['industries'][count($_POST['industries'])-1]){
            //最後の業界
            $industry_stmt.=$industry.'>0;';
        }else{
            $industry_stmt.=$industry.'>0 or ';
        }
    }
    $filter_industry_stmt=$db->query($industry_stmt);
    $filter_industry=$filter_industry_stmt->fetchAll();
    $tmp_industry_agent=[];
    foreach($filter_industry as $agent){
        array_push($tmp_industry_agent,$agent['agent_id']);
    }
    $base_agent_id_array=array_intersect($base_agent_id_array,$tmp_industry_agent);
    print_r('<pre>');
    var_dump($base_agent_id_array);
    print_r('</pre>');
}
if(isset($_POST['filter_prefecture'])){
    //都道府県絞り込み
    $prefecture_stmt='select distinct agent_id from agent_address where ';
    foreach($_POST['filter_prefecture'] as $prefecture_id){
        if($prefecture_id==$_POST['filter_prefecture'][count($_POST['filter_prefecture'])-1]){
            //最後の都道府県
            $prefecture_stmt.='prefecture_id='.$prefecture_id.';';
        }else{
            $prefecture_stmt.='prefecture_id='.$prefecture_id.' or ';
        }
    }
    $filter_prefecture_stmt=$db->query($prefecture_stmt);
    $filter_prefecture=$filter_prefecture_stmt->fetchAll();
    $tmp_prefecture_agent=[];
    foreach($filter_prefecture as $agent){
        array_push($tmp_prefecture_agent,$agent['agent_id']);
        //これを使って他の条件絞り込みとの共通項を出力
        //並び替えとの組み合わせは共通項の配列をforeachで回して↓の並び替え文の後にwhere agent_id =? or agent_id=?
    }
    $base_agent_id_array=array_intersect($base_agent_id_array,$tmp_prefecture_agent);
    //共通項取得
    print_r('<pre>');
    // var_dump($_POST['filter_prefecture']);
    // var_dump($filter_prefecture);
    // var_dump($tmp_prefecture_agent);
    var_dump($base_agent_id_array);
    print_r('</pre>');
};
$base_agent_id_array=$filter->filter('agent_meeting_type',$base_agent_id_array);
$base_agent_id_array=$filter->filter('agent_main_corporate_size',$base_agent_id_array);
$base_agent_id_array=$filter->filter('agent_corporate_type',$base_agent_id_array);
$base_agent_id_array=$filter->filter('agent_recommend_student_type',$base_agent_id_array);
var_dump($base_agent_id_array);
if (isset($_POST['sort'])) {
    switch ($_POST['sort']) {
        case 'default':
            $all_agents_stmt = $db->query("select * from agent_public_information;");
            $all_agents = $all_agents_stmt->fetchAll();
            $_SESSION['all_agents'] = $all_agents;
            // print_r('<pre>');
            // var_dump($all_agents);
            // print_r('</pre>');
            break;
        case 'job_offer_rate':
            $all_agents_stmt = $db->query("select * from agent_public_information order by agent_job_offer_rate desc;");
            $all_agents = $all_agents_stmt->fetchAll();
            $_SESSION['all_agents'] = $all_agents;
            // print_r('<pre>');
            // var_dump($all_agents);
            // print_r('</pre>');
            break;
        case 'shortest_period':
            $all_agents_stmt = $db->query("select * from agent_public_information order by agent_shortest_period;");
            $all_agents = $all_agents_stmt->fetchAll();
            $_SESSION['all_agents'] = $all_agents;
            // print_r('<pre>');
            // var_dump($all_agents);
            // print_r('</pre>');
            break;
    }
} elseif (isset($_SESSION['sort_order'])) {
    //並び替えしたあとにページネーション移動した場合
    $all_agents = $_SESSION['all_agents'];
} elseif (!isset($_POST['sort'])) {
    $all_agents_stmt = $db->query("select * from agent_public_information;");
    $all_agents = $all_agents_stmt->fetchAll();
    // print_r('<pre>');
    // var_dump($all_agents);
    // print_r('</pre>');
}
