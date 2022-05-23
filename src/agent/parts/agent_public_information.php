<section>
    <div style="text-align:center;">掲載情報</div>
    <div style="display:flex;justify-content:center;">
        <table>
            <?php
            $agent_public_information_stmt=$db->query("select agent_name,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period,agent_recommend_student_type from agent_public_information where agent_id=".$_SESSION['agent_id'].";");
            $agent_public_information_array=$agent_public_information_stmt->fetchAll()[0];
            $agent_address_stmt=$db->query("select agent_prefecture from agent_address where agent_id=".$_SESSION['agent_id'].";");
            $agent_address=$agent_address_stmt->fetchAll();
            $sales_copy_stmt=$db->query("select sales_copy from sales_copy where agent_id=".$_SESSION['agent_id'].";");
            $sales_copy=$sales_copy_stmt->fetchAll()[0];
            $corporate_amount_stmt=$db->query("select manufacturer,retail,service,software_transmission,trading,finance,media,government from agent_corporate_amount where agent_id=".$_SESSION['agent_id'].";");
            $corporate_amount=$corporate_amount_stmt->fetchAll()[0];
            foreach ($agent_public_information_array as $column => $data) {
                $column=$translate->translate_column_to_japanese($column);
                $data=$translate->translate_data_to_japanese($column,$data);
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<th style="border:1px solid black;">拠点地</th>';
            echo '<td style="border:1px solid black;">';
            for($index=0;$index<=count($agent_address)-1;$index++){
                if($index==count($agent_address)-1){
                    echo $agent_address[$index]['agent_prefecture'];
                }else{
                    echo $agent_address[$index]['agent_prefecture'].',';
                }
            }
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th style="border:1px solid black;">キャッチコピー</th>';
            echo '<td style="border:1px solid black;">'.$sales_copy['sales_copy'].'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th style="border:1px solid black;">業界別取り扱い企業数</th>';
            echo '<td style="border:1px solid black;">';
            $index=0;
            foreach($corporate_amount as $column=>$data){
                $column=$translate->translate_column_to_japanese($column);
                if($index==count($corporate_amount)-1){
                    echo $column.'('.$data.')';
                }else{
                    echo $column.'('.$data.'),';
                }
                $index++;
            }
            echo '</td>';
            echo '</tr>';
            ?>
        </table>
    </div>

</section>