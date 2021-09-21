<?php

$path = dirname(__FILE__) . '/images/' . $_FILES['image_file']['name'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_FILES['image_file']['error'] === 2) {
            throw new Exception('ファイルサイズを小さくしてください!');
        } elseif ($_FILES['image_file']['size'] === 0) {
            throw new Exception('ファイルを選択してください!');
        } elseif (preg_match('/image\/.*/', $_FILES['image_file']['type']) === 0) {
            throw new Exception('画像ファイルを選択してください!');
        } elseif ($_FILES['image_file']['error'] === 0) {
            move_uploaded_file($_FILES['image_file']['tmp_name'], $path);
            echo 'アップロードに成功しました!' . PHP_EOL;
        } else {
            throw new Exception('アップロードに失敗しました!');
        }
    } else {
        throw new Exception('不正なアクセスです!');
    }
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
