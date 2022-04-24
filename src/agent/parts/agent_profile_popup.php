<section>
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-color:blue;opacity:50%;"></div>
    <!--青のフィルター。色は適当  -->
    <form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;">
        <table>
            <tr>
                <th><?php echo $agent_assignee_array[0]['部署'];?></th><td></td>
            </tr>
        </table>
    </form>
    <!-- 追加ポップアップ -->
    <form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;"></form>
    <!-- 編集ポップアップ -->
    <form style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;width:400px;height:400px;opacity:100%;z-index:5;"></form>
    <!-- 削除ポップアップ -->
</section>