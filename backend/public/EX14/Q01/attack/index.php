<?php

$dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
$today = $dt->format('Y/m/d');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">TODOリストの期限日で検索</div>
                    <div class="card-body">
                        <form action="./show.php" method="post">
                            <div class="form-group">
                                <label for="date">検索日</label>
                                <input type="text" name="date" id="date" class="form-control" value="<?= $today ?>">
                            </div>
                            <input type="submit" value="検索" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
