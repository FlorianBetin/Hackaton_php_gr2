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
            " (lastname, firstname, email,)
        VALUES (:lastname, :firstname, :email)");
        $statement->bindValue(':lastname', $user['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $user['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $user['email'], \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function selectByOneByEmail(string $email): array|false
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE email=:email";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('email', $email);
        $statement->execute();

        return $statement->fetch();
    }
}
