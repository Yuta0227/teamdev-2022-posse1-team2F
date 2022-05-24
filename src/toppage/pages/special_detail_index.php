<?php
session_start();
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
    <link rel="stylesheet" href="../../css/special.css">
    <title>特集詳細</title>
</head>

<body>
    <?php require "../parts/header.php"; ?>
    <section class="special-detail-all">
        <div class="special-detail-all-box">
            <div style="display:flex;">
                <div class="special-detail-img-box">
                    <img alt="画像" src="../../img/dummy.png" class="special-detail-img">
                </div>
                <div class="special-detail-header-box">
                    <h1 class="special-detail-header">タイトル</h1>
                </div>
            </div>
            <?php
            $question_answer_array = [
                ["question" => "質問文1", "answer" => "答え1"],
                ["question" => "質問文2", "answer" => "答え2"],
                ["question" => "最後に一言", "answer" => "答え3"],
            ]; //データベースからとってくる
            foreach ($question_answer_array as $question_answer) {
                echo '<div><p class="special-detail-question">Q.';
                echo $question_answer["question"];
                echo '</p></div>';
                echo '<div><p class="special-detail-answer">A.';
                echo $question_answer["answer"];
                echo '</p></div>';
            };
            ?>
            <form method="POST" style="display:flex;justify-content:center;">
                <div style="text-align:center;">
                    <input  class="special-detail-choice-btn" type="submit" value="このエージェントをお気に入りに追加">
                    <div class="special-detail-transition">
                        <a href="">企業の詳細ページへ</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php require "../parts/footer.php"; ?>
</body>

</html>