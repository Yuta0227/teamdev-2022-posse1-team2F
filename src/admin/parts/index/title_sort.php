<!-- <section>
    <div>管理者専用画面</div>
    <form method="POST" action="">

        <label>並び替え：</label><select name="sort">
            <?php
            $default_sort_order_array = [
                '契約新しい順', 
                '契約古い順',
                '企業名五十音昇順',
                '企業名五十音降順',
                '請求額降順',
                '請求額昇順',
            ];
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $sort_order_array = []; //リセット
                for ($i = 0; $i < count($default_sort_order_array); $i++) {
                    if ($default_sort_order_array[$i] == $_POST['sort']) {
                        array_push($sort_order_array, $default_sort_order_array[$i]);//並び替えで選んだ内容を新たな配列に追加する
                        unset($default_sort_order_array[$i]); //POSTで受け取った番号
                    }
                }
                for ($i = 0; $i < count($default_sort_order_array); $i++) {
                    $default_sort_order_array = array_values($default_sort_order_array);
                    array_push($sort_order_array, $default_sort_order_array[$i]);
                }
                foreach ($sort_order_array as $sort) {
                    echo '<option>' . $sort . '</option>';
                    //並び替え
                }
            } else {
                foreach ($default_sort_order_array as $sort) {
                    echo '<option>' . $sort . '</option>';
                    //並び替えしないときはデフォルトの順番
                }
            };
            ?>
        </select>
        <input type="submit" value="並び替えする">
    </form>
</section> -->