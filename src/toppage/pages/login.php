<?php
session_start();
require "../../dbconnect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $_SESSION['price_per_apply']=$price_per_apply=20000;
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
            //管理者idセッションに保存
            header("Location:/admin/pages/index.php?year=".date('Y')."&month=".date('m')."&date=".date('d')."&agent_id=1");
            break;
        }   
    }
    $agent_assignee_login_stmt=$db->query("select user_id,user_email,AES_DECRYPT(`user_password`,'ENCRYPT-KEY') from agent_users;");
    $agent_assignee_login_data=$agent_assignee_login_stmt->fetchAll();
    //エージェント担当者メール、パスワード
    foreach($agent_assignee_login_data as $assignee){
        if($_POST['user_email']==$assignee['user_email']&&$_POST['user_password']==$assignee["AES_DECRYPT(`user_password`,'ENCRYPT-KEY')"]){
            //入力されたメールアドレスとエージェントのメールアドレスが一致していた場合
            //かつパスワードが一致していた場合
            $_SESSION['agent_email']=$_POST['user_email'];
            $update_login_bool_stmt=$db->prepare("update agent_users set user_login_bool=true where user_id=?;");
            $update_login_bool_stmt->bindValue(1,$assignee['user_id']);
            $update_login_bool_stmt->execute();
            //エージェント担当者ログイン時ログインステータスtrueにする=>最終ログインの日時がわかる
            $agent_id_stmt=$db->prepare("select agent_id from agent_assignee_information where user_id=?;");
            $agent_id_stmt->bindValue(1,$assignee['user_id']);
            $agent_id_stmt->execute();
            $agent_id_data=$agent_id_stmt->fetchAll();
            $_SESSION['agent_id']=$agent_id_data[0]['agent_id'];
            //担当者の所属するエージェントID取得
            $agent_contract_information_stmt=$db->prepare("select * from agent_contract_information where agent_id=?;");
            $agent_contract_information_stmt->bindValue(1,$_SESSION['agent_id']);
            $agent_contract_information_stmt->execute();
            $_SESSION['agent_contract_information']=$agent_contract_information_stmt->fetchAll();
            //エージェント担当者の属するエージェントの契約情報をセッションに保存
            $agent_assignee_information_stmt=$db->prepare("select * from agent_assignee_information where agent_id=?;");
            $agent_assignee_information_stmt->bindValue(1,$_SESSION['agent_id']);
            $agent_assignee_information_stmt->execute();
            $_SESSION['agent_assignee_information']=$agent_assignee_information_stmt->fetchAll();
            //エージェント担当者の属するエージェントの担当者情報をセッションに保存
            $agent_public_information_stmt=$db->prepare("select * from agent_public_information where agent_id=?;");
            $agent_public_information_stmt->bindValue(1,$_SESSION['agent_id']);
            $agent_public_information_stmt->execute();
            $_SESSION['agent_public_information']=$agent_public_information_stmt->fetchAll();
            //エージェント担当者の属するエージェントの掲載情報をセッションに保存
            $agent_address_information_stmt=$db->prepare("select * from agent_address where agent_id=?;");
            $agent_address_information_stmt->bindValue(1,$_SESSION['agent_id']);
            $agent_address_information_stmt->execute();
            $_SESSION['agent_address_information']=$agent_address_information_stmt->fetchAll();
            ///エージェント担当者の属するエージェントの住所情報をセッションに保存
            header("Location:/agent/pages/index.php?year=".date('Y')."&month=".date('m')."&date=".date('d')."");
            break;
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
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/others.css">
    <title>ログイン</title>
</head>
<body>
    <?php 
    require "../parts/header.php";
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
    <?php require "../parts/footer.php";?>
</body>
</html>