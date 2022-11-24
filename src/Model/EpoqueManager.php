<?php

namespace App\Model;

use PDO;

class EpoqueManager extends AbstractManager
{
    public const TABLE = 'Epoque';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' INNER JOIN article AS art 
        ON Epoque.id = art.Epoque_id';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
