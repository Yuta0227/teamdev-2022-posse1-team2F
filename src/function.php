<?php
class adjust_digit
{
    public function single($event)
    {
        for ($i = 1; $i <= 9; $i++) {
            if ($event == '0' . $i) {
                //引数が0付きの二桁の場合一桁に直して返す
                return $i;
            }
        }
        return $event;
    }
    public function double($event)
    {
        for ($i = 1; $i <= 9; $i++) {
            if ($event == $i) {
                return '0' . $i;
            }
        }
        return $event;
    }
}
$adjust = new adjust_digit;
class translate
{
    public function translate_column_to_japanese($column)
    {
        global $column_set;
        $column_set = [
            'agent_name' => 'エージェント名',
            'contract_date' => '契約締結日',
            'start_contract_date' => '契約開始日',
            'end_contract_date' => '契約終了日',
            'contract_address' => '本社住所',
            'agent_phone_number' => '電話番号',
            'apply_email_address' => '問い合わせ通知先メールアドレス',
            'agent_representative' => '代表者氏名',
            'agent_meeting_type' => '面談方式',
            'agent_main_corporate_size' => '主な取り扱い企業規模',
            'agent_corporate_type' => '取り扱い企業カテゴリー',
            'agent_job_offer_rate' => '内定率(%)',
            'agent_shortest_period' => '内定最短期間(週)',
            'agent_prefecture' => '拠点地',
            'apply_id' => '問い合わせID',
            'agent_id' => 'エージェントID',
            'agent_branch' => '支店名',
            'apply_time' => '問い合わせ時間',
            'applicant_email_address' => 'メールアドレス',
            'applicant_name_kanji' => '名前(漢字)',
            'applicant_name_furigana' => '名前(フリガナ)',
            'applicant_phone_number' => '電話番号',
            'applicant_university' => '大学',
            'applicant_gakubu' => '学部',
            'applicant_gakka' => '学科',
            'applicant_graduation_year' => '卒業年度',
            'applicant_postal_code' => '郵便番号',
            'applicant_address' => '住所',
            'applicant_consultation' => '相談',
            'applicant_other_agents' => '同時問い合わせ',
            'apply_report_status' => '通報ステータス',
            'agent_recommend_student_type' => '○○向き',
            'sales_copy' => 'キャッチコピー',
            'total' => '取り扱い企業数合計',
            'manufacturer' => 'メーカー',
            'retail' => '小売り',
            'service' => 'サービス',
            'software_transmission' => 'ソフトウェア・通信',
            'trading' => '商社',
            'finance' => '金融',
            'media' => 'マスコミ',
            'government' => '官公庁・公社・団体'
        ];
        foreach ($column_set as $english => $japanese) {
            if ($column == $english) {
                return $japanese;
            }
        }
    }
    public function translate_data_to_japanese($column, $data)
    {
        global $meeting_array;
        global $size_array;
        global $category_array;
        global $db;
        switch ($column) {
            case '面談方式':
                // $meeting_array = ['対面のみ', 'オンライン可', 'オンラインのみ'];
                $meeting_array = $db->query("select meeting_type from filter_meeting;")->fetchAll();
                return $meeting_array[$data]['meeting_type'];
                break;
            case '主な取り扱い企業規模':
                $size_array = $db->query("select corporate_size from filter_corporate_size;")->fetchAll();
                return $size_array[$data]['corporate_size'];
                break;
            case '取り扱い企業カテゴリー':
                $category_array = $db->query("select corporate_type from filter_corporate_type;")->fetchAll();
                return $category_array[$data]['corporate_type'];
                break;
            case '内定率(%)':
                return $data;
                break;
            case '内定最短期間(週)':
                return $data;
                break;
            case '○○向き':
                $student_type_array = $db->query("select student_type from filter_student_type;")->fetchAll();
                return $student_type_array[$data]['student_type'];
            default:
                return $data;
                break;
        }
    }
}
$translate = new translate;
class check
{
    public function exists_in_array($array, $event)
    {
        $count = 0;
        foreach ($array as $data) {
            if ($data == $event) {
                $count++;
            }
        }
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function exists_in_multi_array($array, $column, $event)
    {
        $count = 0;
        foreach ($array as $row) {
            if ($row[$column] == $event) {
                $count++;
            }
        }
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }
}
$check = new check;
class filter
{
    public function filter($condition, $base_agent_id_array)
    {
        global $db;
        if (isset($_POST['filter'])) {
            if (isset($_POST[$condition])) {
                ${$condition . "_stmt"} = 'select agent_id from agent_public_information where ';
                $_SESSION[$condition] = [];
                foreach ($_POST[$condition] as ${$condition . "_id"}) {
                    if (${$condition . "_id"} == $_POST[$condition][count($_POST[$condition]) - 1]) {
                        //最後の条件,一つのみの条件
                        ${$condition . "_stmt"} .= $condition . '=' . ${$condition . "_id"} . ';';
                    } else {
                        ${$condition . "_stmt"} .= $condition . '=' . ${$condition . "_id"} . ' or ';
                    }
                    array_push($_SESSION[$condition], ${$condition . "_id"});
                }
                ${"filter_" . $condition . "_stmt"} = $db->query(${$condition . "_stmt"});
                ${"filter_" . $condition} = ${"filter_" . $condition . "_stmt"}->fetchAll();
                ${"tmp_" . $condition . "_agent"} = [];
                foreach (${"filter_" . $condition} as $agent) {
                    array_push(${"tmp_" . $condition . "_agent"}, $agent['agent_id']);
                    //これを使って他の条件絞り込みとの共通項を出力
                    //並び替えとの組み合わせは共通項の配列をforeachで回して↓の並び替え文の後にwhere agent_id =? or agent_id=?
                }
                //共通項取得
                $base_agent_id_array = array_intersect($base_agent_id_array, ${"tmp_" . $condition . "_agent"});
                //消えたところを埋める
                return $base_agent_id_array = array_merge($base_agent_id_array);
                print_r('<pre>' . $condition);
                var_dump($base_agent_id_array);
                print_r('</pre>');
            } elseif (!isset($_POST[$condition])) {
                //絞り込みなしだったら配列そのまま返す
                $_SESSION[$condition] = [];
                return $base_agent_id_array = array_merge($base_agent_id_array);
            }
        }
    }
}
$filter = new filter;
