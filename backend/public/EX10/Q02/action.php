<?php

if (!function_exists('h')) {
    function h($s)
    {
        echo htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
}


$path = dirname(__FILE__) . '/images/';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_FILES['image_file']['error'] === 2) {
            throw new Exception('ファイルサイズを小さくしてください!');
        } elseif ($_FILES['image_file']['size'] === 0) {
            throw new Exception('ファイルを選択してください!');
        } elseif (preg_match('/image\/.*/', $_FILES['image_file']['type']) === 0) {
            throw new Exception('画像ファイルを選択してください!');
        } elseif ($_FILES['image_file']['error'] === 0) {
            move_uploaded_file($_FILES['image_file']['tmp_name'], $path . $_FILES['image_file']['name']);
            if (is_readable($path)) {
                $tmp_files = scandir($path);
                $file_names = [];
                foreach ($tmp_files as $file_name) {
                    if (!preg_match('/^(\.|\.\.)/', $file_name) && is_file(dirname(__FILE__) . '/images/' . $file_name)) {
                        $files_names[] = $file_name;
                    }
                }
            } else {
                throw new Exception('ディレクトリの読み込み権限がありません');
            }
        } else {
            throw new Exception('アップロードに失敗しました!');
        }
    } else {
        throw new Exception('不正なアクセスです!');
    }
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
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
            <?php
            $count = 1;
            foreach ($files_names as $v) :
            ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="./images/<?= h($v) ?>" class="img-fluid">
                        </div>
                    </div>
                </div>
                <?php
                if ($count % 4 == 0) :
                ?>
        </div>
        <div class="row my-3">
        <?php
                endif
        ?>
    <?php
                $count++;
            endforeach
    ?>
        </div>
        <a href="./">もどる</a>
    </div>
</body>

</html>
