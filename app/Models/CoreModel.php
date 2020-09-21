<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel {

    //une methode définie comme abstraite doit absolument être implentée par tous ses enfants !
    //on ne définit pas ce que fait la fonction, mais comment elle doit être nommée, si elle doit être statique
    abstract public static function findAll();

    //si je précise un argument ici, les enfants aussi devront avoir un argument !
    abstract public static function find($id);

    //on peut faire de même pour les methode insert / delete / update (attention toutefois à la non instanciation, comment fiare avec les _this )


    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }
}
