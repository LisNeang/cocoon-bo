<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }


    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }





     /**
     * Methode permettant d'ajouter un enregistrement dans la table category
     * objt courant doit contenir toutes lesdonnées à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function insert()
    {
        //récupération de l'objet PDO représentant la connexion à la DB

        $pdo = Database::getPDO();

        //Ecriture de la requête INSERT INTO
        //les paramètres commencant par des : sont à remplacer plus tard !
        //ils nous protègent des injections SQL et nous évite de gérer les guillements dans les valeurs !
        $sql = "
            INSERT INTO `category` (name, description, subtitle, picture)
            VALUES (:name, :description, :subtitle, :picture)
        ";

        //on envoie notre requête au serveur MySQL, sans l'exécuter
        $stmt = $pdo->prepare($sql);

        //on peut utiliser les bindValue() ou le tableau dans la méthode execute, c'est pareil
        //$stmt->bindValue(":name", $this->name);
        //$stmt->bindValue(":subtitle", $this->subtitle);
        //$stmt->bindValue(":picture", $this->picture);

        //on exécute la requête, en remplacant les paramètres de la requête par ces valeurs
        //si on indique les valeurs remplacant les paramètres de la requête ici, on ne fait pas les bindValue()
        //c'est l'un ou l'autre ! 
        $insertedRows = $stmt->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":subtitle" => $this->subtitle,
            ":picture" => $this->picture,
        ]);

         // Si au moins une ligne ajoutée
         if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    /**
     * Met à jour en BDD une instance de category
     * @return bool
     */
    public function update()
    {
        //récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        //notre requête sql de mise à jour, avec des paramètre nommés
        $sql = "UPDATE category
                SET
                name = :name,
                description = :description,
                subtitle = :subtitle,
                picture = :picture,
                updated_at = NOW()
                where id = :id
                ";
            //ATTENTION : ne pas oublier de mettre un WHERE pour un update car sinon aça change sur toutes les categories (fait péter la bdd)

        //envoie la requête chez musql
        $stmt = $pdo->prepare($sql);
        
        //$queryworked sera true ou false, en fonction de si la requête a foiré
        $queryWorked = $stmt->execute([
            //remplace les paramètres par nos valeurs
            ":name" => $this->getName(),
            ":description" => $this->getDescription(),
            ":subtitle" => $this->getSubtitle(),
            ":picture" => $this->getPicture(),
            ":id" => $this->getId()
            
        ]);

        return $queryWorked;
    }

    



    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * 
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    public static function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` = :id';

        //prepare notre requete
        $pdoStatement = $pdo->prepare($sql);

          //exécute la requête
          $pdoStatement->execute([":id" => $categoryId]);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject('App\Models\Category');

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * 
     * @return Category[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     * 
     * @return Category[]
     */
    public function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $categories;
    }


    /**
     * Récupérer les 3 catégories sur la home du bo
     * la méthode est static pour qu on puisse l'appeler sans avoir à créer d'instance de category !
     * 
     * @return Category[]
     */
    public static function findAllBackOfficeHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT id, name
            FROM category
            WHERE home_order > 0
            ORDER BY updated_at DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $categories;
    }



}
