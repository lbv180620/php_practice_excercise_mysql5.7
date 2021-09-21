<?php

require_once('./Taiyaki.php');
require_once('./TaiyakiProduct.php');

$konaType = '普通の小麦粉';
$annType = 'つぶあん';
$obj = new Taiyaki($konaType, $annType);
$taiyaki = $obj->bake();

$konaType1 = '普通の小麦粉';
$annType1 = 'チョコレート';
$konaQuantity1 = 100;
$num1 = 1;

$obj1 = new TaiyakiProduct($konaType1, $annType1, $konaQuantity1, $num1);
$taiyaki1 = $obj1->bake();

$konaType2 = 'たい焼き専用粉';
$annType2 = 'カスタードクリーム';
$konaQuantity2 = 200;
$num2 = 2;

$obj2 = new TaiyakiProduct($konaType2, $annType2, $konaQuantity2, $num2);
$taiyaki2 = $obj2->bake();

$konaType3 = '特別ブレンド小麦';
$annType3 = '北海道産小豆のこしあん';
$konaQuantity3 = 300;
$num3 = 3;

$obj3 = new TaiyakiProduct($konaType3, $annType3, $konaQuantity3, $num3);
$taiyaki3 = $obj3->bake();

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
                    <div class="card-header">たい焼き焼けましたよ</div>
                    <div class="card-body">
                        <p>とりあえず焼いてみた</p>
                        <p><?= $taiyaki ?></p>
                        <hr>
                        <p>１個目</p>
                        <p><?= $taiyaki1 ?></p>
                        <hr>
                        <p>２個目</p>
                        <p><?= $taiyaki2 ?></p>
                        <hr>
                        <p>３個目</p>
                        <p><?= $taiyaki3 ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
