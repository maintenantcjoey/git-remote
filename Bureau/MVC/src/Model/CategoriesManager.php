<?php
namespace Model;


class CategoriesManager extends AbstractManager {

    const TABLE = 'add';

    public function __construct() {
        parent::__construct(self::TABLE);
    }

    public function insert(Category $category): int {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    public function delete(Category $category): int {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->execute();
        }
    }

    public function update(Category $category): int {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('name', $category->getId(), \PDO::PARAM_INT);
        if ($statement->execute()) {
            return $statement->execute();
        }
    }

    public function selectAllCategories() :array {
        $query = "SELECT * FROM add";
        $res = $pdo->query($query);
        return $res->fetchAll();
    }

    // la méthode prend l'id en paramètre
    public function selectOneCategory(int $id) : array {
        $query = "SELECT * FROM add WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
?>