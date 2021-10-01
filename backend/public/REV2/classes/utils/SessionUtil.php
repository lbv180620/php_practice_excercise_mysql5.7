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
        session_save_path("/tmp");
        ini_set('session.cookie_lifetime', 0);
        ini_set('session.gc_maxlifetime', 10);
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_divisor', 1);

        session_start();
        session_regenerate_id(true);
    }
}
