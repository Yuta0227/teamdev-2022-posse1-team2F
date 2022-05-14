<?php
class translate
{
    public function translate_column_to_japanese($column){
        global $column_set;
        $column_set=[
            'agent_name'=>'エージェント名',
            'agent_meeting_type'=>'面談方式',
            'agent_main_corporate_size'=>'主な取り扱い企業規模',
            'agent_corporate_type'=>'取り扱い企業カテゴリー',
            'agent_job_offer_rate'=>'内定率(%)',
            'agent_shortest_period'=>'内定最短期間(週)',
            'agent_simple_explanation'=>'短い説明文',
            'apply_id'=>'問い合わせID',
            'agent_branch_id'=>'支店ID',
            'agent_name'=>'エージェント名',
            'agent_branch'=>'支店名',
            'apply_time'=>'問い合わせ時間',
            'applicant_email_address'=>'メールアドレス',
            'applicant_name_kanji'=>'名前(漢字)',
            'applicant_name_furigana'=>'名前(フリガナ)',
            'applicant_phone_number'=>'電話番号',
            'applicant_university'=>'大学',
            'applicant_gakubu'=>'学部',
            'applicant_gakka'=>'学科',
            'applicant_graduation_year'=>'卒業年度',
            'applicant_postal_code'=>'郵便番号',
            'applicant_address'=>'住所',
            'applicant_consultation'=>'相談',
            'applicant_other_agents'=>'同時問い合わせ',
            'applicant_report_status'=>'通報ステータス',
        ];
        foreach($column_set as $english=>$japanese){
            if($column==$english){
                return $japanese;
            }else{
                return $column;
            }
        }
    }
    public function translate_data_to_japanese($column, $data)
    {
        global $meeting_array;
        global $size_array;
        global $category_array;
        switch ($column) {
            case 'エージェント名':
                return $data;
                break;
            case '面談方式':
                $meeting_array = ['対面のみ', 'オンライン可', 'オンラインのみ'];
                return $meeting_array[$data];
                break;
            case '主な取り扱い企業規模':
                $size_array = ['大手', '中小', 'ベンチャー', '総合'];
                return $size_array[$data];
                break;
            case '取り扱い企業カテゴリー':
                $category_array=['外資系含む','外資系含まない'];
                return $category_array[$data];
                break;
            case '内定率(%)':
                return $data;
                break;
            case '内定最短期間(週)':
                return $data;
                break;
            case '短い説明文':
                return $data;
                break;
        }
    }
}
$translate = new translate;
