<?php

session_start();

session_regenerate_id();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .num {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>注文数</th>
                                <th>小計</th>
                                <th></th>
                            </thead>
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
                                <tbody>
                                    <?php $total = 0;
                                    foreach ($_SESSION['cart'] as $k => $v) : ?>
                                        <?php
                                        $subtotal = $v['price'] * $v['quantity'];
                                        $total += $subtotal;
                                        ?>
                                        <tr>
                                            <td class="num">
                                                <?= $v['product-name'] ?>
                                                <input type="hidden" name="product-name" value="<?= $v['product-name'] ?>">
                                            </td>
                                            <td class="num">
                                                <?= $v['price'] ?>
                                                <input type="hidden" name="price" value="<?= $v['price'] ?>">
                                            </td>
                                            <td class="num">
                                                <?= $v['quantity'] ?>個
                                                <input type="hidden" name="quantity" value="<?= $v['quantity'] ?>">
                                            </td>
                                            <td>
                                                <?= $subtotal ?>円
                                            </td>
                                            <td>
                                                <input type="hidden" name="id" value="$k">
                                                <input type="submit" value="削除" class="btn btn-primary">
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            <?php endif ?>
                        </table>
                        <p>合計金額: <?= $total ?>円</p>
                        <p><a href="./cart_dell_all.php" style="text-decoration: none;">カートを空にする</a></p>
                        <p><a href="./" style="text-decoration: none;">戻る</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
