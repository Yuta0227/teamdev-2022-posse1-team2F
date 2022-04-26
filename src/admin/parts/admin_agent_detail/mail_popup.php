<section style="display:flex;justify-content:center;">
    <button id="invitation_button<?php echo 1; ?>" style="padding:10px;color:white;background-color:green;border-radius:10px;">特集記事をお願いする</button>
</section>
<section>
    <div id="mail_popup_filter" hidden style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:gray;opacity:50%;"></div>
    <form hidden action="" method="POST" id="mail_form1" style="padding:10px;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:green;">
        <div style="display:flex;">
            <div style="width:90%;font-weight:bold;">送信内容確認</div>
            <div style="width:10%;display:flex;justify-content:right;">
                <div id="close_mail_form1">×</div>
            </div>
        </div>
        <div>
            <div>メールアドレス</div>
            <input value="<?php echo 1;?>">
        </div>
        <div>
            <div>担当者部署</div>
            <input value="担当者部署">
        </div>
        <div>
            <div>担当者指名</div>
            <input value="担当者指名">
        </div>
        <!-- // 企業にメール送信する際担当者の情報って必要か
        // 企業に送るのではなく担当者に直接送るならプルダウンで選ぶ機能必要だと思 -->
        <div>
            <div>特集記事をお願いするメール本文</div>
            <textarea cols="30" rows="5" value="'.'メール文章テンプレ'.'"></textarea>
        </div>
        <input type="submit" value="メール送信">

    </form>
</section>
<script>
    document.getElementById('invitation_button<?php echo 1; ?>').addEventListener('click', function() {
        document.getElementById('mail_popup_filter').removeAttribute('hidden');
        document.getElementById('mail_form<?php echo 1; ?>').removeAttribute('hidden');
    });
    document.getElementById('close_mail_form<?php echo 1; ?>').addEventListener('click', function() {
        document.getElementById('mail_popup_filter').setAttribute('hidden', '');
        document.getElementById('mail_form<?php echo 1; ?>').setAttribute('hidden', '');
    });
</script>