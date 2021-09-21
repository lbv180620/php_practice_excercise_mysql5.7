<?php

$menuNum = $_POST['menu'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>練習問題03設問04</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>お客様がえらばれたのは<b>
                                <?php

                                switch ($menuNum) {
                                    case 1:
                                        echo 'ラーメン';
                                        break;

                                    case 2:
                                        echo 'チャーシュー麺';
                                        break;

                                    case 3:
                                        echo 'こってりラーメン';
                                        break;

                                    case 4:
                                        echo '味玉ラーメン';
                                        break;

                                    case 5:
                                        echo '味噌ラーメン';
                                        break;

                                    case 6:
                                        echo '特製ラーメン';
                                        break;

                                    default:
                                        echo 'メニューが選ばれていません。';
                                        break;
                                }

                                ?>
                            </b>です。</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
