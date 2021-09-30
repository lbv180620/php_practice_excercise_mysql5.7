<?php

namespace Class\db;

use Class\db\Base;

/**
 * todo_itemsテーブルクラス
 */

class TodoItems extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * レコードを全件取得する(期限日の古いものから並び替える)
     */
    public function selectAll(): array
    {
        $sql = 'select * from todo_items order by expiration_date';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * レコードをアップデードする
     */
    public function update(int $id, string $expirationDate, string $todoItem, int $isCompleted): void
    {
        $sql = 'update todo_items set expiration_date = :expiration_date, todo_item = :todo_item, is_completed = :is_completed where id = :id';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':expiration_date', $expirationDate, \PDO::PARAM_STR);
        $stmt->bindValue(':todo_item', $todoItem, \PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $isCompleted, \PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 指定IDのレコードの完了フラグを切り替える
     */
    public function updateIsCompletedByID(int $id, int $isCompleted): void
    {
        $sql = 'update todo_items set is_completed = :is_completed where id = :id';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':is_completed', $isCompleted, \PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 指定IDのレコードを削除する
     */
    public function delete(int $id): void
    {
        $sql = 'delete from todo_items where id = :id';

        $stmt =  $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * 新規レコードを挿入する
     */
    public function insert(string $expirationDate, string $todoItem, int $isCompleted = 0): void
    {
        $sql = 'insert into todo_items (';
        $sql .= 'expiration_date,';
        $sql .= 'todo_item,';
        $sql .= 'is_completed';
        $sql .= ') values (';
        $sql .= ':expiration_date,';
        $sql .= ':todo_item,';
        $sql .= ':is_completed';
        $sql .= ')';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':expiration_date', $expirationDate, \PDO::PARAM_STR);
        $stmt->bindValue(':todo_item', $todoItem, \PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $isCompleted, \PDO::PARAM_INT);

        $stmt->execute();
    }
}
