<?php

require_once 'Env.php';

require dirname(__FILE__, 6) . '/vendor/autoload.php';

class Base
{
    private static string $dbname;
    private static string $host;
    private static string $user;
    private static string $passwd;
    private static $driver_opts;

    protected $dbh;

    public function __construct()
    {
        self::$dbname = 'php_work';
        self::$host = Env::get('DB_HOST');
        self::$user = Env::get('DB_USER');
        self::$passwd = Env::get('DB_PASS');
        self::$driver_opts = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $dsn = "mysql:dbname=" . self::$dbname . ";host=" . self::$host . ";charset=utf8";

        $this->dbh = new PDO($dsn, self::$user, self::$passwd, self::$driver_opts);
    }
}
