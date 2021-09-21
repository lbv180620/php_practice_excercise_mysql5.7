<?php

$dt = new DateTime();

$now = $dt->format('Y年m月d日 H時i分s秒');

function getWeekday($num)
{
    switch ($num) {
        case 0:
            $w = '日曜日';
            break;
        case 1:
            $w = '月曜日';
            break;
        case 2:
            $w = '火曜日';
            break;
        case 3:
            $w = '水曜日';
            break;
        case 4:
            $w = '木曜日';
            break;
        case 5:
            $w = '金曜日';
            break;
        case 6:
            $w = '土曜日';
            break;
        default:
            $w = '';
    }
    return $w;
}

$weekday = getWeekday($dt->format('w'));




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
                        <table class="table">
                            <tr>
                                <th>現在日時</th>
                                <td><?= $now ?></td>
                            </tr>
                            <tr>
                                <th>今日の曜日</th>
                                <td><?= $weekday ?></td>
                            </tr>
                            <tr>
                                <th>日本標準時</th>
                                <td>
                                    <?php

                                    $dt->setTimezone(new DateTimeZone('Asia/Tokyo'));
                                    echo $dt->format('Y年m月d日 H時i分s秒');

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>世界標準時</th>
                                <td>
                                    <?php

                                    $dt->setTimezone(new DateTimeZone('UTC'));
                                    echo $dt->format('Y年m月d日 H時i分s秒');


                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
