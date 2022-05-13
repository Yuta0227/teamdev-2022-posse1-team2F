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
            'agent_simple_explanation'=>'短い説明文'
        ];
        foreach($column_set as $english=>$japanese){
            if($column==$english) return $japanese;
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
