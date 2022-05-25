<?php

session_start();
require "../../dbconnect.php";
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
    if(isset($_SESSION['information_array'])&&isset($_SESSION['consultation'])){
        echo '<div class="info-form-all">
        <div class="info-form-head">申し込み情報入力画面</div>
    <form class="info-form-unit" action="check_information.php" method="POST">
        <div class="info-form-each-box-text">お名前<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['お名前'].'" type="text" required name="applicant_name_kanji" class="info-form-each-form">
        <div class="info-form-each-box-text">フリガナ<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['フリガナ'].'" type="text" required name="applicant_name_furigana" class="info-form-each-form">
        <div class="info-form-each-box-text">メールアドレス<span>(必須)(半角)</span></div>
        <input value="'.$_SESSION['information_array']['メールアドレス'].'" type="email" required name="applicant_email_address" class="info-form-each-form">
        <div class="info-form-each-box-text">電話番号<span>(必須)(半角)(-なし)</span></div>
        <input value="'.$_SESSION['information_array']['電話番号'].'" type="tel" id="phone_number" minlength="11" maxlength="11" required name="applicant_phone_number" class="info-form-each-form">
        <div class="info-form-each-box-text">大学名<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['大学名'].'" type="text" required name="applicant_university" class="info-form-each-form">
        <div class="info-form-each-box-text">学部名<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['学部名'].'" type="text" required name="applicant_gakubu" class="info-form-each-form">
        <div class="info-form-each-box-text">学科名<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['学科名'].'" type="text" required name="applicant_gakka" class="info-form-each-form">
        <div class="info-form-each-box-text">何年卒<span>(必須)(半角)(例：' .date('Y').'年4月に大学4年生の場合は('. (date('Y') + 1).'年卒)</span></div>
        <input value="'.$_SESSION['information_array']['何年卒'].'" type="text" id="graduation_year" maxlength="4" minlength="4" required name="applicant_graduation_year" class="info-form-each-form">
        <div class="info-form-each-box-text">郵便番号<span>(必須)(半角)(ハイフンなし)</span></div>
        <div style="display:flex;">
            <input value="'.$_SESSION['information_array']['郵便番号'].'" required  maxlength="7" minlength="7" name="applicant_postal_code" id="postal_code" type="text" name="zipcode" value="" placeholder="例)8120012" class="info-form-each-form">
            <button id="search" type="button" class="info-form-address-search-btn">住所検索</button>
            <p id="error"></p>
        </div>
        <div class="info-form-each-box-text" class="info-form-each-form">都道府県<span>(必須)</span>
        </div>
        <input value="'.$_SESSION['information_array']['都道府県'].'" required id="address1" type="text" name="address1" value="" class="info-form-each-form">
        <div class="info-form-each-box-text">市区町村<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['市区町村'].'" required id="address2" type="text" name="address2" value="" name="市区町村" class="info-form-each-form">
        <div class="info-form-each-box-text">町域名<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['町域名'].'" required id="address3" type="text" name="address3" value="" name="町域名" class="info-form-each-form">
        <div class="info-form-each-box-text">番地など<span>(必須)</span></div>
        <input value="'.$_SESSION['information_array']['番地など'].'" required name="address4" class="info-form-each-form">
        <div class="info-form-each-box-text">自由記入欄</div>
        <div id="select_agent" class="info-form-free-box" style="flex-direction:column;width:80%;">';
                foreach($_SESSION['consultation'] as $consultation){
                    echo '<div id="hide_consultation'.$consultation['id'].'" style="padding:10px;border:1px solid black;border-radius:5px;cursor:hand;cursor:pointer;" hidden>'.$consultation['name'].'に対しての自由記入欄を非表示にする</div>';
                    echo '<div id="show_consultation'.$consultation['id'].'" style="padding:10px;border:1px solid black;border-radius:5px;cursor:hand;cursor:pointer;">'.$consultation['name'].'に対しての自由記入欄を表示する</div>';
                        echo '<div id="consultation'.$consultation['id'].'" hidden><textarea style="width:100%;" rows="2" name="consultation'.$consultation['id'].'">'.$consultation['consultation'].'</textarea></div>';
                    }
                // 追加する押したらinput(ずっとhidden name="consultation_agent_id" value="実際のagent_id")とtextarea(途中までhidden name="consultation実際のagent_id")追加。選択しているエージェント数をクリックできる回数の上限とする。
                //当然テキストエリア削除ボタンも必要なわけでそれ押したら追加する押した回数を回復する。そのときにagent_idと紐づけるの忘れないように.もう一度追加したくなった場合agent_idと紐づいてるように
                //POSTではinputのvalueと一致する$_POST['consultation'.$index]をfor文を回すことでさがす。さがすとき選択しているエージェント一覧の配列をforeachで回すと処理数少なくできる -->
            echo '</div>
            <div class="info-form-each-box-text">プライバシーポリシーに同意<span>(必須)</span></div>
            <label class="info-form-privacy-agree">
                <input name="プライバシーポリシー" type="checkbox" required checked>
                私はプライバシーポリシーに同意します
            </label>
            <div class="info-form-privacy-box">&gt;&gt;<a href="privacy_policy.php" target="_blank" rel="noopener noreferrer" class="info-form-privacy">プライバシーポリシーはこちら</a></div>
            <div style="text-align:center;">
            <input type="submit" value="内容確認へ" class="info-form-check-btn">
            </div>
        </form>
    </div>';
    }else{
        echo '
        <div class="info-form-all">
            <div class="info-form-head">申し込み情報入力画面</div>
        <form class="info-form-unit" action="check_information.php" method="POST">
            <div class="info-form-each-box-text">お名前<span>(必須)</span></div>
            <input type="text" required name="applicant_name_kanji" class="info-form-each-form">
            <div class="info-form-each-box-text">フリガナ<span>(必須)</span></div>
            <input type="text" required name="applicant_name_furigana" class="info-form-each-form">
            <div class="info-form-each-box-text">メールアドレス<span>(必須)(半角)</span></div>
            <input type="email" required name="applicant_email_address" class="info-form-each-form">
            <div class="info-form-each-box-text">電話番号<span>(必須)(半角)(-なし)</span></div>
            <input type="tel" id="phone_number" minlength="11" maxlength="11" required name="applicant_phone_number" class="info-form-each-form">
            <div class="info-form-each-box-text">大学名<span>(必須)</span></div>
            <input type="text" required name="applicant_university" class="info-form-each-form">
            <div class="info-form-each-box-text">学部名<span>(必須)</span></div>
            <input type="text" required name="applicant_gakubu" class="info-form-each-form">
            <div class="info-form-each-box-text">学科名<span>(必須)</span></div>
            <input type="text" required name="applicant_gakka" class="info-form-each-form">
            <div class="info-form-each-box-text">何年卒<span>(必須)(半角)(例：' .date('Y').'年4月に大学4年生の場合は('. (date('Y') + 1).'年卒)</span></div>
            <input type="text" id="graduation_year" maxlength="4" minlength="4" required name="applicant_graduation_year" class="info-form-each-form">
            <div class="info-form-each-box-text">郵便番号<span>(必須)(半角)(ハイフンなし)</span></div>
            <div style="display:flex;">
                <input required  maxlength="7" minlength="7" name="applicant_postal_code" id="postal_code" type="text" name="zipcode" value="" placeholder="例)8120012" class="info-form-each-form">
                <button id="search" type="button" class="info-form-adress-search-btn">住所検索</button>
                <p id="error"></p>
            </div>
            <div class="info-form-each-box-text" class="info-form-each-form">都道府県<span>(必須)</span>
            </div>
            <input required id="address1" type="text" name="address1" value="" class="info-form-each-form">
            <div class="info-form-each-box-text">市区町村<span>(必須)</span></div>
            <input required id="address2" type="text" name="address2" value="" name="市区町村" class="info-form-each-form">
            <div class="info-form-each-box-text">町域名<span>(必須)</span></div>
            <input required id="address3" type="text" name="address3" value="" name="町域名" class="info-form-each-form">
            <div class="info-form-each-box-text">番地など<span>(必須)</span></div>
            <input required name="address4" class="info-form-each-form">
            <div class="info-form-each-box-text">自由記入欄</div>
            <div id="select_agent" class="info-form-free-box" style="flex-direction:column;width:80%;">';
                $_SESSION['id_name_set']=[];
                foreach($_SESSION['apply_list'] as $agent){
                    $agent_name_stmt=$db->query("select agent_name from picture where agent_id=".$agent.";");
                    $agent_name=$agent_name_stmt->fetchAll()[0]['agent_name'];
                    $_SESSION['id_name_set'][]=[$agent,$agent_name];
                    echo '<div id="hide_consultation'.$agent.'" style="padding:10px;border:1px solid black;border-radius:5px;cursor:hand;cursor:pointer;" hidden>'.$agent_name.'に対しての自由記入欄を非表示にする</div>';
                    echo '<div id="show_consultation'.$agent.'" style="padding:10px;border:1px solid black;border-radius:5px;cursor:hand;cursor:pointer;">'.$agent_name.'に対しての自由記入欄を表示する</div>';
                        echo '<div id="consultation'.$agent.'" hidden><textarea style="width:100%;" rows="2" name="consultation'.$agent.'"></textarea></div>';
                    }
                // 追加する押したらinput(ずっとhidden name="consultation_agent_id" value="実際のagent_id")とtextarea(途中までhidden name="consultation実際のagent_id")追加。選択しているエージェント数をクリックできる回数の上限とする。
                //当然テキストエリア削除ボタンも必要なわけでそれ押したら追加する押した回数を回復する。そのときにagent_idと紐づけるの忘れないように.もう一度追加したくなった場合agent_idと紐づいてるように
                //POSTではinputのvalueと一致する$_POST['consultation'.$index]をfor文を回すことでさがす。さがすとき選択しているエージェント一覧の配列をforeachで回すと処理数少なくできる -->
            echo '</div>
            <div class="info-form-each-box-text">プライバシーポリシーに同意<span>(必須)</span></div>
            <label class="info-form-privacy-agree">
                <input name="プライバシーポリシー" type="checkbox" required>
                私はプライバシーポリシーに同意します
            </label>
            <div class="info-form-privacy-box">&gt;&gt;<a href="privacy_policy.php" target="_blank" rel="noopener noreferrer" class="info-form-privacy">プライバシーポリシーはこちら</a></div>
            <div style="text-align:center;">
            <input type="submit" value="内容確認へ" class="info-form-check-btn">
            </div>
        </form>
    </div>
    ';
}
?>
    <?php require "../parts/footer.php"; ?>
</body>
</html>
<script>
// 住所検索
    let search = document.getElementById('search');
    search.addEventListener('click', () => {

        let api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';
        let error = document.getElementById('error');
        let input = document.getElementById('postal_code');
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
    <?php 
    foreach($_SESSION['apply_list'] as $agent){?>
    document.getElementById('show_consultation<?php echo $agent;?>').addEventListener('click',function(){
        document.getElementById('consultation<?php echo $agent;?>').removeAttribute('hidden');
        //箱表示
        document.getElementById('show_consultation<?php echo $agent;?>').setAttribute('hidden','');
        //表示にするボタンを非表示にする
        document.getElementById('hide_consultation<?php echo $agent;?>').removeAttribute('hidden');
        //非表示にするボタンを表示する
    });
    document.getElementById('hide_consultation<?php echo $agent;?>').addEventListener('click',function(){
        document.getElementById('consultation<?php echo $agent;?>').setAttribute('hidden','');
        //箱表示
        document.getElementById('hide_consultation<?php echo $agent;?>').setAttribute('hidden','');
        //非表示にするボタンを非表示にする
        document.getElementById('show_consultation<?php echo $agent;?>').removeAttribute('hidden');
        //表示するボタンを表示する
    });
    <?php }
    ?>
    document.getElementById('phone_number').addEventListener('keydown',function(){
        if(
            event.keyCode!=48&&
            event.keyCode!=49&&
            event.keyCode!=50&&
            event.keyCode!=51&&
            event.keyCode!=52&&
            event.keyCode!=53&&
            event.keyCode!=54&&
            event.keyCode!=55&&
            event.keyCode!=56&&
            event.keyCode!=57&&
            event.keyCode!=8&&
            event.keyCode!=9&&
            event.keyCode!=13
        ){
            //数字,backspace,enter,tab以外の入力無効
            event.preventDefault();
        }
    });
    document.getElementById('graduation_year').addEventListener('keydown',function(){
        if(
            event.keyCode!=48&&
            event.keyCode!=49&&
            event.keyCode!=50&&
            event.keyCode!=51&&
            event.keyCode!=52&&
            event.keyCode!=53&&
            event.keyCode!=54&&
            event.keyCode!=55&&
            event.keyCode!=56&&
            event.keyCode!=57&&
            event.keyCode!=8&&
            event.keyCode!=9&&
            event.keyCode!=13
        ){
            //数字,backspace,enter,tab以外の入力無効
            event.preventDefault();
        }
    });
    document.getElementById('postal_code').addEventListener('keydown',function(){
        if(
            event.keyCode!=48&&
            event.keyCode!=49&&
            event.keyCode!=50&&
            event.keyCode!=51&&
            event.keyCode!=52&&
            event.keyCode!=53&&
            event.keyCode!=54&&
            event.keyCode!=55&&
            event.keyCode!=56&&
            event.keyCode!=57&&
            event.keyCode!=8&&
            event.keyCode!=9&&
            event.keyCode!=13
        ){
            //数字,backspace,enter,tab以外の入力無効
            event.preventDefault();
        }
    })
    // document.getElementById('create_consultation').onclick = function() {
    //     document.getElementById('select_agent').insertAdjacentHTML('afterend', question_box);
    //     document.getElementById('select_consultation')
    //     //できてる。企業に対する自由記入欄ボタン押したらプルダウンタブで選んだ企業の自由記入欄が増えるinsertAdjacentHTMLのafterbegin。
    //     //できてない。そこで選んだ企業のoptionにはdisabled属性を付与する。同じ企業に複数の記入欄が用意されないように
    // }
</script>