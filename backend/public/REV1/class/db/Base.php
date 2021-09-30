<?php

declare(strict_types=1);

require_once 'Env.php';

require dirname(__FILE__, 5) . '/vendor/autoload.php';

/**
 * DB操作基底クラス
 */

class Base
{
    /** @var object PDOクラスインスタンス */
    protected $pdo;

    public function __construct()
    {
        // DBに接続するための文字列(DSN 接続文字列)
        $dsn = "mysql:dbname=" . Env::get('DB_NAME') . ";host=" . Env::get('DB_HOST') . ";charset=utf8";

        // PDOクラスのインスタンス
        $this->pdo = new PDO($dsn, Env::get('DB_USER'), Env::get('DB_PASS'), Config::DRIVER_OPTS);
    }

    /**
     * トランザクションを開始する
     */
    public function begin(): void
    {
        $this->pdo->beginTransaction();
    }

    /**
     * トランザクションをコミットする
     */
    public function commit(): void
    {
        $this->pdo->commit();
    }

    /**
     * トランザクションをロールバックする
     */
    public function rollback(): void
    {
        $this->pdo->rollBack();
    }
}
