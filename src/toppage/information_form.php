<?php
$prefecture_array = array(
    '北海道',
    '青森県',
    '岩手県',
    '宮城県',
    '秋田県',
    '山形県',
    '福島県',
    '茨城県',
    '栃木県',
    '群馬県',
    '埼玉県',
    '千葉県',
    '東京都',
    '神奈川県',
    '新潟県',
    '富山県',
    '石川県',
    '福井県',
    '山梨県',
    '長野県',
    '岐阜県',
    '静岡県',
    '愛知県',
    '三重県',
    '滋賀県',
    '京都府',
    '大阪府',
    '兵庫県',
    '奈良県',
    '和歌山県',
    '鳥取県',
    '島根県',
    '岡山県',
    '広島県',
    '山口県',
    '徳島県',
    '香川県',
    '愛媛県',
    '高知県',
    '福岡県',
    '佐賀県',
    '長崎県',
    '熊本県',
    '大分県',
    '宮崎県',
    '鹿児島県',
    '沖縄県'
);
// 配列の参考
// https://ysklog.net/php/4532.html
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form style="padding:10px;background-color:skyblue;">
        <div>お名前<span>(必須)</span></div>
        <input>
        <div>フリガナ<span>(必須)</span></div>
        <input>
        <div>メールアドレス<span>(必須)(半角)</span></div>
        <input>
        <div>電話番号<span>(必須)(半角)</span></div>
        <input>
        <div>大学名<span>(必須)</span></div>
        <input>
        <div>学部名<span>(必須)</span></div>
        <input>
        <div>何年卒<span>(必須)(<?php echo date('Y');?>年に大学4年生の場合は<?php echo date('Y')+1;?>年卒)</span></div>
        <input id="test">
        <div>郵便番号<span>(必須)(半角)</span></div>
        <div style="display:flex;">
            <input>
            <div>-</div>
            <input>
            <div id="button">住所検索</div>
        </div>
        <div>都道府県<span>(必須)</span></div>
        <select>
            <?php foreach($prefecture_array as $prefecture){
                echo '<option id="'.$prefecture.'">'.$prefecture.'</option>';
            }?>
        </select>
        <div>市区町村<span>(必須)</span></div>
        <input name="市区町村">
        <div>町域名<span>(必須)</span></div>
        <input name="町域名">
        <div>番地など<span>(必須)</span></div>
        <input name="番地など">
        <div>プライバシーポリシーに同意<span>(必須)</span></div>
        <div>&gt;&gt;<a href="privacy_policy.php" target="_blank" rel="noopener noreferrer">プライバシーポリシーはこちら</a></div>
        <label>
        <input name="プライバシーポリシー" type="checkbox">
            私はプライバシーポリシーに同意します
        </label>
        <div>自由記入欄</div>
        <div id="select_agent" style="display:flex;">    
            <select id="test2">
                <?php 
                $array=[1,2,3,];
                foreach($array as $data){
                    echo '<option id="'.$data.'">';
                    // echo $_SESSION[''];
                    echo $data;
                    //選択済みのセッションから出力
                    echo '</option>';
                }
                ?>
            </select>
            <div id="button2">に対しての自由記入欄を追加する</div>
        </div>
        <input type="submit" value="内容確認へ">
    </form>
</body>

</html>
<script>
    document.getElementById('button').onclick = function() {
        document.getElementById('test').setAttribute("value", "567");
        document.getElementById('神奈川県').setAttribute("selected","");
    }
    //動きはする。住所検索をクリックすると何年卒というところに567と入り、都道府県に神奈川県が入る。これをサンプルにする。住所検索をクリックしたら住所にsetAttributeで代入
    // https://into-the-program.com/javascript-get-address-zipcode-search-api/。
    // これでやるかPHPとスプレッドシート連携して非同期処理でやる。ページがリロードしてしまうため厳しそう。onsubmitでページリロードを阻止できたら可能かも
    // べつにプルダウンにする必要性はあまりないのでは？どうせ住所検索で自動で入力されるわけだし
    var question_box=`<div style="display:flex;"><div>${document.getElementById('test2').value}</div><textarea cols="50" rows="5" name="<?php echo 1;?>"></textarea></div>`;
    document.getElementById('button2').onclick=function(){
        console.log(document.getElementById('test2').value);
        document.getElementById('select_agent').insertAdjacentHTML('afterend',question_box);
        //できてる。企業に対する自由記入欄ボタン押したらプルダウンタブで選んだ企業の自由記入欄が増えるinsertAdjacentHTMLのafterbegin。
        //できてない。そこで選んだ企業のoptionにはdisabled属性を付与する。同じ企業に複数の記入欄が用意されないように
    }
</script>