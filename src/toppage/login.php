<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <?php require "header.php";?>
    <form style="top:50%;left:50%;position:absolute;transform:translate(-50%,-50%);background-color:gray;">
        <div>
            <p>メールアドレス</p>
            <input>
        </div>
        <div>
            <p>パスワード</p>
            <input>
        </div>
        <input type="submit" value="ログイン">
        <p>パスワード忘れた場合はこちら</p>
        <p>sample@gmail.com</p>
    </form>
    <?php require "footer.php";?>
</body>
</html>