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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">CSVファイルのアップロード</div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['err']['msg'])) : ?>
                            <div class="alert alert-danger" role="danger">
                                <?= $_SESSION['err']['msg'] ?>
                            </div>
                        <?php endif ?>
                        <form action="./update.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="csv-file">CSVファイルを選択してください</label>
                                <input type="file" name="csv_file" id="csv-file" class="form-control-file">
                            </div>
                            <input type="submit" value="送信" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="./">←もどる</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
