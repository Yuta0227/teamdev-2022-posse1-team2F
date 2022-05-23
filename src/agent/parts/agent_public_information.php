<section>
    <div style="text-align:center;">掲載情報</div>
    <div style="display:flex;justify-content:center;">
        <table>
            <?php
            $agent_public_information_stmt=$db->query("select agent_name,agent_meeting_type,agent_main_corporate_size,agent_corporate_type,agent_job_offer_rate,agent_shortest_period,agent_recommend_student_type from agent_public_information where agent_id=".$_SESSION['agent_id'].";");
            $agent_public_information_array=$agent_public_information_stmt->fetchAll()[0];
            foreach ($agent_public_information_array as $column => $data) {
                $column=$translate->translate_column_to_japanese($column);
                $data=$translate->translate_data_to_japanese($column,$data);
                echo '<tr>';
                echo '<th style="border:1px solid black;">' . $column . '</th><td style="border:1px solid black;">' . $data . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

</section>