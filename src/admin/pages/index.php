<?php
session_start();
require "../parts/admin_post.php";
// require('../dbconnect.php');
// if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
//     $_SESSION['time'] = time();

//     if (!empty($_POST)) {
//         $stmt = $db->prepare('INSERT INTO events SET title=?');
//         $stmt->execute(array(
//             $_POST['title']
//         ));

//         header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index.php');
//         exit();
//     }
// } else {
//     header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
//     exit();
// }
//

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>管理者ログイン</title>
</head>

<body>
    <?php
    require "../../dbconnect.php";
    require "../parts/admin_url.php";
    require "../../function.php";
    require "../parts/header.php";
    require "../parts/index/title_sort.php";
    require "../parts/index/agent_list.php";
    require "../parts/index/pagination.php";
    require "../parts/index/mail_popup.php";
    ?>
<!-- 
    <div>
        <form class="admin-add-agent" action="/admin/index.php" method="POST">
            エージェント追加昨日追加したい
            <br>
            イベント名：<input type="text" name="title" required>
            <input type="submit" value="登録する">
        </form>
        <a class="admin-event-link" href="/index.php">イベント一覧</a>
    </div> -->
</body>

</html>