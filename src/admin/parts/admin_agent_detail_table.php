<section>
    <div style="display:flex;">
        <img src="" alt="企業の写真">
        <div>株式会社アンチパターン</div>
    </div>
    <form>
        <table>
            <tr>
                <th>契約日</th><td></td>
            </tr>
            <tr>
                <th>契約解除日</th><td></td>
            </tr>
            <tr>
                <th>電話番号</th><td></td>
            </tr>
            <tr>
                <th>学生登録時の連絡先アドレス</th><td></td>
            </tr>
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
            for($assignee_id=1;$assignee_id<=count($agent_assignee_array);$assignee_id++){
                echo '<tr>';
                echo '<th>担当者部署・担当者名'.$assignee_id.'</th><td>'.$agent_assignee_array[$assignee_id-1]["部署"].'・'.$agent_assignee_array[$assignee_id-1]["名前"].'</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>担当者'.$assignee_id.'のメールアドレス</th><td>'.$agent_assignee_array[$assignee_id-1]["メールアドレス"].'</td>';
                echo '</tr>';
            }?>
                <tr>
                    <th>企業住所</th><td></td>
                </tr>
                <tr>
                    <th>代表者指名</th><td></td>
                </tr>
            </table>
            <div>
                <button>編集</button>
            </div>
        </form>
        <form>
            <table>
    
            </table>
            <div>
                <button>編集</button>
            </div>
        </form>
        <form>
            <div>エージェント説明文</div>
        <div></div>
    </form>
</section>