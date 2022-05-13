<!-- agent画面の方で削除の申請したらadmin画面にその通知が来るようにしたい。申込一覧の通報が来てるものにNEW!をつけるべきか、通報が来てるもののみ表示するか -->
<section>
    <div style="text-align:center;"><?php echo $_GET['year'] . '年' . $_GET['month'] . '月' . $_GET['date'] . '日'; ?>の申込学生情報一覧</div>
    <?php
    $applies_array = [
        //データベースから取得
        [
            '年' => '2022',
            '月' => '12',
            '日' => '20',
            '時間' => '10:50',
            'メールアドレス' => 'sample@gmail.com',
            '漢字' => '漢字サンプル',
            'フリガナ' => 'フリガナサンプル',
            '電話番号' => '000-0000-0000',
            '大学名' => '大学名サンプル',
            '学部名' => '学部名サンプル',
            '学科名' => '学科名サンプル',
            '何年卒' => '24',
            '郵便番号' => '000-0000',
            '住所' => '住所サンプル',
            '相談' => '相談サンプル',
            '履歴' => '',
            '通報ステータス' => 1
        ]
    ];
    for ($index = 0; $index < count($applies_array); $index++) {
        if ($applies_array[$index]['通報ステータス'] == 1) {
            //通報されてる場合
            echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
            echo '<div>' . $applies_array[$index]['時間'] . '</div>';
            echo '<div>' . $applies_array[$index]['メールアドレス'] . '</div>';
            echo '<div style="background-color:red;">通報申請きてます!!!</div>';
            echo '<input type="button" id="open_apply' . $index . '" value="詳細▽">';
            echo '<input id="close_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
            echo '</form>';
            echo '<div id="apply_detail' . $index . '" hidden style="border:1px solid black;">';
            echo '<div>' . $applies_array[$index]['漢字'] . '(' . $applies_array[$index]['フリガナ'] . ')</div>';
            echo '<div>' . $applies_array[$index]['電話番号'] . '</div>';
            echo '<div>' . $applies_array[$index]['大学名'] . $applies_array[$index]['学部名'] . $applies_array[$index]['学科名'] . $applies_array[$index]['何年卒'] . '年卒</div>';
            echo '<div>' . $applies_array[$index]['郵便番号'] . '</div>';
            echo '<div>' . $applies_array[$index]['住所'] . '</div>';
            echo '<div>' . $applies_array[$index]['履歴'] . '</div>';
            echo '<div>相談：' . $applies_array[$index]['相談'] . '</div>';
            echo '</div>';
            echo '<form id="delete_form' . $index . '" action="" method="POST" hidden style="padding;10px;border:1px solid black;">';
            echo '<div>通報理由：テキストサンプル</div>';
            echo '<div style="display:flex;justify-content:center;">';
            echo '<div style="width:50%;display:flex;justify-content:center;align-items:center;height:200px;">';
            echo '<input type="submit" name="accept_delete_request' . $index . '" value="削除申請承認">'; //自動でメール送信
            echo '</div>';
            echo '<div style="width:50%;display:flex;justify-content:center;align-items:center;height:200px;">';
            echo '<input type="submit" name="decline_delete_request' . $index . '" value="削除申請却下">';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        } else {
            //通報されていない場合
            echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
            echo '<div>' . $applies_array[$index][0] . '</div>';
            echo '<div>' . $applies_array[$index][1] . '</div>';
            echo '<input type="button" id="open_apply' . $index . '" value="詳細▽">';
            echo '<input id="close_apply' . $index . '" name="close' . $index . '" hidden value="閉じる△" type="submit">';
            echo '</form>';
            echo '<div id="apply_detail' . $index . '" hidden style="border:1px solid black;">';
            echo '<div>漢字(フリガナ)</div>';
            echo '<div>電話番号</div>';
            echo '<div>大学名 学部名 学科名 何年卒</div>';
            echo '<div>郵便番号</div>';
            echo '<div>住所</div>';
            echo '<div>相談：</div>';
            echo '</div>';
        }
    };
    echo '<div style="text-align:center;">' . $_GET['month'] . '月' . $_GET['date'] . '日の合計：' . count($applies_array) . '人</div>';
    ?>
    <div style="text-align:center;"><a href="admin_agent_detail.php?agent_branch_id=<?php $_GET['agent_branch_id']; ?>year=<?php echo $_GET['year']; ?>&month=<?php echo $_GET['month']; ?>">企業詳細ページに戻る</a></div>
</section>
<script>
    <?php for ($index = 0; $index < count($applies_array); $index++) { ?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('delete_form<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('delete_form<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php }; ?>
</script>