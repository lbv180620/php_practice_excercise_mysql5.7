<?php

declare(strict_types=1);

/**
 * .envファイルに書かれている環境変数を取得するためのクラス
 */

use Dotenv\Dotenv;

class Env
{
    private static $dotenv;

    public static function get(string $key): string
    {
        if ((self::$dotenv instanceof Dotenv) === false) {
            self::$dotenv = Dotenv::createImmutable(dirname(__FILE__, 7));
            self::$dotenv->load();
        }
        return array_key_exists($key, $_ENV) ? $_ENV[$key] : null;
    }
}
