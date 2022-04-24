<section style="margin:0 50px;">
    <?php
    $agent_list_array = [
        ['サンプル企業名1', 'サンプル契約日1', 'サンプル学生人数1', 'サンプル請求額1','サンプルメールアドレス1'],
        ['サンプル企業名2', 'サンプル契約日2', 'サンプル学生人数2', 'サンプル請求額2','サンプルメールアドレス2'],
    ];
    $agent_index = 0;
    foreach ($agent_list_array as $agent) {
        echo '<div style="display:flex;background-color:blue;margin-bottom:50px;">';
        echo '    <div style="width:75%;">';
        echo '        <div>'.$agent[0].'</div>';
        echo '        <div style="padding-left:20px;">';
        echo '            <div style="padding-bottom:10px;color:gray;">契約日：'.$agent[1].'</div>';
        echo '            <div style="padding-bottom:10px;color:gray;">学生：'.$agent[2].'人登録</div>';
        echo '            <div style="padding-bottom:10px;color:gray;">今月の請求額：'.$agent[3].'円</div>';
        echo '        </div>';
        echo '    </div>';
        echo '    <div style="padding:0 10px 10px 0;width:25%;display:flex;flex-direction:column-reverse;align-items:bottom;">';
        echo '        <button id="invitation_button'.$agent_index.'" style="border-radius:10px;height:30px;color:white;background-color:lightgreen;">特集記事をお願いする</button>';
        echo '    </div>';
        echo '</div>';
        $agent_index++;
    }
    ?>
</section>