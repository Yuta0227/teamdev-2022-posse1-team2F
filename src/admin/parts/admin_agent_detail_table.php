<section style="display:flex;flex-direction:column;justify-content:center;width:max-content;margin:0 auto;">
    <div style="display:flex;width:max-content;">
        <img src="" alt="企業の写真">
        <div>株式会社アンチパターン</div>
    </div>
    <form style="background-color:blue;width:max-content;padding:20px;">
        <div style="display:flex;justify-content:center;">契約情報</div>
        <div style="display:flex;justify-content:center;">
            <table>
                <?php
                $contract_information_array = [
                    '契約日' => '契約日サンプル',
                    '契約解除日' => '契約解除日サンプル',
                    '電話番号' => '電話番号サンプル',
                    '学生登録時の連絡先メールアドレス' => 'メールアドレスサンプル',
                    '企業住所' => '住所サンプル',
                    '代表者氏名' => '氏名サンプル',
                ]; //データベースから取得
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
                for ($assignee_id = 1; $assignee_id <= count($agent_assignee_array); $assignee_id++) {
                    $contract_information_array += array('担当者' . $assignee_id . '部署' => '部署' . $assignee_id);
                    $contract_information_array += array('担当者' . $assignee_id . '氏名' => '氏名' . $assignee_id);
                    $contract_information_array += array('担当者' . $assignee_id . 'メールアドレス' => 'メールアドレス' . $assignee_id);
                }
                foreach ($contract_information_array as $column => $data) {
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">' . $column . '</th>';
                    echo '<td style="border:1px solid black;">' . $data . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        <div style="display:flex;justify-content:right;">
            <button>編集</button>
        </div>
    </form>
    <form style="background-color:blue;width:max-content;padding:20px;">
        <div style="display:flex;justify-content:center;">掲載情報</div>
        <div style="display:flex;justify-content:center;">
            <table>
                <?php
                $agent_public_information_array = [
                    '取り扱い企業数' => '企業数サンプル',
                    '住所' => '住所サンプル',
                    '特色' => '特色サンプル',
                    '就活方式' => '就活方式サンプル',
                    'おすすめする学生の特徴' => 'おすすめサンプル',
                ]; //データベースから取得する
                foreach ($agent_public_information_array as $column => $data) {
                    echo '<tr>';
                    echo '<th style="border:1px solid black;">' . $column . '</th>';
                    echo '<td style="border:1px solid black;">' . $data . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        <div style="display:flex;justify-content:right;">
            <button>編集</button>
        </div>
    </form>
    <form style="background-color:blue;width:max-content;padding:20px;">
        <div style="display:flex;justify-content:center;">エージェント説明文</div>
        <div style="height:200px;width:400px;background-color:white;">テキスト</div>
        <div style="display:flex;justify-content:right;">
            <button>編集</button>
        </div>
    </form>
</section>