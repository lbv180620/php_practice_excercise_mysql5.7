<?php

session_start();

session_regenerate_id();

unset($_SESSION['user']);
unset($_SESSION['err']['msg']);

header('Location: ./login.php', true, 301);
exit;
