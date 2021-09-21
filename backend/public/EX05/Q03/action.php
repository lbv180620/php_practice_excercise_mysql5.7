<?php

$str = $_POST['str'];

$str_length = mb_strlen($str);
$first_char = mb_substr($str, 0, 1);
$last_char = mb_substr($str, $str_length - 1, 1);
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
                            <th>文字数</th>
                            <th>最初の文字</th>
                            <th>最後の文字</th>
                        </tr>
                        <tr>
                            <td><?= $str_length ?></td>
                            <td><?= $first_char ?></td>
                            <td><?= $last_char ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
