<?php

namespace App\Model;

class ArticleManager extends AbstractManager
{
    public const TABLE = 'article';

    public function articleByEpoqueId(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT article.name, article.description, article.epoque_id as epoque_id, type_article.name AS name_type    
        FROM " . static::TABLE . " JOIN type_article 
        ON " . static::TABLE . ".type_article_id = type_article.id        
        WHERE epoque_id=:id");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }


    public function formuleByArticle(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT article.name, article.description, article.epoque_id as epoque_id, type_article.name AS name_type, 
        tarif.montant, formule.name As formule_name
        FROM " . static::TABLE . " JOIN type_article 
        ON " . static::TABLE . ".type_article_id = type_article.id
        JOIN tarif ON article.id = tarif.article_id
        JOIN formule ON tarif.formule_id = formule.id
        WHERE epoque_id=:id");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
