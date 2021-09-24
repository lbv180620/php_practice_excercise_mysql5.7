<?php

declare(strict_types=1);

require_once 'Base.php';

class Users extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addUser(string $email, string $password, string $name): bool
    {
        if (!empty($this->findUserByEmail($email))) {
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'insert into users (email, password, name)';
        $sql .= 'values';
        $sql .= '(:email, :password, :name)';

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    private function findUserByEmail(string $email): array
    {
        $sql = 'select * from users where email = :email';

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $rec = $stmt->fetch();

        // fech()の取得に失敗した場合の戻り値はfalse
        // 配列に変換
        if (empty($rec)) {
            return [];
        }

        return $rec;
    }
}
