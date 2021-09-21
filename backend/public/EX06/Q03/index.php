<?php

$products = [
    [
        'product_name' => 'みかん',
        'price' => 300,
    ],
    [
        'product_name' => 'りんご',
        'price' => 500,
    ],
    [
        'product_name' => 'バナナ',
        'price' => 150,
    ],
];

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
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>注文数</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <form action="./cart_add.php" method="post">
                                        <tr>
                                            <td>
                                                <?= $product['product_name'] ?>
                                                <input type="hidden" name="product-name" value="<?= $product['product_name'] ?>">
                                            </td>
                                            <td>
                                                <?= $product['price'] ?>円
                                                <input type="hidden" name="price" value="<?= $product['price'] ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="quantity" class="form-control" style="width: 3rem; text-align: right;">
                                            </td>
                                            <td>
                                                <input type="submit" value="カートに入れる" class="btn btn-primary">
                                            </td>
                                        </tr>
                                    </form>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <a href="./cart_show.php" style="text-decoration: none;">カートを見る</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
