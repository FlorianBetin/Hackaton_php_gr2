<?php

namespace App\Model;

use PDO;

class EpoqueManager extends AbstractManager
{
    public const TABLE = 'epoque';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ';';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}


// SELECT ep.name AS epoque_name, ep.date AS epoque_date, ep.id AS ep_id, art.id AS art_id FROM epoque ep INNER JOIN article AS art ON ep.id = art.Epoque_id
