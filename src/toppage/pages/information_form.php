<?php

session_start();

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
    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/others.css">
    <title>情報入力画面</title>
</head>

<body>
    <?php
    require "../parts/header.php";
    require "../parts/indicator.php";
    ?>
    <div class="info-form-all">
        <div class="info-form-head">申し込み情報入力画面</div>
        <form class="info-form-unit" action="./check_information.php">
            <div class="info-form-each-box-text">お名前<span>(必須)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">フリガナ<span>(必須)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">メールアドレス<span>(必須)(半角)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">電話番号<span>(必須)(半角)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">大学名<span>(必須)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">学部名<span>(必須)</span></div>
            <input class="info-form-each-form">
            <div class="info-form-each-box-text">何年卒<span>(必須)(例：<?php echo date('Y'); ?>年4月に大学4年生の場合は<?php echo date('Y') + 1; ?>年卒)</span></div>
            <input id="test" class="info-form-each-form">
            <div class="info-form-each-box-text">郵便番号<span>(必須)(半角)(ハイフンなし)</span></div>
            <div style="display:flex;">
                <input id="input" type="text" name="zipcode" value="" placeholder="例)8120012" class="info-form-each-form">
                <button id="search" type="button" class="info-form-adress-search-btn">住所検索</button>
                <p id="error"></p>
            </div>
            <div class="info-form-each-box-text" class="info-form-each-form">都道府県<span>(必須)</span>
            </div>
            <input id="address1" type="text" name="address1" value="" class="info-form-each-form">
            <div class="info-form-each-box-text">市区町村<span>(必須)</span></div>
            <input id="address2" type="text" name="address2" value="" name="市区町村" class="info-form-each-form">
            <div class="info-form-each-box-text">町域名<span>(必須)</span></div>
            <input id="address3" type="text" name="address3" value="" name="町域名" class="info-form-each-form">
            <div class="info-form-each-box-text">番地など<span>(必須)</span></div>
            <input name="番地など" class="info-form-each-form">
            <div class="info-form-each-box-text">自由記入欄</div>
            <div id="select_agent" class="info-form-free-box">
                <select id="test2">
                    <?php
                    $array = [1, 2, 3,];
                    foreach ($array as $data) {
                        echo '<option id="' . $data . '">';
                        // echo $_SESSION[''];
                        echo $data;
                        //選択済みのセッションから出力
                        echo '</option>';
                    }
                    ?>
                </select>
                <div id="button2">に対しての自由記入欄を追加する</div>
                <?php
                // 追加する押したらinput(ずっとhidden name="consultation_agent_id" value="実際のagent_id")とtextarea(途中までhidden name="consultation実際のagent_id")追加。選択しているエージェント数をクリックできる回数の上限とする。
                //当然テキストエリア削除ボタンも必要なわけでそれ押したら追加する押した回数を回復する。そのときにagent_idと紐づけるの忘れないように.もう一度追加したくなった場合agent_idと紐づいてるように
                //POSTではinputのvalueと一致する$_POST['consultation'.$index]をfor文を回すことでさがす。さがすとき選択しているエージェント一覧の配列をforeachで回すと処理数少なくできる
                ?>
            </div>
            <div class="info-form-each-box-text">プライバシーポリシーに同意<span>(必須)</span></div>
            <label class="info-form-privacy-agree">
                <input name="プライバシーポリシー" type="checkbox">
                私はプライバシーポリシーに同意します
            </label>
            <div class="info-form-privacy-box">&gt;&gt;<a href="privacy_policy.php" target="_blank" rel="noopener noreferrer" class="info-form-privacy">プライバシーポリシーはこちら</a></div>
            <div style="text-align:center;">
            <input type="submit" value="内容確認へ" class="info-form-check-btn">
            </div>
        </form>
    </div>
    <?php require "../parts/footer.php"; ?>

</body>

</html>
<script>
// 住所検索
    let search = document.getElementById('search');
    search.addEventListener('click', () => {

        let api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';
        let error = document.getElementById('error');
        let input = document.getElementById('input');
        let address1 = document.getElementById('address1');
        let address2 = document.getElementById('address2');
        let address3 = document.getElementById('address3');
        let param = input.value.replace("-", ""); //入力された郵便番号から「-」を削除
        let url = api + param;

        fetchJsonp(url, {
                timeout: 10000, //タイムアウト時間
            })
            .then((response) => {
                error.textContent = ''; //HTML側のエラーメッセージ初期化
                return response.json();
            })
            .then((data) => {
                if (data.status === 400) { //エラー時
                    error.textContent = data.message;
                } else if (data.results === null) {
                    error.textContent = '郵便番号から住所が見つかりませんでした。';
                } else {
                    address1.value = data.results[0].address1;
                    address2.value = data.results[0].address2;
                    address3.value = data.results[0].address3;
                }
            })
            .catch((ex) => { //例外処理
                console.log(ex);
            });
    }, false);

    // document.getElementById('button').onclick = function() {
    //     document.getElementById('test').setAttribute("value", "567");
    //     document.getElementById('神奈川県').setAttribute("selected", "");
    // }
    //動きはする。住所検索をクリックすると何年卒というところに567と入り、都道府県に神奈川県が入る。これをサンプルにする。住所検索をクリックしたら住所にsetAttributeで代入
    // https://into-the-program.com/javascript-get-address-zipcode-search-api/。
    // これでやるかPHPとスプレッドシート連携して非同期処理でやる。ページがリロードしてしまうため厳しそう。onsubmitでページリロードを阻止できたら可能かも
    // べつにプルダウンにする必要性はあまりないのでは？どうせ住所検索で自動で入力されるわけだし
    var question_box = `<div style="display:flex;"><div>${document.getElementById('test2').value}</div><textarea cols="50" rows="5" name="<?php echo 1; ?>"></textarea></div>`;
    document.getElementById('button2').onclick = function() {
        console.log(document.getElementById('test2').value);
        document.getElementById('select_agent').insertAdjacentHTML('afterend', question_box);
        //できてる。企業に対する自由記入欄ボタン押したらプルダウンタブで選んだ企業の自由記入欄が増えるinsertAdjacentHTMLのafterbegin。
        //できてない。そこで選んだ企業のoptionにはdisabled属性を付与する。同じ企業に複数の記入欄が用意されないように
    }
</script>