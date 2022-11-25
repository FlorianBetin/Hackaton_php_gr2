<?php

namespace App\Model;

class CartManager extends AbstractManager
{

    public function cartBytarifId(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT article.name, article.description, 
        article.epoque_id as epoque_id, type_article.name AS name_type,
        tarif.montant, tarif.id AS tarif_id, formule.name As formule_name, 
        formule.id as formule_id, epoque.name AS epoque_name
        FROM article JOIN type_article 
        ON article.type_article_id = type_article.id
        JOIN tarif ON article.id = tarif.article_id
        JOIN formule ON tarif.formule_id = formule.id
        JOIN epoque ON epoque.id = article.epoque_id        
        WHERE tarif.id=:id");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
