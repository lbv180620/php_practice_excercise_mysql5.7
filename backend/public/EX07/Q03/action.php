<?php

require_once('./Menu.php');
require_once('./Noodle.php');
require_once('./Drink.php');


$noodle = new Noodle($_POST['category'][0], $_POST['menu'][0], $_POST['option'][0], $_POST['price'][0],);
$dataNoodle = $noodle->getData();

$drink = new Drink($_POST['category'][1], $_POST['menu'][1], $_POST['option'][1], $_POST['price'][1],);
$dataDrink = $drink->getData();

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
        <div class="row my-3">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <?php foreach ($dataNoodle as $k => $v) : ?>
                                <tr>
                                    <th><?= $k ?></th>
                                    <td><?= $v ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <?php foreach ($dataDrink as $k => $v) : ?>
                                <tr>
                                    <th><?= $k ?></th>
                                    <td><?= $v ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
