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

    $db = new TodoItems();

    $db->insert($_POST['expiration_date'], $_POST['todo_item']);

    header('Location: ./', true, 301);
    exit;
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
