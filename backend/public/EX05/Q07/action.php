<?php

$str = $_POST['str'];

function is_written_string_limit_length($str, $limit)
{
    $length = mb_strlen($str);
    if ($length <= $limit) {
        return true;
    } else {
        return false;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card-header">判定結果</div>
                <div class="card-body">
                    <?php $limit = 50;
                    if (is_written_string_limit_length($str, $limit)) : ?>
                        <p>入力された文字列は<?= $limit ?>文字以内です</p>
                    <?php else : ?>
                        <p>入力された文字列は<?= $limit ?>文字以上あります</p>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
