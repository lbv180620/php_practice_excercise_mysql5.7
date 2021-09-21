<?php

$dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
$today = $dt->format('Y-m-d');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        #expiration_date {
            width: 12rem;
        }

        #todo_item {
            width: 25rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row my-3 justify-content-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TODOリスト</div>
                    <div class="card-body">
                        <form action="./add.php" method="post" class="form-inline">
                            <div class="form-group mb-3 mr-1">
                                <label for="expiration_date" class="sr-only"> 期限日</label>
                                <input type="date" name="expiration_date" id="expiration_date" value="<?= $today ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3 mr-1">
                                <label for="todo_item" class="sr-only">TODO項目</label>
                                <input type="text" name="todo_item" id="todo_item" placeholder="TODO項目を入力してください" class="form-control">
                            </div>
                            <input type="submit" value="追加" class="btn btn-primary mb-3">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>

</html>
