<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>特集詳細</title>
</head>
<body>
    <?php require "../parts/header.php";?>
    <div style="display:flex;">
        <div>
            <img alt="画像">
        </div>
        <div>
            <h1 style="border-bottom:1px solid black;">タイトル</h1>
        </div>
    </div>
    <?php 
    $question_answer_array=[
        ["question"=>"質問文1","answer"=>"答え1"],
        ["question"=>"質問文2","answer"=>"答え2"],
        ["question"=>"最後に一言","answer"=>"答え3"],
    ];//データベースからとってくる
    foreach($question_answer_array as $question_answer){
        echo '<div><p style="border-bottom:1px black solid;">Q.';
        echo $question_answer["question"];
        echo '</p></div>';
        echo '<div><p>A.';
        echo $question_answer["answer"];
        echo '</p></div>';
    };
    ?>
    <form method="POST" style="display:flex;justify-content:center;">
    <div>
        <input style="color:white;background-color:green;" type="submit" value="このエージェントを選択">
        <div>
            <a href="">企業の詳細ページへ</a>
        </div>
    </div>
    </form>
    <?php require "../parts/footer.php";?>
</body>
</html>