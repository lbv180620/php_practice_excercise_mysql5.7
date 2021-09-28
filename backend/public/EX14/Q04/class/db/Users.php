<?php

declare(strict_types=1);

require_once 'Base.php';

/**
 * ユーザーテーブルクラス
 */
class Users extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 新規ユーザー追加
     */
    public function addUser(string $email, string $password, string $name): bool
    {
        // 同じメールあアドレスのユーザーがいないか調べる
        if (!empty($this->findUserByEmail($email))) {
            // 同じメールアドレスのユーザーが存在したらfalseを返す
            return false;
        }

        // パスワードをハッシュ化する
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'insert into users (email, password, name)';
        $sql .= 'values';
        $sql .= '(:email, :password, :name)';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    /**
     * メールアドレスとパスワードが一致するユーザーを取得する
     *
     * @return array ユーザーの連想配列 (一致するユーザーが無かった場合は、空の配列)
     */
    public function getUser(string $email, string $password): array
    {
        $rec = $this->findUserByEmail($email);

        // 空の配列が返された場合
        if (empty($rec)) {
            return [];
        }

        // パスワードの照合
        if (password_verify($password, $rec['password'])) {
            return $rec;
        }

        // 照合出来なかった場合は、空の配列を返す
        return [];
    }

    /**
     * 同一のメールアドレスのユーザーを探す
     *
     * @return array ユーザーの連想配列
     */
    private function findUserByEmail(string $email): array
    {
        $sql = 'select * from users where email = :email';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetch();

        // falseが返された場合は、空の配列を返す
        if (empty($rec)) {
            return [];
        }

        return $rec;
    }
}
