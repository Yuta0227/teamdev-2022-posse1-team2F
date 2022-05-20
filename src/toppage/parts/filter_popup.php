<section class="filter"><!--ポップアップ-->
<?php 
$conditions_array=[1,2,3,4,5];
$conditions_type_array=[1,2];
?><!--試しに。ここに条件の種類とその条件一覧を代入。データベースから取得。-->
<?php foreach($conditions_type_array as $condition_type){
//条件の種類の数分枠を作る。条件が増えても対応可能
    echo "テスト";//2個出力できた
    //11から26行==条件というinnerhtmlのdivの親要素のdivを8行のechoの中に入れる。これはコメントアウトを消し終わったら
}?>
<div id="filter">
    <div class="filter-topic">条件</div>
    <div>
        <div>
            <?php for($i=0;$i<=floor(count($conditions_array)/2);$i++){//条件の数を2で割ってその数分行をつくる
                echo "
                <div class='filter-contents'>
                <div class='filter-content'>条件1</div>
                <div class='filter-content'>条件2</div>
                </div>
                ";//横並び
                //もし割り算のあまりが1かつ$i==count($conditions_array)-1個目の条件ならば一個のみ出力する行を追加する(数字のずれあり得る)
            }?>
        </div>
    </div>
</div>
</section>
<!--cssやjsは17行から20行を編集すればいい。idつけるなど-->