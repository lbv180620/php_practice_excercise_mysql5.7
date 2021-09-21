<?php
$nums = [
    $_POST['num1'],
    $_POST['num2'],
    $_POST['num3'],
];

function produceMaximum($ary)
{
    sort($ary);
    return $ary[count($ary) - 1];
}

function produceMinimum($ary)
{
    sort($ary);
    return $ary[0];
}

function produceAverage($ary)
{
    $sum = 0;
    foreach ($ary as $val) {
        $sum += $val;
    }
    return round($sum / count($ary));
}

$max = produceMaximum($nums);
$min = produceMinimum($nums);
$avg = produceAverage($nums);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題05設問01</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>最大値</th>
                                <th>最小値</th>
                                <th>平均値</th>
                            </tr>
                            <tr>
                                <td><?= $max ?></td>
                                <td><?= $min ?></td>
                                <td><?= $avg ?></td>
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
