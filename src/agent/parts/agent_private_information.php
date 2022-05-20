<section>
    <div style="text-align:center;">契約情報</div>
    <div style="display:flex;justify-content:center;">
        <table>
            <?php
            $private_stmt=$db->prepare("select agent_name,contract_date,start_contract_date,end_contract_date,contract_address,agent_phone_number,apply_email_address,agent_representative from agent_contract_information where agent_id=?;");
            $private_stmt->bindValue(1,$_SESSION['agent_id']);
            $private_stmt->execute();
            $agent_private_information_array=$private_stmt->fetchAll()[0];
            
            foreach ($agent_private_information_array as $column => $data) {
                $column=$translate->translate_column_to_japanese($column);
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <div style="display:flex;justify-content:center;text-align:center;">担当者情報</div>
    <div style="display:flex;flex-direction:column;justify-content:center;">
        <?php
        // print_r('<pre>');
        // var_dump($_SESSION);
        // print_r('</pre>');
        $assignee=[
            '部署'=>$_SESSION['agent_branch'],
            '名前'=>$_SESSION['assignee_name'],
            'メールアドレス'=>$_SESSION['agent_email']
        ];
        // $login_assignee_stmt=$db->prepare("");
                echo '<table style="width:70%;">';
                foreach($assignee as $column=>$data){
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">' . $column . '</th>';
                    echo '<td style="border:1px solid black;display:flex;">';
                    echo '<div>' . $data . '</div>';
                    echo '</td>';
                    echo '</tr>';
                };
                echo '</table>';
                echo '<div>';
                echo '<button id="edit">編集</button>';
                echo '</div>';
            ?>
    </div>
    <div style="text-align:center;">掲載情報変更・契約延長申請・担当者追加・削除はこちらまで<br><?php echo 'xxxx@gmail.com'; ?></div>
</section>
