<?php

/** セッション関連ユーティリティクラス */
class SessionUtil
{
    /**
     * セッションをスタートし、セッションIDを更新します
     */
    public static function sessionStart(): void
    {
        session_start();
        session_regenerate_id();
    }
}
