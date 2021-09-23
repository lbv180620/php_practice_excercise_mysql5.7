<?php

require_once 'Base.php';

class TodoItems extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function selectAll()
    {
        $sql = 'select * from todo_items order by expiration_date';

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function update(int $id, string $expirationDate, string $todoItem, int $isCompleted)
    {
        $sql = 'update todo_items set expiration_date = :expiration_date, todo_item = :todo_item, is_completed = :is_completed where id = :id';

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':expiration_date', $expirationDate, PDO::PARAM_STR);
        $stmt->bindValue(':todo_item', $todoItem, PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $isCompleted, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updateIsCompletedByID(int $id, int $isCompleted)
    {
        $sql = 'update todo_items set is_completed = :is_completed where id = :id';

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':is_completed', $isCompleted, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = 'delete from todo_items where id = :id';

        $stmt =  $this->dbh->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function insert(string $expirationDate, string $todoItem, int $isCompleted = 0)
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

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':expiration_date', $expirationDate, PDO::PARAM_STR);
        $stmt->bindValue(':todo_item', $todoItem, PDO::PARAM_STR);
        $stmt->bindValue(':is_completed', $isCompleted, PDO::PARAM_INT);

        $stmt->execute();
    }
}
