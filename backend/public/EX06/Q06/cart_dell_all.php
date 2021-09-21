<?php

session_start();

session_regenerate_id();

unset($_SESSION['cart']);

$url = './cart_show.php';
header('Location: ' . $url, true, 301);
exit;
