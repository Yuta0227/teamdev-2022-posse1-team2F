<section class="agent-private-information-unit">
    <div class="agent-private-information-head">契約情報</div>
    <div class="agent-private-information-table-box">
        <div class="agent-private-information-table-in-box">
        <table class="agent-private-information-table">
            <?php
            $private_stmt = $db->prepare("select agent_name,contract_date,start_contract_date,end_contract_date,contract_address,agent_phone_number,apply_email_address,agent_representative from agent_contract_information where agent_id=?;");
            $private_stmt->bindValue(1, $_SESSION['agent_id']);
            $private_stmt->execute();
            $agent_private_information_array = $private_stmt->fetchAll()[0];

            foreach ($agent_private_information_array as $column => $data) {
                $column = $translate->translate_column_to_japanese($column);
                echo '<tr>';
                echo '<th class="agent-private-information-table-text">' . $column . '</th><td class="agent-private-information-table-contents">' . $data . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        </div>
    </div>
    <div class="agent-private-information-head">担当者情報</div>
    <div class="agent-private-information-table-box">
        <div class="agent-private-information-table-in-box">
        <?php
        // print_r('<pre>');
        // var_dump($_SESSION);
        // print_r('</pre>');
        $assignee_stmt=$db->prepare("select * from agent_assignee_information where user_id=?;");
        $assignee_stmt->bindValue(1,$_SESSION['user_id']);
        $assignee_stmt->execute();
        $assignee_data=$assignee_stmt->fetchAll()[0];
        $assignee = [
            '部署' => $assignee_data['agent_branch'],
            '名前' => $assignee_data['assignee_name'],
            'メールアドレス' => $assignee_data['assignee_email_address']
        ];
        // $login_assignee_stmt=$db->prepare("");
        echo '<table class="agent-private-information-table">';
        foreach ($assignee as $column => $data) {
            echo '<tr>';
            echo '<th class="agent-private-information-table-text">' . $column . '</th>';
            echo '<td class="agent-private-information-table-contents">';
            echo '<div>' . $data . '</div>';
            echo '</td>';
            echo '</tr>';
        };
        echo '</table>';
        echo '<div class="agent-private-information-assignee-edit-btn-box">';
        echo '<button class="agent-private-information-assignee-edit-btn" id="edit">編集</button>';
        echo '</div>';
        ?>
    </div>
    </div>
    <div class="agent-private-information-adress">掲載情報変更・契約延長申請・担当者追加・削除はこちらまで<br>
        <?php 
        $help_email_stmt=$db->query("select * from help_email;");
        $help_email=$help_email_stmt->fetchAll()[0];
        echo $help_email['email']; 
        ?>
    </div>
</section>