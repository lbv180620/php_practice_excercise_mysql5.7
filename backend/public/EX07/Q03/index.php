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
        <form action="./action.php" method="post">
            <div class="row my-3">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">ラーメン</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category1">メニューのカテゴリ</label>
                                <input type="text" name="category[]" id="category1" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="menu1">メニュー</label>
                                <input type="text" name="menu[]" id="menu1" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="option1">麺の硬さ</label>
                                <input type="text" name="option[]" id="option1" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="price1">値段</label>
                                <input type="text" name="price[]" id="price1" class="form-control my-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">ドリンク</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category2">メニューのカテゴリ</label>
                                <input type="text" name="category[]" id="category2" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="menu2">メニュー</label>
                                <input type="text" name="menu[]" id="menu2" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="option2">ジョッキの大きさ</label>
                                <input type="text" name="option[]" id="option2" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="price2">値段</label>
                                <input type="text" name="price[]" id="price2" class="form-control my-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="submit" value="送信" class="btn btn-primary mt-3">
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
</body>

</html>
