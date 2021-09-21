<?php

session_start();

session_regenerate_id();

if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

try {
    if (!strptime($_POST['date'], '%Y/%m/%d')) {
        throw new Exception('日付の形式が正しくありません');
    } elseif (!isDate($_POST['date'])) {
        throw new Exception('存在しない日付です');
    }
} catch (Exception $e) {
    $_SESSION['error']['msg'] = $e->getMessage();
    $_SESSION['error']['date'] = $_POST['date'];
    header('Location: ./');
    exit;
}

function isDate($date)
{
    list($Y, $m, $d) = explode('/', $date);
    return checkdate($m, $d, $Y);
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">判定結果</div>
                    <div class="card-body">
                        正しい日付です
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
