<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/top.css">
    <link rel="stylesheet" href="../css/others.css">
    <title>ログイン</title>
</head>
<body>
    <?php require "header.php";?>
    <div class="login-all-box">
    <form class="login-form">
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
    </div>
    <?php require "footer.php";?>
</body>
</html>