<?php

$menus = array(
    'Aランチ',
    'Bランチ',
    'Cランチ',
    '唐揚げ定食',
    'とんかつ定食',
    'エビフライ定食',
    'オムライス',
    'カレーライス',
    'ごはん大',
    'ごはん小',
    'ビール',
    '烏龍茶',
);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題04設問06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="./action.php" method="post">
                            <div class="form-group">
                                <label for="menu">メニューを選択してください</label>
                                <select multiple="multiple" name="menu[]" id="menu" class="form-control" size="12">
                                    <?php foreach ($menus as $menu) : ?>
                                        <option value="<?= $menu ?>"><?= $menu ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <input type="submit" value="送信" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
