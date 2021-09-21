<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題03設問08</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        th,
        td {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <table class="table table-bordered my-3">
                    <?php for ($row = 0; $row < 10; $row++) : ?>
                        <tr>
                            <?php for ($col = 0; $col < 10; $col++) : ?>
                                <?php if ($row == 0 && $col == 0) : ?>
                                    <th class="table-primary"></th>
                                <?php elseif ($row == 0) : ?>
                                    <th class="table-primary"><?= $col ?></th>
                                <?php elseif ($col == 0) : ?>
                                    <th class="table-primary"><?= $row ?></th>
                                <?php else : ?>
                                    <?php $ret = $row * $col;
                                    if ($ret % 2 == 0) : ?>
                                        <td class="table-active"><?= $ret ?></td>
                                    <?php else : ?>
                                        <td><?= $ret ?></td>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endfor ?>
                        </tr>
                    <?php endfor ?>
                </table>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
