<?php

$langScore = $_POST['language-score'];
$mathScore = $_POST['math-score'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題03設問02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <?php if ($langScore >= 80 && $mathScore >= 80) : ?>
                            <p><?php echo '素晴らしいです!' ?></p>
                        <?php elseif ($langScore >= 80 || $mathScore >= 80) : ?>
                            <p><?php echo '良しとしましょう!' ?></p>
                        <?php else : ?>
                            <p><?php echo 'まあ、いいでしょう・・・' ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
