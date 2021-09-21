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
                                <label for="">日付を入力してください</label>
                                <input type="text" name="date" id="date" value="<?= $today ?>" class="form-control my-2">
                            </div>
                            <div class="form-group">
                                <label for="">期間（日）を入力してください</label>
                                <input type="text" name="period" id="period" class="form-control my-2">
                            </div>
                            <div class="form-group form-check-inline">
                                <input type="radio" name="before_or_after" id="before_or_after1" value="前" class="form-check-input">
                                <label for="before_or_after1" class="form-check-label">前</label>
                            </div>
                            <div class="form-group form-check-inline">
                                <input type="radio" name="before_or_after" id="before_or_after2" value="後" class="form-check-input">
                                <label for="before_or_after2" class="form-check-label">後</label>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="送信" class="btn btn-primary mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
