<?php

if (!function_exists('h')) {
    function h($s)
    {
        echo htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
}

session_start();

session_regenerate_id();

if (isset($_SESSION['err']['msg'])) {
    unset($_SESSION['err']);
}

$path = dirname(__FILE__) . '/images/';

try {
    if (is_readable($path)) {
        $tmp_files = scandir($path);
        $file_names = [];
        foreach ($tmp_files as $file_name) {
            if (!preg_match('/^(\.|\.\.)/', $file_name) && is_file('./images/' . $file_name)) {
                $file_names[] = $file_name;
            }
        }
    } else {
        throw new Exception('ディレクトリの読み込み権限がありません');
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./', true, 301);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="slide-wrapper">
        <h2 class="slide-title">アップロードされた画像の一覧</h2>
        <div class="change-btn-wrapper">
            <div class="change-btn prev-btn">← 前へ</div>
            <div class="change-btn next-btn">次へ →</div>
        </div>
        <ul class="slides">
            <?php foreach ($file_names as $i => $v) : ?>
                <li class="slide <?php if ($i === 0) echo 'active' ?>"><img src="./images/<?= h($v) ?>"></li>
            <?php endforeach ?>
        </ul>
        <div class="index-btn-wrapper">
            <?php for ($i = 1; $i <= count($file_names); $i++) : ?>
                <div class="index-btn"><?= $i ?></div>
            <?php endfor ?>
        </div>
        <p><a href="./" style="text-decoration: none;">もどる</a></p>
    </div>

    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html>
