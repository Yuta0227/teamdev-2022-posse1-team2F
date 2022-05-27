<section class="admin-agent-detail-table-unit">
    <div class="admin-agent-detail-table-head-box">
        <?php
        $picture_stmt = $db->prepare("select picture_url,agent_name from picture where agent_id=?;");
        $picture_stmt->bindValue(1, $_GET['agent_id']);
        $picture_stmt->execute();
        $picture = $picture_stmt->fetchAll();
        ?>
        <div class="admin-agent-detail-table-img-box">
            <img class="admin-agent-detail-table-img" src="../../../img/article/<?php echo $picture[0]['picture_url']; ?>" alt="<?php echo $picture[0]['agent_name']; ?>の写真">
        </div>
        <div class="admin-agent-detail-table-agent-name"><?php echo $picture[0]['agent_name']; ?></div>
    </div>
    <div class="admin-agent-detail-contract-table-box-all">
        <div class="admin-agent-detail-contract-table-head">契約情報</div>
        <div class="admin-agent-detail-contract-table-box">
            <table class="admin-agent-detail-contract-table">
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
                $agent_address_stmt = $db->prepare("select distinct agent_prefecture,prefecture_id from agent_address where agent_id=?;");
                $agent_address_stmt->bindValue(1, $_GET['agent_id']);
                $agent_address_stmt->execute();
                $agent_address = $agent_address_stmt->fetchAll();
                //住所データベースからデータとってくる
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
                            $column = '契約住所';
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
                    echo '<th class="admin-agent-detail-table-text">' . $column . '</th>';
                    echo '<td class="admin-agent-detail-table-content">' . $data . '</td>';
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


    <form class="admin-agent-detail-public-all-box">
        <div class="admin-agent-detail-public-table-name">掲載情報</div>
        <div class="admin-agent-detail-public-table-box">
            <table class="admin-agent-detail-public-table">
                <?php
                $agent_public_information_stmt = $db->prepare("select agent_name,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period,agent_recommend_student_type from agent_public_information where agent_id=?;");
                $agent_public_information_stmt->bindValue(1, $_GET['agent_id']);
                $agent_public_information_stmt->execute();
                $agent_public_information_array = $agent_public_information_stmt->fetchAll();
                foreach ($agent_public_information_array[0] as $column => $data) {
                    $column = $translate->translate_column_to_japanese($column);
                    //カラムを日本語に変換する
                    $data = $translate->translate_data_to_japanese($column, $data);
                    //データを必要に応じて数字から日本語に変換
                    echo '<tr>';
                    echo '<th class="admin-agent-detail-table-text">' . $column . '</th>';
                    echo '<td class="admin-agent-detail-table-content">' . $data . '</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<th class="admin-agent-detail-table-text">拠点地</th>';
                echo '<td class="admin-agent-detail-table-content">';
                $count = 1;
                foreach ($agent_address as $address) {
                    if ($count == count($agent_address)) {
                        echo $address['agent_prefecture'];
                    } else {
                        echo $address['agent_prefecture'] . ',';
                    }
                    $count++;
                }
                echo '</td>';
                echo '</tr>';
                $sales_copy_stmt = $db->prepare("select sales_copy from sales_copy where agent_id=?;");
                $sales_copy_stmt->bindValue(1, $_GET['agent_id']);
                $sales_copy_stmt->execute();
                $sales_copy_data = $sales_copy_stmt->fetchAll()[0]['sales_copy'];
                echo '<tr>';
                echo '<th class="admin-agent-detail-table-text">キャッチコピー</th>';
                echo '<td class="admin-agent-detail-table-content">' . $sales_copy_data . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th class="admin-agent-detail-table-text">業界別取り扱い企業数</th>';
                echo '<td class="admin-agent-detail-table-content">';
                $index = 0;
                foreach ($corporate_amount[0] as $column => $data) {
                    $column = $translate->translate_column_to_japanese($column);
                    if ($index == count($corporate_amount) - 1) {
                        echo $column . '(' . $data . ')';
                    } else {
                        echo $column . '(' . $data . '),';
                    }
                    $index++;
                }
                echo '</td>';
                echo '</tr>';
                $agent_picture_stmt = $db->query("select picture_url from picture where agent_id=" . $_GET['agent_id'] . ";");
                $agent_picture = $agent_picture_stmt->fetchAll()[0]['picture_url'];
                echo '<tr>';
                echo '<th style="border:1px solid black;">画像</th>';
                echo '<td style="border:1px solid black;"><img style="width:100%;height:100%;" src="../../img/article/' . $agent_picture . '" alt="' . $agent_public_information_array[0]['agent_name'] . 'の画像"></td>';
                echo '</tr>';
                ?>
            </table>
        </div>
        <div class="admin-agent-detail-table-public-edit-btn-box">
            <div class="admin-agent-detail-table-public-edit-btn" id="edit_public_information_button">編集</div>
        </div>
    </form>
    <form class="admin-agent-detail-explain-all-box">
        <div class="admin-agent-detail-explain-name" style="display:flex;justify-content:center;">エージェント説明文</div>
        <div class="admin-agent-detail-explain-text">
            <?php
            $explanation_stmt = $db->prepare("select agent_explanation from agent_explanation where agent_id=?;");
            $explanation_stmt->bindValue(1, $_GET['agent_id']);
            $explanation_stmt->execute();
            $explanation = $explanation_stmt->fetchAll();
            echo nl2br($explanation[0]['agent_explanation']);
            //改行などは;とexplodeなどをつかって対策する。登録のときに工夫してもらう
            ?>
        </div>
        <div class="admin-agent-detail-explain-edit-btn-box">
            <div class="admin-agent-detail-explain-edit-btn" id="edit_agent_explanation_button">編集</div>
        </div>
    </form>
    <div class="admin-agent-detail-person-all">
        <div class="admin-agent-detail-person-head">担当者情報</div>
        <div style="display:flex;flex-direction:column;justify-content:center;">
            <?php
            $assignee_stmt = $db->prepare("select * from agent_assignee_information where agent_id=?;");
            $assignee_stmt->bindValue(1, $_GET['agent_id']);
            $assignee_stmt->execute();
            $assignee = $assignee_stmt->fetchAll();
            $assignee_password_array = [];
            $assignee_total_array = [];
            $index = 0;
            foreach ($assignee as $data) {
                $assignee_password_stmt = $db->prepare("select AES_DECRYPT(`user_password`,'ENCRYPT-KEY') from agent_users where user_id=?;");
                $assignee_password_stmt->bindValue(1, $data['user_id']);
                $assignee_password_stmt->execute();
                $assignee_password_data = $assignee_password_stmt->fetchAll()[0];
                array_push($assignee_password_array, $assignee_password_data["AES_DECRYPT(`user_password`,'ENCRYPT-KEY')"]);
                $assignee_total_array[] = ['user_id' => $data['user_id'], '部署' => $data['agent_branch'], '氏名' => $data['assignee_name'], 'メールアドレス' => $data['assignee_email_address'], 'パスワード' => $assignee_password_array[$index]];
                $index++;
            }
            // print_r('<pre>');
            // var_dump($assignee_total_array);
            // var_dump($assignee);
            // var_dump($assignee_password_array);
            // print_r('</pre>');
            foreach ($assignee_total_array as $assignee) {
                echo '<div style="position:relative;margin-bottom:20px;">';
                echo '<form action="" method="POST" style="display:flex;align-items:stretch;">';
                echo '<table style="width:80%;">';
                foreach ($assignee as $column => $data) {
                    if ($column != 'user_id') {
                        echo '<tr>';
                        echo '<th class="admin-agent-detail-person-table-text">' . $column . '</th>';
                        echo '<td class="admin-agent-detail-person-table-content">' . $data . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
                echo '<div style="width:20%;display:flex;justify-content:center;align-items:center;">';
                echo '<input name="delete_assignee_id" value="' . $assignee['user_id'] . '" hidden>';
                echo '<input class="admin-agent-detail-person-table-delete-btn" type="submit" value="削除">';
                //クリック時に確認モーダル表示
                echo '</div>';
                echo '</form>';
                if (isset($_POST['delete_assignee_id'])) {
                    if ($_POST['delete_assignee_id'] == $assignee['user_id']) {
                        echo '<form class="admin-agent-detail-popup-agent-delete-all" id="delete_assignee_form" name="form' . $assignee['user_id'] . '" action="" method="POST">';
                        echo '<div class="admin-agent-detail-popup-agent-delete-head">担当者を削除しますか?</div>';
                        echo '<div class="admin-agent-detail-popup-agent-delete-btns">';
                        echo '<input hidden name="confirm_delete_assignee_id" value="' . $assignee['user_id'] . '">';
                        echo '    <div class="admin-agent-detail-popup-agent-delete-cancel-btn" id="cancel_delete">キャンセル</div>';
                        echo '    <input class="admin-agent-detail-popup-agent-delete-confirm-btn" name="confirm_delete_assignee" type="submit" value="削除する">';
                        echo '</div>';
                        echo '</form>';
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
        ?>
        <form action="" method="POST" style="display:flex;justify-content:center;">
            <input class="admin-agent-detail-person-table-add-btn" name="add_assignee" type="submit" value="担当者を追加する">
        </form>
        <?php
        if (isset($_POST['add_assignee'])) {
            echo '<form class="admin-agent-detail-popup-agent-profile-add-all" id="add_assignee_form" action="" method="POST">
        <div class="admin-agent-detail-popup-agent-profile-add-head">担当者追加フォーム</div>
        <table class="admin-agent-detail-popup-agent-profile-add-table">
            <tr>
                <th class="admin-agent-detail-popup-agent-profile-add-table-text">部署</th>
                <td class="admin-agent-detail-popup-agent-profile-add-table-content"><input required style="width:100%;" name="add_branch"></td>
            </tr>
            <tr>
                <th class="admin-agent-detail-popup-agent-profile-add-table-text">氏名</th>
                <td class="admin-agent-detail-popup-agent-profile-add-table-content"><input required style="width:100%;" name="add_name"></td>
            </tr>
            <tr>
                <th class="admin-agent-detail-popup-agent-profile-add-table-text">メールアドレス</th>
                <td class="admin-agent-detail-popup-agent-profile-add-table-content"><input required style="width:100%;" name="add_mail"></td>
            </tr>
            <tr>
                <th class="admin-agent-detail-popup-agent-profile-add-table-text">パスワード</th>
                <td class="admin-agent-detail-popup-agent-profile-add-table-content"><input required style="width:100%;" name="add_password"></td>
            </tr>
        </table>
        <div class="admin-agent-detail-popup-agent-profile-add-table-btns" style="display:flex;">
        <div style="width:50%;display:flex;justify-content:center;">
        <div class="admin-agent-detail-popup-agent-profile-add-table-cancel-btn" id="cancel_add_assignee">キャンセル</div>
        </div>
        <div style="width:50%;display:flex;justify-content:center;">
        <input class="admin-agent-detail-popup-agent-profile-add-table-confirm-btn" type="submit" name="confirm_add" value="追加確定">
        </div>
        </div>
    </form>';
        }
        ?>

    </div>
</section>
<script>
    <?php if (isset($_POST['add_assignee'])) { ?>
        document.getElementById('cancel_add_assignee').addEventListener('click', function() {
            document.getElementById('add_assignee_form').setAttribute('hidden', '');
            document.getElementById('edit_popup_filter').setAttribute('hidden', '');
        });
    <?php } ?>
    <?php if (isset($_POST['delete_assignee_id'])) { ?>
        document.getElementById('cancel_delete').addEventListener('click', function() {
            document.getElementById('delete_assignee_form').setAttribute('hidden', '');
            document.getElementById('edit_popup_filter').setAttribute('hidden', '');
        })
    <?php } ?>
</script>