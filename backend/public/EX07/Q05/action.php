<?php

$dt = new DateTime($_POST['date'], new DateTimeZone('Asia/Tokyo'));

$period = new DateInterval('P' . $_POST['period'] . 'D');


switch ($_POST['before_or_after']) {
    case '前':
        $dt->sub($period);
        break;
    case '後':
        $dt->add($period);
        break;
    default:
        break;
}

$str = $_POST['date'] . 'の' . $_POST['period'] . '日' . $_POST['before_or_after'] . 'は';

$date = $dt->format('Y/m/d');

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
                <div class="card">
                    <div class="card-body">
                        <p><?= $str ?></p>
                        <p><?= $date ?></p>
                        <p>です</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
