<?php

session_start();

session_regenerate_id();

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';

if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

try {
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $today = $dt->format('Y-m-d');

    $db = new TodoItems();

    $list = $db->selectAll();
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
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
    <style>
        #expiration_date {
            width: 12rem;
        }

        #todo_item {
            width: 25rem;
        }

        .complete {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row my-3 justify-content-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-5">TODOリスト</div>
                            <div class="col-5">ログインユーザー: <?= $_SESSION['user']['name'] ?></div>
                            <div class="col-2"><a href="./logout.php" class="btn btn-outline-primary btn-sm">ログアウト</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="./add.php" method="post" class="form-inline">
                            <div class="form-group mb-3 mr-2">
                                <label for="expiration_date" class="sr-only"> 期限日</label>
                                <input type="date" name="expiration_date" id="expiration_date" value="<?= $today ?>" class="form-control">
                            </div>
                            <div class="form-group mb-3 mr-2">
                                <label for="todo_item" class="sr-only">TODO項目</label>
                                <input type="text" name="todo_item" id="todo_item" placeholder="TODO項目を入力してください" class="form-control">
                            </div>
                            <input type="submit" value="追加" class="btn btn-primary mb-3">
                        </form>
                        <?php if (count($list) > 0) : ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>期限日</th>
                                    <th>TODO項目</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($list as $v) : ?>
                                    <tr>
                                        <td class="<?php if ($v['is_completed'] == 1) echo 'complete' ?>"><?= $v['expiration_date'] ?></td>
                                        <td class="<?php if ($v['is_completed'] == 1) echo 'complete' ?>"><?= $v['todo_item'] ?></td>
                                        <td>
                                            <form action="./action.php" method="post" class="form-inline">
                                                <input type="hidden" name="id" value="<?= $v['id'] ?>">

                                                <div class="form-check form-check-inline mb-3 mr-1">
                                                    <input type="radio" name="is_completed" id="complete1" value="0" class="form-check-input" <?php if ($v['is_completed'] == 0) echo 'checked' ?>>
                                                    <label for="complete1" class="form-check-label">未完了</label>
                                                </div>

                                                <div class="form-check form-check-inline mb-3 mr-1">
                                                    <input type="radio" name="is_completed" id="complete2" value="1" class="form-check-input" <?php if ($v['is_completed'] == 1) echo 'checked' ?>>
                                                    <label for="complete2" class="form-check-label">完了</label>
                                                </div>

                                                <div class="form-check form-check-inline mb-3 mr-1">
                                                    <input type="checkbox" name="delete" id="delete" value="1" class="form-check-input">
                                                    <label for="delete" class="form-check-label">削除</label>
                                                </div>

                                                <input type="submit" value="実行" class="btn btn-primary mb-3 ml-2">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                            <a href="./csv.php" class="btn btn-outline-primary">CSVファイルに変換</a>
                            <a href="./upload.php" class="btn btn-outline-primary">CSVファイルをアップロードして更新</a>
                            <a href="./download.php" class="btn btn-outline-primary">CSVファイルをダウンロード</a>
                            <a href="./user_del.php" class="btn btn-outline-primary">登録解除</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>

</html>
