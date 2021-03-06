<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Une instance de Product = un produit dans la base de données
 * Product hérite de CoreModel
 */
class Product extends CoreModel {
    
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
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $type_id;
    

    /**
     * Met à jour en BDD une instance de product
     * @return bool
     */
    public function update()
    {
        //récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        //notre requête sql de mise à jour, avec des paramètre nommés
        $sql = "UPDATE product
                SET
                name = :name,
                description = :description,
                picture = :picture,
                price = :price,
                rate = :rate,
                status = :status,
                brand_id = :brandId,
                category_id = :categoryId,
                type_id = :typeId,
                updated_at = NOW()
                where id = :id
                ";
            //ATTENTION : ne pas oublier de mettre un WHERE pour un update car sinon ça change sur toutes les categories (fait péter la bdd)

        //envoie la requête chez mysql
        $stmt = $pdo->prepare($sql);
        
        //$queryworked sera true ou false, en fonction de si la requête a foiré
        $queryWorked = $stmt->execute([
            //remplace les paramètres par nos valeurs
            ":name" => $this->getName(),
            ":description" => $this->getDescription(),
            ":picture" => $this->getPicture(),
            ":price" => $this->getPrice(),
            ":rate" => $this->getRate(),
            ":status" => $this->getStatus(),
            ":brandId" => $this->getBrandId(),
            ":categoryId" => $this->getCategoryId(),
            ":typeId" => $this->getTypeId(),
            ":id" => $this->getId()

            
        ]);

        return $queryWorked;
    }




    /**
     * Méthode permettant de récupérer un enregistrement de la table Product en fonction d'un id donné
     * 
     * @param int $productId ID du produit
     * @return Product
     */
    public static function find($productId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM product
            WHERE id = ' . $productId;

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $pdoStatement = $pdo->query($sql);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $result = $pdoStatement->fetchObject('App\Models\Product');
        
        return $result;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table product
     * 
     * @return Product[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');
        
        return $results;
    }

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
    public function setName(string $name)
    {
        $this->name = $name;
    }


     /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getshortDescription()
    {
        return mb_substr($this->description, 0, 45) .'...';
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
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */ 
    public function getRate() : int
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

        /**
     * Get the value of brand_id
     *
     * @return  int
     */ 
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     */ 
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */ 
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     */ 
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
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
            INSERT INTO `product` (name, description, picture, price, rate, status, brand_id, category_id, type_id)
            VALUES (:name, :description, :picture, :price, :rate, :status, :brand_id, :category_id, :type_id)
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
            ":picture" => $this->picture,
            ":price" => $this->price,
            ":rate" => $this->rate,
            ":status" => $this->status,
            ":brand_id" => $this->brand_id,
            ":category_id" => $this->category_id,
            ":type_id" => $this->type_id,

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



    public static function findAllBackOfficeHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT id, name
            FROM product
            ORDER BY id DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $products = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $products;
    }


}
