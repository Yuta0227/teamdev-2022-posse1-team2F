<?php
//絞り込みの流れ
// ベースとなる配列を用意する(すべてのagent_idを格納)
//これに特定の条件絞り込みがセットされていたら共通項を取り出しそれをベースとなる配列に代入する
//これをすべての種類の条件において行い最後に残ったagent_idを並び替えのwhereにforeachでいれる
$agent_id_stmt = $db->query("select agent_id from agent_public_information;");
$agent_id_array = $agent_id_stmt->fetchAll();
$base_agent_id_array = [];
foreach ($agent_id_array as $agent) {
    array_push($base_agent_id_array, $agent['agent_id']);
};
// unset($_SESSION['save_filter_condition']);
// unset($_SESSION['save_sort_condition']);
if (!isset($_SESSION['save_filter_condition'])) {
    //条件が設定されてなかったら空白
    $_SESSION['save_filter_condition'] = '';
}
if (!isset($_SESSION['save_sort_condition'])) {
    //並び替えが設定されてなかったら空白
    $_SESSION['save_sort_condition'] = '';
}
if (isset($_POST['sort'])) {
    //並び替えをしたとき
    switch ($_POST['sort']) {
            //POSTされる度に保存する
        case 'default':
            $_SESSION['save_sort_condition'] = '';
            break;
        case 'job_offer_rate':
            $_SESSION['save_sort_condition'] = ' order by agent_job_offer_rate desc ';
            break;
        case 'shortest_period':
            $_SESSION['save_sort_condition'] = ' order by agent_shortest_period ';
            break;
    }
}
if (isset($_POST['industries']) || isset($_POST['filter_prefecture']) || isset($_POST['agent_meeting_type']) || isset($_POST['agent_main_corporate_size']) || isset($_POST['agent_corporate_type']) || isset($_POST['agent_recommend_student_type'])) {

    if (isset($_POST['industries'])) {
        $_SESSION['industries'] = [];
        $industry_stmt = 'select agent_id from agent_corporate_amount where ';
        foreach ($_POST['industries'] as $industry) {
            if ($industry == $_POST['industries'][count($_POST['industries']) - 1]) {
                //最後の業界
                $industry_stmt .= $industry . '>0;';
            } else {
                $industry_stmt .= $industry . '>0 or ';
            }
            array_push($_SESSION['industries'], $industry);
        }
        // var_dump($_SESSION['industries']);
        $filter_industry_stmt = $db->query($industry_stmt);
        $filter_industry = $filter_industry_stmt->fetchAll();
        $tmp_industry_agent = [];
        foreach ($filter_industry as $agent) {
            array_push($tmp_industry_agent, $agent['agent_id']);
        }
        $base_agent_id_array = array_merge(array_intersect($base_agent_id_array, $tmp_industry_agent));
        // print_r('<pre>');
        // var_dump($base_agent_id_array);
        // print_r('</pre>');
    }
    if (isset($_POST['filter_prefecture'])) {
        //都道府県絞り込み
        $_SESSION['prefectures'] = [];
        $prefecture_stmt = 'select distinct agent_id from agent_address where ';
        foreach ($_POST['filter_prefecture'] as $prefecture_id) {
            if ($prefecture_id == $_POST['filter_prefecture'][count($_POST['filter_prefecture']) - 1]) {
                //最後の都道府県
                $prefecture_stmt .= 'prefecture_id=' . $prefecture_id . ';';
            } else {
                $prefecture_stmt .= 'prefecture_id=' . $prefecture_id . ' or ';
            }
            array_push($_SESSION['prefectures'], $prefecture_id);
        }
        // var_dump($_SESSION['prefectures']);
        $filter_prefecture_stmt = $db->query($prefecture_stmt);
        $filter_prefecture = $filter_prefecture_stmt->fetchAll();
        $tmp_prefecture_agent = [];
        foreach ($filter_prefecture as $agent) {
            array_push($tmp_prefecture_agent, $agent['agent_id']);
            //これを使って他の条件絞り込みとの共通項を出力
            //並び替えとの組み合わせは共通項の配列をforeachで回して↓の並び替え文の後にwhere agent_id =? or agent_id=?
        }
        $base_agent_id_array = array_merge(array_intersect($base_agent_id_array, $tmp_prefecture_agent));
        //共通項取得
        // print_r('<pre>都道府県');
        // var_dump($_POST['filter_prefecture']);
        // var_dump($filter_prefecture);
        // var_dump($tmp_prefecture_agent);
        // var_dump($base_agent_id_array);
        // print_r('</pre>');
    };
    $base_agent_id_array = $filter->filter('agent_meeting_type', $base_agent_id_array);
    $base_agent_id_array = $filter->filter('agent_main_corporate_size', $base_agent_id_array);
    $base_agent_id_array = $filter->filter('agent_corporate_type', $base_agent_id_array);
    $base_agent_id_array = $filter->filter('agent_recommend_student_type', $base_agent_id_array);
    //一つでも条件絞り込みされてたら保存する
    // echo count($base_agent_id_array);
    if (count($base_agent_id_array) == 0) {
        if (count($base_agent_id_array) == 0) {
            //ゼロだったら実在しないagent_idで絞る＝＞null返される
            $final_filter_stmt = ' where agent_id=-1 ';
        }
    } else {
        foreach ($base_agent_id_array as $agent) {
            if (count($base_agent_id_array) == 1) {
                //一つだったら
                $final_filter_stmt = ' where agent_id=' . $agent . ' ';
            } elseif(count($base_agent_id_array)!=1&&$agent==$base_agent_id_array[0]){
                //一つじゃないかつ最初
                $final_filter_stmt=' where agent_id='.$agent.' or ';
            }
            elseif ($agent == $base_agent_id_array[count($base_agent_id_array) - 1]) {
                //最後だったら
                $final_filter_stmt .= 'agent_id=' . $agent . ' ';
            } else {
                $final_filter_stmt .= 'agent_id=' . $agent . ' or ';
            }
        }
    }
    // echo $final_filter_stmt;
    // $final_stmt = $db->query("select * from agent_public_information" . $final_filter_stmt . ";");
    // $final = $final_stmt->fetchAll();
    // $final_stmt = $db->query("select * from agent_public_information;");
    $_SESSION['save_filter_condition'] = $final_filter_stmt;
    // var_dump($_SESSION['save_filter_condition']);
}

$_SESSION['query'] = "select * from agent_public_information" . $_SESSION['save_filter_condition'] . $_SESSION['save_sort_condition'] . ";";
// print_r('<pre>');

// print_r('</pre>');
$all_agents_stmt = $db->query($_SESSION['query']);
$all_agents = $all_agents_stmt->fetchAll();
echo $_SESSION['query'];
// if (isset($_SESSION['save_filter_condition'])) {
//過去に条件絞り込みをしていたら

    // print_r('<pre>');
    // var_dump($all_agents);
    // print_r('</pre>'); 
    // } 
    // else {
    //     //過去に条件絞り込みをしていない場合
    //             $all_agents_stmt = $db->query("select * from agent_public_information;");
    //             $all_agents = $all_agents_stmt->fetchAll();
    //             $_SESSION['all_agents'] = $all_agents;
    //             // print_r('<pre>');
    //             // var_dump($all_agents);
    //             // print_r('</pre>');

    // }
// } elseif (isset($_SESSION['sort_order'])) {
//     //過去に並び替えした場合
//     $all_agents = $_SESSION['all_agents'];
// } elseif (!isset($_POST['sort'])) {
//     $all_agents_stmt = $db->query("select * from agent_public_information;");
//     $all_agents = $all_agents_stmt->fetchAll();
//     // print_r('<pre>');
//     // var_dump($all_agents);
//     // print_r('</pre>');
// }
