<?php
session_start();
require "../../function.php";
require "../../dbconnect.php";
require "../parts/agent_post.php";
if(!isset($_SESSION['user_id'])||!isset($_SESSION['agent_contract_information'])||!isset($_SESSION['agent_public_information'])||!isset($_SESSION['agent_address_information'])||!isset($_SESSION['agent_email'])||!isset($_SESSION['agent_id'])||!isset($_SESSION['agent_name'])){
    header("Location: /toppage/pages/login.php");
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><!-- datalabelsプラグインを呼び出す -->
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/top.css">
    <link rel="stylesheet" href="../../css/agent.css">
    <title>エージェントプロフィール</title>
</head>

<body style="display:flex;flex-direction:column;justify-content:center;width:100%;height:100%;position:relative;">
    <?php
    require "../parts/agent_header.php";
    ?>
    <section>
        <h1 class="agent-profile-head"><?php echo $_SESSION['agent_contract_information'][0]['agent_name']; ?>さんのプロフィール</h1>
    </section>
    <?php
    require "../parts/agent_public_information.php";
    require "../parts/agent_private_information.php";
    require "../parts/agent_profile_popup.php";
    ?>
    <?php require "../../toppage/parts/footer.php"; ?>
</body>


</html>