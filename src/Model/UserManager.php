<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    /**
     * Insert new item in database
     */
    public function insert(array $user): string
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (lastName, firstName, e_mail)
        VALUES (:lastName, :firstName, :e_mail)");
        $statement->bindValue(':lastName', $user['lastName'], \PDO::PARAM_STR);
        $statement->bindValue(':firstName', $user['firstName'], \PDO::PARAM_STR);
        $statement->bindValue(':e_mail', $user['e_mail'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function selectByOneByEmail(string $email): array|false
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE e_mail=:e_mail";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('e_mail', $email);
        $statement->execute();

        return $statement->fetch();
    }
}
