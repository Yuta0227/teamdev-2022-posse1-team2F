<section>
    <div style="text-align:center;">掲載情報</div>
    <div style="display:flex;justify-content:center;">
        <table>
            <?php
            $agent_public_information_array = [
                '取り扱い企業数' => '企業数サンプル',
                '住所' => '住所サンプル',
                '特色' => '特色サンプル',
                '就活方式' => '就活方式サンプル',
                'おすすめする学生の特徴' => 'おすすめサンプル',
                'トップページで表示される簡単な説明文'=>'テキスト',
            ];//データベースから取得
            foreach ($agent_public_information_array as $column => $data) {
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

</section>