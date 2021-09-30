<?php

require_once dirname(__FILE__, 3) . 'vendor/autoload.php';

use Classes\utils\SessionUtil;

SessionUtil::sessionStart();

// エラーがなかったらトップページにリダイレクト
if (!isset($_SESSION['err']['msg'])) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">エラーが発生しました</div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['err']['msg'] ?></p>
                        </div>
                        <a href="./login.php" class="btn btn-danger">もどる</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>

<?php

// エラーは表示したので、エラーメッセージは削除
unset($_SESSION['err']['msg']);

?>
