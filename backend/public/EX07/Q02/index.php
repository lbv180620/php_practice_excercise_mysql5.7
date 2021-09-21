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
                                <label for="category">メニューのカテゴリ</label>
                                <input type="text" name="category" id="category" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="menu">メニュー</label>
                                <input type="text" name="menu" id="menu" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="noodleHardness">麺の硬さ</label>
                                <input type="text" name="noodleHardness" id="noodleHardness" class="form-control my-2">
                            </div>

                            <div class="form-group">
                                <label for="price">値段</label>
                                <input type="text" name="price" id="price" class="form-control my-2">
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
