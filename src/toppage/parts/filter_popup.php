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
    $industry_array=['manufacturer','retail','service','software_transmission','trading','finance','media','government'];
    // print_r('<pre>');
    // var_dump($filter_prefecture_hokkaidou);
    // print_r('</pre>');
    
    $conditions_array = [1, 2, 3, 4, 5];
    $conditions_type_array = [1, 2];
    ?>
    <form action="" method="POST" id="filter" style="width:100%;">
    <div id="close-btn" class="close-btn">✕</div>

        <table style="width:100%;">
            <tr>
                <th style="border:1px solid black;">拠点地</th>
                <td style="border:1px solid black;">
                    <?php
                    foreach ($area_array as $area_id => $area) {
                        echo
                        '<div style="display:flex;width:100%;">
                        <div style="width:80%;box-sizing:border-box;border:1px solid black;">' . $area . '</div>
                        <div id="open' . $area_id . '" style="border:1px solid black;width:20%;background-color:red;box-sizing:border-box;">▽</div>
                        <div id="close' . $area_id . '" style="border:1px solid black;width:20%;box-sizing:border-box;" hidden>△</div>
                        </div>';
                        echo '<div id="prefectures' . $area_id . '" hidden>';
                        $filter_prefecture_stmt = $db->query("select * from filter_prefecture where area_id=" . $area_id . ";");
                        $filter_prefecture = $filter_prefecture_stmt->fetchAll();
                        foreach ($filter_prefecture as $data) {
                            echo '<label><input value="'.$data['prefecture_id'].'" type="checkbox" name="filter_prefecture[]">' . $data['prefecture_name'] . '</label>';
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
                foreach($industry_array as $industry){
                    echo '<label><input value="'.$industry.'" type="checkbox" name="industries[]">'.$translate->translate_column_to_japanese($industry).'</label>';
                }
                ?>
                </td>

            </tr>
        </table>
        <input value="この条件で絞り込む" type="submit">
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