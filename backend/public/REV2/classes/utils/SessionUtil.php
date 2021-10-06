<?php

namespace Classes\utils;

/** セッション関連ユーティリティクラス */
class SessionUtil
{
    /**
     * セッションをスタートし、セッションIDを更新します
     */
    public static function sessionStart(): void
    {
        session_save_path("/tmp_php_session");
        ini_set('session.gc_maxlifetime', 10);
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_divisor', 1);

        session_start();
        session_regenerate_id(true);

        //最終表示時間更新
        $_SESSION["last_time"] = time();
    }

    /**
     * セッション有効期限を過ぎればセッション削除
     * 処理系のファイルには不要、画面系のファイルに要
     * 非同期処理？
     */
    public static function loginStateCheck(): void
    {
        // // ログインしていないときは、login.phpへリダイレクト
        // if (empty($_SESSION['user'])) {
        //     header('Location: ./login.php', true, 301);
        //     exit;
        // }


        // タイムアウトしていればログアウト処理
        if (!isset($_SESSION['last_time']) || time() - $_SESSION['last_time'] > 10) {
            $_SESSION = array();
            session_destroy();
            header('Location: ./login.php', true, 301);
            exit;
        }
    }
}
