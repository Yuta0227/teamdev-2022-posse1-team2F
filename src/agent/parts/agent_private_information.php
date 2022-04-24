<section>
    <div style="text-align:center;">契約情報</div>
    <div style="display:flex;justify-content:center;">
        <table>
            <?php
            $agent_private_information_array = [
                '契約日' => '契約日サンプル',
                '契約解除日' => '契約解除日サンプル',
                '電話番号' => '電話番号サンプル',
                '問い合わせ用の連絡先' => '連絡先サンプル',
                '住所' => '住所サンプル',
                '代表者氏名' => '代表者氏名サンプル',
            ]; //データベースから取得
            foreach ($agent_private_information_array as $column => $data) {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <div style="display:flex;justify-content:center;text-align:center;">担当者情報</div>
    <div>
        <div id="add" style="width:max-content;left:40%;border:1px solid black;background-color:red;">追加</div>
        <!-- 位置調整任せる -->
    </div>
    <div style="display:flex;flex-direction:column;justify-content:center;">
        <?php
            $agent_assignee_array = [
                [
                    '部署' => '部署サンプル',
                    '名前' => '名前サンプル',
                    'メールアドレス' => 'メールアドレスサンプル',
                    'パスワード' => 'パスワードサンプル',
                ],
                [
                    '部署' => '部署サンプル2',
                    '名前' => '名前サンプル2',
                    'メールアドレス' => 'メールアドレスサンプル2',
                    'パスワード' => 'パスワードサンプル2',
                ],
            ]; //データベースから取得
            $assignee_id=0;
            foreach ($agent_assignee_array as $assignee) {
                echo '<div style="display:flex;margin:0 0 100px 0;">';
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
                echo '<div style="position:relative;width:30%;">';
                echo '<div style="display:flex;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">';
                echo '<button id="edit'.$assignee_id.'">編集</button>';
                echo '<button id="delete'.$assignee_id.'" style="background-color:red;">削除</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                $assignee_id++;
            };
            ?>
    </div>
    <div style="text-align:center;">掲載情報変更・契約延長申請はこちらまで<br><?php echo 'xxxx@gmail.com'; ?></div>
</section>
