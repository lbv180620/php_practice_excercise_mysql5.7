<?php

define('MAX_FILE_SIZE', 3 * 1024 * 1024);

if (!function_exists('h')) {
    function h($s)
    {
        echo htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
}

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
                    <div class="card-header">画像のアップロード</div>
                    <div class="card-body">
                        <form action="./action.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE) ?>">
                            <div class="card-group">
                                <label for="image_file">画像ファイルを選択してください</label>
                                <input type="file" name="image_file" id="image_file" class="form-control-file">
                            </div>
                            <input type="submit" value="送信" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>
