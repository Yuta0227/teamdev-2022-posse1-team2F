<section style="display:flex;flex-direction:column;justify-content:center;width:max-content;margin:0 auto;">
    <div style="display:flex;width:max-content;">
    <?php 
    $picture_stmt=$db->prepare("select picture_url,agent_name from picture where agent_id=?;");
    $picture_stmt->bindValue(1,$_GET['agent_id']);
    $picture_stmt->execute();
    $picture=$picture_stmt->fetchAll();
    ?>
        <img src="<?php echo $picture[0]['picture_url'];?>" alt="<?php echo $picture[0]['agent_name'];?>の写真">
        <div style="background-color:skyblue;"><?php echo $picture[0]['agent_name'];?></div>
    </div>
    <div style="background-color:blue;width:600px;padding:20px;">
        <div style="display:flex;justify-content:center;">契約情報</div>
        <div style="display:flex;justify-content:center;">
            <table>
                <?php
                $agent_id_stmt = $db->prepare("select agent_id from agent_contract_information where agent_id=?;");
                $agent_id_stmt->bindValue(1, $_GET['agent_id']);
                $agent_id_stmt->execute();
                $agent_id = $agent_id_stmt->fetchAll();
                //支店の属するエージェント名データベースからデータとってくる
                $agent_contract_information_stmt = $db->prepare("select agent_name,contract_date,start_contract_date,end_contract_date,contract_address,agent_phone_number,apply_email_address,agent_representative from agent_contract_information where agent_id=?;");
                $agent_contract_information_stmt->bindValue(1, $_GET['agent_id']);
                $agent_contract_information_stmt->execute();
                $contract_information_array = $agent_contract_information_stmt->fetchAll();
                //契約情報データベースからとってくる
                $agent_address_stmt = $db->prepare("select agent_prefecture,prefecture_id from agent_address where agent_id=?;");
                $agent_address_stmt->bindValue(1, $_GET['agent_id']);
                $agent_address_stmt->execute();
                $agent_address = $agent_address_stmt->fetchAll();
                //住所データベースからデータとってくる
                $recommend_student_stmt = $db->prepare("select student_type from agent_recommend_student_type where agent_id=?;");
                $recommend_student_stmt->bindValue(1, $_GET['agent_id']);
                $recommend_student_stmt->execute();
                $recommend_student = $recommend_student_stmt->fetchAll();
                //〇〇な人におすすめデータベースからデータとってくる      支店ごとではなくエージェントで共有ならwhere agent_idではなくagent_id。init.sqlもかえる
                $corporate_amount_stmt = $db->prepare("select manufacturer,retail,service,software_transmission,trading,finance,media,government from agent_corporate_amount where agent_id=?;");
                $corporate_amount_stmt->bindValue(1, $agent_id[0]['agent_id']);
                $corporate_amount_stmt->execute();
                $corporate_amount = $corporate_amount_stmt->fetchAll();
                //業界別取り扱い企業数データベースからデータとってくる
                $assignee_stmt = $db->prepare("select assignee_name,assignee_email_address,agent_branch from agent_assignee_information where agent_id=?;");
                $assignee_stmt->bindValue(1, $_GET['agent_id']);
                $assignee_stmt->execute();
                $assignee_array = $assignee_stmt->fetchAll();
                //担当者データベースからデータとってくる
                foreach ($contract_information_array[0] as $column => $data) {
                    switch ($column) {
                        case 'agent_id':
                            $column = 'エージェントID';
                            break;
                        case 'agent_name':
                            $column = 'エージェント名';
                            break;
                        case 'contract_date':
                            $column = '契約日締結日';
                            break;
                        case 'start_contract_date':
                            $column = '契約開始日';
                            break;
                        case 'end_contract_date':
                            $column = '契約終了日';
                            break;
                        case 'contract_address':
                            $column='契約住所';
                            break;
                        case 'agent_phone_number':
                            $column = '電話番号';
                            break;
                        case 'apply_email_address':
                            $column = '問い合わせ通知先メールアドレス';
                            break;
                        case 'agent_representative':
                            $column = '代表者氏名';
                            break;
                    }
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">' . $column . '</th>';
                    echo '<td style="border:1px solid black;">' . $data . '</td>';
                    echo '</tr>';
                }
                // echo '<tr>';
                // echo '<th style="border:1px solid black;">企業住所</th>';
                // echo '<td style="border:1px solid black;">' . $agent_address[0]['agent_address'] . '</td>';
                // echo '</tr>';
                ?>
            </table>
        </div>
    </div>
    <div style="background-color:blue;width:600px;padding:20px;">
        <div style="display:flex;justify-content:center;">担当者情報</div>
        <div style="display:flex;justify-content:center;">
            <table>
                <?php
                foreach ($assignee_array as $column => $data) {
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">担当者支店</th>';
                    echo '<td style="border:1px solid black;">' . $data['agent_branch'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">担当者氏名</th>';
                    echo '<td style="border:1px solid black;">' . $data['assignee_name'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">担当者メールアドレス</th>';
                    echo '<td style="border:1px solid black;">' . $data['assignee_email_address'] . '</td>';
                    echo '</tr>';
                }

                ?>
            </table>
        </div>
    </div>

    <form style="background-color:blue;width:600px;padding:20px;">
        <div style="display:flex;justify-content:center;">掲載情報</div>
        <div style="display:flex;justify-content:center;">
            <table>
                <?php
                $agent_public_information_stmt = $db->prepare("select agent_name,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period from agent_public_information where agent_id=?;");
                $agent_public_information_stmt->bindValue(1, $_GET['agent_id']);
                $agent_public_information_stmt->execute();
                $agent_public_information_array = $agent_public_information_stmt->fetchAll();
                foreach ($agent_public_information_array[0] as $column => $data) {
                    $column = $translate->translate_column_to_japanese($column);
                    //カラムを日本語に変換する
                    $data = $translate->translate_data_to_japanese($column, $data);
                    //データを必要に応じて数字から日本語に変換
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">' . $column . '</th>';
                    echo '<td style="border:1px solid black;">' . $data . '</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<th style="border:1px solid black;">拠点地</th>';
                echo '<td style="border:1px solid black;">';
                $count=1;
                foreach($agent_address as $address){
                    if($count==count($agent_address)){
                        echo $address['agent_prefecture'];
                    }else{
                        echo $address['agent_prefecture'].',';
                    }
                    $count++;
                }
                echo '</td>';
                echo '</tr>';
                $count = 1;
                echo '<tr>';
                echo '<th style="border:1px solid black;">〇〇な人におすすめ</th>';
                echo '<td style="border:1px solid black;">';
                foreach ($recommend_student as $data) {
                    if($count==count($recommend_student)){
                        echo $data["student_type"];
                    }else{
                        echo $data["student_type"].',';
                    }
                    $count++;
                }
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th style="border:1px solid black;">業界別取り扱い企業数</th>';
                echo '<td style="border:1px solid black;">メーカー(' . $corporate_amount[0]['manufacturer'] . ')、小売り(' . $corporate_amount[0]['retail'] . ')、サービス(' . $corporate_amount[0]['service'] . ')、ソフトウェア・通信(' . $corporate_amount[0]['software_transmission'] . ')、商社(' . $corporate_amount[0]['trading'] . ')、金融(' . $corporate_amount[0]['finance'] . ')、マスコミ(' . $corporate_amount[0]['media'] . ')、官公庁・公社・団体(' . $corporate_amount[0]['government'] . ')</td>';
                echo '</tr>';
                ?>
            </table>
        </div>
        <div style="display:flex;justify-content:right;">
            <div style="border:1px solid black;padding:5px;border-radius:10px;background-color:skyblue;" id="edit_public_information_button">編集</div>
        </div>
    </form>
    <form style="background-color:blue;width:600px;padding:20px;">
        <div style="display:flex;justify-content:center;">エージェント説明文</div>
        <div style="height:200px;width:400px;background-color:white;">
            <?php 
            $explanation_stmt=$db->prepare("select agent_explanation from agent_explanation where agent_id=?;");
            $explanation_stmt->bindValue(1,$_GET['agent_id']);
            $explanation_stmt->execute();
            $explanation=$explanation_stmt->fetchAll();
            echo nl2br($explanation[0]['agent_explanation']);
            //改行などは;とexplodeなどをつかって対策する。登録のときに工夫してもらう
            ?>
        </div>
        <div style="display:flex;justify-content:right;">
            <div style="border:1px solid black;padding:5px;border-radius:10px;background-color:skyblue;" id="edit_agent_explanation_button">編集</div>
        </div>
    </form>
</section>