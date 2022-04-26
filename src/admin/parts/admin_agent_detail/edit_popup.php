<section id="edit_popup_filter" style="position:absolute;width:100%;height:100%;background-color:red;top:0;left:0;opacity:50%;" hidden>
<!-- ページ全体にかかるフィルターつける -->
<form id="edit_public_information_form" hidden>
    <table>
        <tr>
            <th></th><td></td>
        </tr>
    </table>
    <div>
        <input value="編集確定">
    </div>
</form>
<form id="edit_agent_explanation_form" hidden></form>
</section>
<script>
    //契約情報に編集ボタンの必要性を感じなかった。担当者についてはエージェント画面で編集追加削除できるし契約情報そんな簡単に触れちゃうのよくない気がする。間違えて契約解除日いじったら取返しつかないし
    document.getElementById('edit_public_information_button').addEventListener('click',function(){
        document.getElementById('edit_popup_filter').removeAttribute('hidden');
        document.getElementById('edit_public_information_form').removeAttribute('hidden');
    })
    document.getElementById('edit_agent_explanation_button').addEventListener('click',function(){
        document.getElementById('edit_popup_filter').removeAttribute('hidden');
        document.getElementById('edit_public_information_form').removeAttribute('hidden');
    })
</script>