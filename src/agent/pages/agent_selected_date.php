<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント画面特定日の申込一覧</title>
</head>
<body>
    <?php 
    require "../parts/url.php";
    require "../parts/agent_header.php";
    require "../parts/agent_new_apply.php";
    echo '<div>'.$_GET['year'].'年'.$_GET['month'].'月'.$_GET['date'].'日の申込一覧</div>';
    echo '<table>';
    echo '    <tr>';
    echo '        <th>申込日時</th>';
    echo '        <th>メールアドレス</th>';
    echo '    </tr>';
    echo '</table>';
    require "../parts/agent_apply.php";
    require "../../toppage/footer.php";
    ?>
</body>
</html>
<script>
    <?php for($index=0;$index<=count($applies_array);$index++) { ?>
        document.getElementById('open_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('open_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('apply_detail<?php echo $index; ?>').removeAttribute('hidden');
        });
        document.getElementById('close_apply<?php echo $index; ?>').addEventListener('click', function() {
            document.getElementById('close_apply<?php echo $index; ?>').setAttribute('hidden', '');
            document.getElementById('open_apply<?php echo $index; ?>').removeAttribute('hidden');
            document.getElementById('apply_detail<?php echo $index; ?>').setAttribute('hidden', '');
        });
    <?php }; ?>
</script>