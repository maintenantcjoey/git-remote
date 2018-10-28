<?php
namespace Model;
use Model\Item;

    class ItemManager extends AbstractManager {

    const TABLE = 'item';

    public function __construct($pdo) {
        parent::__construct(self::TABLE, $pdo);
        }

    public function insert(Item $item): int {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
            }
        }

    public function update(Item $item) {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET title = :title WHERE id = :id");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->execute();
        }

    public function delete(Item $item) {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

}
