<?php
require "../dbconnect.php";
$_SESSION['admin_id']=NULL;
$_SESSION['assignee_id']=NULL;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $admin_login_stmt=$db->query("select user_id,user_email,AES_DECRYPT(`user_password`,'ENCRYPT-KEY') from admin_users;");
    $admin_login_data=$admin_login_stmt->fetchAll();
    //管理者メール、パスワード
    foreach($admin_login_data as $admin){
        if($_POST['user_email']==$admin['user_email']&&$_POST['user_password']==$admin["AES_DECRYPT(`user_password`,'ENCRYPT-KEY')"]){
            //入力されたメールアドレスと管理者のメールアドレスが一致していた場合
            //かつパスワードが一致していた場合
            $update_login_bool_stmt=$db->prepare("update admin_users set user_login_bool=true where user_id=?;");
            $update_login_bool_stmt->bindValue(1,$admin['user_id']);
            $update_login_bool_stmt->execute();
            //管理者ログイン時ログインステータスtrueにする=>最終ログインの日時がわかる
            $_SESSION['admin_id']=$admin['user_id'];
            header("Location:../admin/pages/index.php");
        }   
    }
    $agent_assignee_login_stmt=$db->query("select user_id,user_email,AES_DECRYPT(`user_password`,'ENCRYPT-KEY') from agent_users;");
    $agent_assignee_login_data=$agent_assignee_login_stmt->fetchAll();
    //エージェント担当者メール、パスワード
    foreach($agent_assignee_login_data as $assignee){
        if($_POST['user_email']==$assignee['user_email']&&$_POST['user_password']==$assignee["AES_DECRYPT(`user_password`,'ENCRYPT-KEY')"]){
            //入力されたメールアドレスとエージェントのメールアドレスが一致していた場合
            //かつパスワードが一致していた場合
            $_SESSION['assignee_id']=$assignee['user_id'];
            //担当者IDをセッションに保存
            $update_login_bool_stmt=$db->prepare("update agent_users set user_login_bool=true where user_id=?;");
            $update_login_bool_stmt->bindValue(1,$assignee['user_id']);
            $update_login_bool_stmt->execute();
            //エージェント担当者ログイン時ログインステータスtrueにする=>最終ログインの日時がわかる
            $agent_contract_information_stmt=$db->prepare("select * from agent_contract_information where agent_id=?;");
            $agent_contract_information_stmt->bindValue(1,$_SESSION['assignee_id']);
            $agent_contract_information_stmt->execute();
            $agent_contract_information_data=$agent_contract_information_stmt->fetchAll();
            $_SESSION['agent_contract_information']=$agent_contract_information_data;
            //エージェント担当者の属するエージェントの契約情報をセッションに保存
            $agent_assignee_information_stmt=$db->prepare("select * from agent_assignee_information where agent_id=?;");
            $agent_assignee_information_stmt->bindValue(1,$_SESSION['agent_contract_information'][0]['agent_id']);
            $agent_assignee_information_stmt->execute();
            $agent_assignee_information_data=$agent_assignee_information_stmt->fetchAll();
            $_SESSION['agent_assignee_information']=$agent_assignee_information_data;
            //エージェント担当者の属するエージェントの担当者情報をセッションに保存
            $agent_public_information_stmt=$db->prepare("select * from agent_public_information where agent_id=?;");
            $agent_public_information_stmt->bindValue(1,$_SESSION['agent_contract_information'][0]['agent_id']);
            $agent_public_information_stmt->execute();
            $agent_public_information_data=$agent_assignee_information_stmt->fetchAll();
            $_SESSION['agent_public_information']=$agent_public_information_data;
            var_dump($_SESSION['agent_public_information']);
            //エージェント担当者の属するエージェントの掲載情報をセッションに保存
            // header("Location:../agent/pages/index.php?year=".date('Y')."&month=".date('m')."&date=".date('d')."");
        }
    }
}
?>
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
    <link rel="stylesheet" href="../css/login.css">
    <title>ログイン</title>
</head>
<body>
    <?php 
    require "header.php";
    ?>
    <div class="login-all-box">
    <form action="login.php" method="POST" class="login-form">
        <div>
            <p>メールアドレス</p>
            <input name="user_email">
        </div>
        <div>
            <p>パスワード</p>
            <input name="user_password">
        </div>
        <input type="submit" value="ログイン">
        <p>パスワード忘れた場合はこちら</p>
        <p>sample@gmail.com</p>
    </form>
    </div>
    <?php require "footer.php";?>
</body>
</html>