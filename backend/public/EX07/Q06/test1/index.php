<?php

$date = 0;

//今月のカレンダー表示

// 2021/09/09
$dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));

// 09 (2021/09/09)
$today = $dt->format('d');

// 2021/09/01
$dt->sub(new DateInterval('P' . ($today - 1) . 'D'));

// 3 (2021/09/01 水)
$weekdayOfTheFirstDay = $dt->format('w');

// 30 (9月の日数)
$daysOfTheMonth = $dt->format('t');

$weeksOfTheMonth = ceil(($weekdayOfTheFirstDay + $daysOfTheMonth) / 7);

// 2020年9月
$thisMonth = $dt->format('Y年n月');

// ------------------

// 先月、来月も表示する

// 今月を0、先月を-1、来月を1とする

$month = 0;

// -----------------

// 以上以外の月も表示していく


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
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <?= $thisMonth ?>
                    </div>
                    <div class="card-body">
                        <table class='table table-bordered'>
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            <?php for ($week = 0; $week < $weeksOfTheMonth; $week++) : ?>
                                <tr>
                                    <?php for ($day = 0; $day < 7; $day++) : ?>
                                        <td>
                                            <?php if ($week == 0 && $day >= $weekdayOfTheFirstDay) : ?>
                                                <?= ++$date ?>
                                            <?php elseif ($week > 0 && $date < $daysOfTheMonth) : ?>
                                                <?= ++$date ?>
                                            <?php endif ?>
                                        </td>
                                    <?php endfor ?>
                                </tr>
                            <?php endfor ?>
                        </table>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <a href="./" class="btn btn-outline-primary" style="text-decoration: none;">&lt;&lt;前の月</a>
                        <a href="./" class="btn btn-primary" style="text-decoration: none;">今月</a>
                        <a href="./" class="btn btn-outline-primary" style="text-decoration: none;">次の月&gt;&gt;</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
