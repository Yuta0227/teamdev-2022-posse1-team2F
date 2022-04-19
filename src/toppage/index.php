<?php
session_start();
require("../dbconnect.php");

$stmt = $db->query('SELECT id, title FROM events');
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
</head>
<!-- <ul>
    <?php foreach ($events as $key => $event) : ?>
        <li>
            <?= $event["id"]; ?>:<?= $event["title"]; ?>
        </li>
    <?php endforeach; ?>
    <a href="/admin/index.php">管理者ページ</a>
</ul> -->
<section>
    <!--並び替え、就活ガイド、絞り込み-->
    <div>
        <!--並び替え-->
        <div>
            <!--横並び-->
            <form>
                <div>
                    <select>
                        <option>並び替え条件</option>
                        <option>名前順</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="並び替える">
                </div>
            </form>
        </div>
        <!--絞り込み-->
        <button>絞り込み</button>
        <!--ガイド-->
        <button>どの条件で絞り込めばいいかわからない方はこちら!</button>
    </div>
    <div>検索結果：<span>10</span>/<span>30</span>件</div><!--検索結果下の方に表示した方がいいと思った。レスポンシブの時文字数きついかも。-->
</section>

<body>
</body>

</html>