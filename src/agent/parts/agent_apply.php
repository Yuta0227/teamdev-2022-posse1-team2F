<?php
$applies_array = [
    ['10:50', 'sample@gmail.com'],
    ['10:10', 'sample@gmail.com']
    //パラメータの日程の申込一覧をデータベースから取得
];
$index = 0;
foreach ($applies_array as $apply) {
    echo '<form method="POST" onsubmit="submitEvent();return false;" id="test' . $index . '" style="padding:10px;align-items:center;display:flex;border:1px solid black;">';
    echo '<div>' . $apply[0] . '</div>';
    echo '<div>' . $apply[1] . '</div>';
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
    echo '<form name="report_form'.$index.'" onsubmit="submit_reason();" action="" method="POST">';
    echo '<div style="justify-content:center;display:flex;border:1px solid black;">';
    echo '<div id="new_report'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:red;">通報する('.($new_apply['月']+1).'月1日23:59まで)';
    echo'</div>';
    echo '<div id="new_reported'.$index.'" hidden style="text-align:center;width:50%;padding:10px;border-radius:50%;background-color:blue;">通報済み</div>';
    echo '</div>';
    echo '<div id="new_report_reason'.$index.'" style="border:1px solid black;" hidden><div style="display:flex;justify-content:center;align-items:center;"><span>通報理由：</span><textarea type="text" name="new_report_reason" required placeholder="理由を記入してください"></textarea></div>';
    echo '<div style="display:flex;justify-content:center;"><input type="submit" name="report'.$index.'"></div></div>';
    echo '</form>';
    $index++;
};
echo '<div>' . $_GET['month'] . '月' . $_GET['date'] . '日の合計：' . count($applies_array) . '人</div>';
