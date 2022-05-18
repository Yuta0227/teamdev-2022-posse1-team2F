<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // error_reporting(0);
    if(isset($_POST['list'])){
        header("Location: index.php");
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: ../../toppage/pages/login.php");
    }
    if(isset($_POST['面談方式'])&&isset($_POST['主な取り扱い企業規模'])&&isset($_POST['取り扱い企業カテゴリー'])&&isset($_POST['内定率(%)'])&&isset($_POST['内定最短期間(週)'])&&isset($_POST['prefecture'])&&isset($_POST['student_type'])&&isset($_POST['manufacturer'])&&isset($_POST['retail'])&&isset($_POST['service'])&isset($_POST['software_transmission'])&&isset($_POST['trading'])&&isset($_POST['finance'])&&isset($_POST['media'])&&isset($_POST['government'])){
        $edit_public_stmt=$db->prepare("update agent_public_information set agent_meeting_type=?,agent_main_corporate_size=?,agent_corporate_type=?,agent_job_offer_rate=?,agent_shortest_period=? where agent_id=?;");
        $edit_public_stmt->bindValue(1,$_POST['面談方式']);
        $edit_public_stmt->bindValue(2,$_POST['主な取り扱い企業規模']);
        $edit_public_stmt->bindValue(3,$_POST['取り扱い企業カテゴリー']);
        $edit_public_stmt->bindValue(4,$_POST['内定率(%)']);
        $edit_public_stmt->bindValue(5,$_POST['内定最短期間(週)']);
        $edit_public_stmt->bindValue(6,$_GET['agent_id']);
        $edit_public_stmt->execute();
        //存在する拠点取得
        $check_prefecture_stmt=$db->prepare("select prefecture_id from agent_address where agent_id=?;");
        $check_prefecture_stmt->bindValue(1,$_GET['agent_id']);
        $check_prefecture_stmt->execute();
        $check_prefecture_data=[];
        foreach($check_prefecture_stmt->fetchAll() as $prefecture){
            array_push($check_prefecture_data,$prefecture['prefecture_id']);
        }
        //送信内容との差分取得(何が追加されたか)
        $add_prefecture=array_diff($_POST['prefecture'],$check_prefecture_data);
        //送信内容との差分取得(何が削除されたか)
        $delete_prefecture=array_diff($check_prefecture_data,$_POST['prefecture']);        
        foreach($add_prefecture as $prefecture_id){
            //拠点追加
            $area_stmt=$db->prepare("select area_name,prefecture_name from filter_prefecture where prefecture_id=?;");
            $area_stmt->bindValue(1,$prefecture_id);
            $area_stmt->execute();
            $area_data=$area_stmt->fetchAll();
            $edit_address_stmt=$db->prepare("insert into agent_address(prefecture_id,agent_id,agent_area,agent_prefecture) values (?,?,?,?);");
            $edit_address_stmt->bindValue(1,$prefecture_id);
            $edit_address_stmt->bindValue(2,$_GET['agent_id']);
            $edit_address_stmt->bindValue(3,$area_data[0]['area_name']);
            $edit_address_stmt->bindValue(4,$area_data[0]['prefecture_name']);
            $edit_address_stmt->execute();
        }
        foreach($delete_prefecture as $prefecture_id){
            //拠点削除
            $area_stmt=$db->prepare("select area_name,prefecture_name from filter_prefecture where prefecture_id=?;");
            $area_stmt->bindValue(1,$prefecture_id);
            $area_stmt->execute();
            $area_data=$area_stmt->fetchAll();
            $edit_address_stmt=$db->prepare("delete from agent_address where agent_id=? and prefecture_id=?;");
            $edit_address_stmt->bindValue(1,$_GET['agent_id']);
            $edit_address_stmt->bindValue(2,$prefecture_id);
            $edit_address_stmt->execute();
        }
        header("Location:/admin/pages/admin_agent_detail.php?agent_id=".$_GET['agent_id']."&year=".date('Y')."&month=".date('m'));
    }
    if(isset($_POST['agent_explanation'])){
        //説明文編集
        $update_explanation_stmt=$db->prepare("update agent_explanation set agent_explanation=? where agent_id=?;");
        $update_explanation_stmt->bindValue(1,$_POST['agent_explanation']);
        $update_explanation_stmt->bindValue(2,$_GET['agent_id']);
        $update_explanation_stmt->execute();
    }
    if(isset($_POST['agent_id'])){
        $count_assignee_stmt = $db->prepare("select count(user_id) from agent_assignee_information where agent_id=?;");
        $count_assignee_stmt->bindValue(1, $_POST['agent_id']);
        $count_assignee_stmt->execute();
        $count_assignee_data = $count_assignee_stmt->fetchAll();
        for ($index = 0; $index < $count_assignee_data[0]['count(user_id)']; $index++) {
            if(isset($_POST['address'.$index])&&isset($_POST['text'.$index])){
                mb_language("ja");
                mb_internal_encoding("utf-8");
                $to=$_POST['address'.$index];
                $subject="特集記事招待メール";
                $msg=$_POST['text'.$index];
                $from = $_SESSION['login_admin_email'];
                $header="From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
                if(!mb_send_mail($to,$subject,$msg,$header)){
                echo 'メール送信失敗';
                }
            } 
        } 
    }
    if(isset($_POST['approve_decline_apply_id'])){
        if(isset($_POST['accept_delete_request'])){
            $delete_apply_stmt=$db->prepare("delete from apply_list where apply_id=?;");
            $delete_apply_stmt->bindValue(1,$_POST['approve_decline_apply_id']);
            $delete_apply_stmt->execute();
            //apply_listから消す
            $update_delete_request_stmt=$db->prepare("update delete_request set approve_status=true,check_status=true where apply_id=?;");
            $update_delete_request_stmt->bindValue(1,$_POST['approve_decline_apply_id']);
            $update_delete_request_stmt->execute();
            //delete_requestテーブル更新
            $report_assignee_stmt=$db->prepare("select assignee_email from delete_request where apply_id=?;");
            $report_assignee_stmt->bindValue(1,$_POST['approve_decline_apply_id']);
            $report_assignee_stmt->execute();
            $report_assignee_data=$report_assignee_stmt->fetchAll();
            mb_language("ja");
            mb_internal_encoding("utf-8");
            $to=$report_assignee_data[0]['assignee_email'];
            $subject="通報承認のメール";
            $msg='通報を承認しました。問い合わせ一覧から削除しました。';
            $from = $_SESSION['login_admin_email'];
            $header="From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
            if(!mb_send_mail($to,$subject,$msg,$header)){
            echo 'メール送信失敗';
        }
        //メール送信
    }
    if(isset($_POST['decline_delete_request'])){
        $update_delete_request_stmt=$db->prepare("update delete_request set check_status=true where apply_id=?;");
        $update_delete_request_stmt->bindValue(1,$_POST['approve_decline_apply_id']);
        $update_delete_request_stmt->execute();
        //delete_requestテーブル更新
        $report_assignee_stmt=$db->prepare("select assignee_email from delete_request where apply_id=?;");
        $report_assignee_stmt->bindValue(1,$_POST['approve_decline_apply_id']);
        $report_assignee_stmt->execute();
        $report_assignee_data=$report_assignee_stmt->fetchAll();
        mb_language("ja");
        mb_internal_encoding("utf-8");
        $to=$report_assignee_data[0]['assignee_email'];
        $subject="通報却下のメール";
        $msg='通報を却下しました。問い合わせ一覧から削除してないです。';
        $from = $_SESSION['login_admin_email'];
        $header="From: {$from}\nReply-To: {$from}\nContent-Transfer-Encoding:8bit\r\nContent-Type: text/plain;charset=UTF-8\r\n";
        if(!mb_send_mail($to,$subject,$msg,$header)){
        echo 'メール送信失敗';
    }
        
        }
    }
    //業界別取り扱い企業の編集反映できてない
}
