<?php

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
