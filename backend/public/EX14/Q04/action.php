<?php

session_start();
session_regenerate_id();

require './class/db/Env.php';
require './class/db/Base.php';
require './class/db/TodoItems.php';

if (empty($_SESSION['user'])) {
    header('Location: ./login.php', true, 301);
    exit;
}

try {

    $db = new TodoItems();

    if (isset($_POST['delete']) && $_POST['delete'] == "1") {
        $db->delete($_POST['id']);
    } else {
        $db->updateIsCompletedByID($_POST['id'], $_POST['is_completed']);
    }

    header('Location: ./', true, 301);
    exit;
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    print_r($_POST);
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
