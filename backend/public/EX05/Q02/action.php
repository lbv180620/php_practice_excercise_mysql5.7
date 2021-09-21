<?php

$num = $_POST['num'];

$ceil = ceil($num);
$floor = floor($num);
$round = round($num);
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
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>切り上げ</th>
                            <th>切り捨て</th>
                            <th>四捨五入</th>
                        </tr>
                        <tr>
                            <td><?= $ceil ?></td>
                            <td><?= $floor ?></td>
                            <td><?= $round ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
