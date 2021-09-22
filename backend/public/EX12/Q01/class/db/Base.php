<?php
require_once 'Env.php';

require dirname(__FILE__, 6) . '/vendor/autoload.php';

class Base
{

    protected $dbh;

    public function __construct()
    {
        $DB_NAME = 'php_work';
        $DB_HOST = ENV::get('DB_HOST');
        $DB_USER = ENV::get('DB_USER');
        $DB_PASS = ENV::get('DB_PASS');
        $DRIVER_OPTS = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $dsn = "mysql:dbname=" . $DB_NAME . ";host=" . $DB_HOST . ";charset=utf8";
        $this->dbh = new PDO($dsn, $DB_USER, $DB_PASS, $DRIVER_OPTS);
    }
}
