<?php

session_start();

session_regenerate_id();

$_SESSION['cart'][] = $_POST;


$url = './';
header('Location: ' . $url, true, 301);
exit;

// ここでセッション登録
