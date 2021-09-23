<?php

require_once './class/db/Env.php';
require_once './class/db/Base.php';
require_once './class/db/TodoItems.php';

try {

    $db = new TodoItems();

    $list = $db->selectAll();
} catch (Exception $e) {
    var_dump($e);
    exit;
} finally {
    $dbh = null;
}

$rename = 'work.download.csv';
$file_path = dirname(__FILE__, 4) . '/vagrant_data/work.csv';

header('Content-Type: text/csv');
header('Content-Length: ' . filesize($file_path));
header("Content-Disposition: attachment; filename='{$rename}'");


foreach ($list as $record) {
    foreach ($record as $k => $v) {
        if ($k == 'todo_item') {
            $record[$k] = mb_convert_encoding($v, 'SJIS-win', 'UTF-8');
        }
    }
    readfile(implode(',', $record));
}
