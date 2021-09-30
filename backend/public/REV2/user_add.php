<?php

require_once dirname(__FILE__, 3) . 'vendor/autoload.php';

use Classes\utils\SaftyUtil;
use Classes\utils\SessionUtil;

SessionUtil::sessionStart();

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
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">新規ユーザー登録</div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['err']['msg'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['err']['msg'] ?>
                            </div>
                        <?php endif ?>
                        <form action="./user_add_action.php" method="post">
                            <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?php if (isset($_SESSION['login']['email'])) echo $_SESSION['login']['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">お名前</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php if (isset($_SESSION['login']['name'])) echo $_SESSION['login']['name'] ?>">
                            </div>
                            <input type="submit" value="登録" class="btn btn-primary mb-3">
                        </form>
                        <a href="./">もどる</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
