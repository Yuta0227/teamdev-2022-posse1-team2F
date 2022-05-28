<section class="filter">
    <!--ポップアップ-->
    <?php
    $area_array = [
        1 => '北海道',
        2 => '東北',
        3 => '関東',
        4 => '中部',
        5 => '近畿',
        6 => '中国',
        7 => '四国',
        8 => '九州沖縄',
    ];
    $industry_array = ['manufacturer', 'retail', 'service', 'software_transmission', 'trading', 'finance', 'media', 'government'];

    $conditions_array = [1, 2, 3, 4, 5];
    $conditions_type_array = [1, 2];
    ?>
    <form action="" method="POST" id="filter" style="width:100%;background:#fff;">
        <div class="filter-popup-all-head-box">
            <div class="filter-popup-all-head">絞り込み条件</div>
            <div id="close-btn" class="close-btn" style="position:absolute;top:0;right:0;border-radius:20px;padding:5px;border:1px solid black;text-align:center;">✕</div>
        </div>

        <table class="filter-popup-table">
            <tr>
                <th style="border:1px solid black;">拠点地</th>
                <td style="border:1px solid black;">
                    <?php
                    foreach ($area_array as $area_id => $area) {
                        echo
                        '<div style="display:flex;width:100%;">
                        <div style="width:80%;box-sizing:border-box;border:1px solid black;">' . $area . '</div>
                        <div id="open' . $area_id . '" class="filter-popup-table-open-close-detail">▽</div>
                        <div id="close' . $area_id . '"  class="filter-popup-table-open-close-detail" hidden>△</div>
                        </div>';
                        echo '<div id="prefectures' . $area_id . '" hidden>';
                        $filter_prefecture_stmt = $db->query("select * from filter_prefecture where area_id=" . $area_id . ";");
                        $filter_prefecture = $filter_prefecture_stmt->fetchAll();
                        foreach ($filter_prefecture as $data) {
                            if (isset($_SESSION['prefectures'])) {
                                //過去に都道府県で絞り込んだことがある
                                if ($check->exists_in_array($_SESSION['prefectures'], $data['prefecture_id']) == true) {
                                    //存在する
                                    echo '<label><input value="' . $data['prefecture_id'] . '" type="checkbox" name="filter_prefecture[]" checked>' . $data['prefecture_name'] . '</label>';
                                } else {
                                    echo '<label><input value="' . $data['prefecture_id'] . '" type="checkbox" name="filter_prefecture[]">' . $data['prefecture_name'] . '</label>';
                                }
                            } else {
                                echo '<label><input value="' . $data['prefecture_id'] . '" type="checkbox" name="filter_prefecture[]">' . $data['prefecture_name'] . '</label>';
                            }
                        }
                        echo '</div>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="border:1px solid black;">業界</th>
                <td style="border:1px solid black;">
                    <?php
                    foreach ($industry_array as $industry) {
                        if (isset($_SESSION['industries'])) {
                            //過去に業界で絞り込んだことがある
                            if ($check->exists_in_array($_SESSION['industries'], $industry) == true) {
                                //存在する
                                echo '<label><input value="' . $industry . '" type="checkbox" name="industries[]" checked>' . $translate->translate_column_to_japanese($industry) . '</label>';
                            } else {
                                echo '<label><input value="' . $industry . '" type="checkbox" name="industries[]">' . $translate->translate_column_to_japanese($industry) . '</label>';
                            }
                        } else {
                            echo '<label><input value="' . $industry . '" type="checkbox" name="industries[]">' . $translate->translate_column_to_japanese($industry) . '</label>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="border:1px solid black;">面談方式</th>
                <td style="border:1px solid black;">
                    <?php
                    $meeting_array = [
                        0 => '対面のみ',
                        1 => 'オンライン可',
                        2 => 'オンラインのみ'
                    ];
                    foreach ($meeting_array as $column => $data) {
                        if (isset($_SESSION['agent_meeting_type'])) {
                            if ($check->exists_in_array($_SESSION['agent_meeting_type'], $column)) {
                                //過去に面談方式で絞り込んだことがある
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_meeting_type[]" checked>' . $data . '</label>';
                            } else {
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_meeting_type[]">' . $data . '</label>';
                            }
                        } else {
                            echo '<label><input type="checkbox" value="' . $column . '" name="agent_meeting_type[]">' . $data . '</label>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="border:1px solid black;">企業規模</th>
                <td style="border:1px solid black;">
                    <?php
                    $size_array = [
                        0 => '大手',
                        1 => '中小',
                        2 => 'ベンチャー',
                        3 => '総合'
                    ];
                    foreach ($size_array as $column => $data) {
                        if (isset($_SESSION['agent_main_corporate_size'])) {
                            if ($check->exists_in_array($_SESSION['agent_main_corporate_size'], $column)) {
                                //過去に面談方式で絞り込んだことがある
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_main_corporate_size[]" checked>' . $data . '</label>';
                            } else {
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_main_corporate_size[]">' . $data . '</label>';
                            }
                        } else {
                            echo '<label><input type="checkbox" value="' . $column . '" name="agent_main_corporate_size[]">' . $data . '</label>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="border:1px solid black;">取り扱い企業カテゴリー</th>
                <td style="border:1px solid black;">
                    <?php
                    $type_array = [
                        0 => '外資系含む',
                        1 => '外資系含まない'
                    ];
                    foreach ($type_array as $column => $data) {
                        if (isset($_SESSION['agent_corporate_type'])) {
                            if ($check->exists_in_array($_SESSION['agent_corporate_type'], $column)) {
                                //過去に面談方式で絞り込んだことがある
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_corporate_type[]" checked>' . $data . '</label>';
                            } else {
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_corporate_type[]">' . $data . '</label>';
                            }
                        } else {
                            echo '<label><input type="checkbox" value="' . $column . '" name="agent_corporate_type[]">' . $data . '</label>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th style="border:1px solid black;">○○向き</th>
                <td style="border:1px solid black;">
                    <?php
                    $student_array = [
                        0 => '理系',
                        1 => '文系'
                    ];
                    foreach ($student_array as $column => $data) {
                        if (isset($_SESSION['agent_recommend_student_type'])) {
                            if ($check->exists_in_array($_SESSION['agent_recommend_student_type'], $column)) {
                                //過去に面談方式で絞り込んだことがある
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_recommend_student_type[]" checked>' . $data . '</label>';
                            } else {
                                echo '<label><input type="checkbox" value="' . $column . '" name="agent_recommend_student_type[]">' . $data . '</label>';
                            }
                        } else {
                            echo '<label><input type="checkbox" value="' . $column . '" name="agent_recommend_student_type[]">' . $data . '</label>';
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
        <input class="filter-popup-confirm-conditions" name="filter" value="この条件で絞り込む" type="submit">
        <input class="filter-popup-reset-conditions" name="reset_filter" value="条件リセットする" type="submit">
    </form>
</section>
<!--cssやjsは17行から20行を編集すればいい。idつけるなど-->
<script>
    <?php for ($i = 1; $i <= count($area_array); $i++) { ?>
        document.getElementById('open<?php echo $i; ?>').addEventListener('click', function() {
            document.getElementById('open<?php echo $i; ?>').setAttribute('hidden', '');
            document.getElementById('close<?php echo $i; ?>').removeAttribute('hidden');
            document.getElementById('prefectures<?php echo $i ?>').removeAttribute('hidden');
        });
        document.getElementById('close<?php echo $i; ?>').addEventListener('click', function() {
            document.getElementById('close<?php echo $i; ?>').setAttribute('hidden', '');
            document.getElementById('open<?php echo $i; ?>').removeAttribute('hidden');
            document.getElementById('prefectures<?php echo $i ?>').setAttribute('hidden', '');
        });

    <?php } ?>
</script>