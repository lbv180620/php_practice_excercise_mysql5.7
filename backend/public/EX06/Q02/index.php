<?php

session_start();

session_regenerate_id();

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
} else {
    $_SESSION['count']++;
}

if (isset($_SESSION['count']) && isset($_GET['reset'])) {
    unset($_SESSION['count']);
    $_SESSION['count'] = 0;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題06設問02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card my-3">
                    <div class="card-header">セッションを使ったカウンタ</div>
                    <div class="card-body">
                        <p><?= $_SESSION['count'] ?></p>
                        <a href="./" class="btn btn-primary">カウント</a>
                        <a href="./?reset" class="btn btn-outline-primary">リセット</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
