<?php

session_start();

session_regenerate_id();

$path = dirname(__FILE__) . '/images/';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_FILES['image_file'])) {
            throw new Exception('ファイルが存在しません');
        } elseif ($_FILES['image_file']['error'] === 2) {
            throw new Exception('ファイルサイズを小さくしてください!');
        } elseif ($_FILES['image_file']['size'] === 0) {
            throw new Exception('ファイルを選択してください!');
        } elseif (preg_match('/image\/.*/', $_FILES['image_file']['type']) === 0) {
            throw new Exception('画像ファイルを選択してください!');
        } elseif ($_FILES['image_file']['error'] === 0) {
            if (!move_uploaded_file($_FILES['image_file']['tmp_name'], $path . $_FILES['image_file']['name'])) {
                throw new Exception('アップロードに失敗しました!');
            } else {
                header('Location: ./show.php', true, 301);
                exit;
            }
        } else {
            throw new Exception('アップロードに失敗しました!');
        }
    } else {
        throw new Exception('不正なアクセスです!');
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./', true, 301);
    exit;
} catch (Error $e) {
    $msg = $e->getMessage();
    $_SESSION['err']['msg'] = $msg;
    header('Location: ./', true, 301);
    exit;
}
