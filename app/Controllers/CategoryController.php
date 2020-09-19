<?php

namespace App\Controllers;

use App\Models\Category;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class CategoryController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        //récupère toutes les categories, sous forme d'instance de mon modèle Category
        $categories = Category::findAll();

        //on passe ce tableau de résultats à la vue
        $this->show('category/list', ["categories" => $categories]);
    }

    public function add()
    {   
        // Le dump bloque la redirection du header après validation formulaire produt add ou category add, il faut l'enlever pour que la redirection se fasse
       // dump($_POST);

       
        //est-ce que le form est soumis ?? 
        //si oui, on le traite
        if (!empty($_POST)){
            //récupère les données du form
            //le strip_tags vire les éventuelles balises HTML des données 
            //ça nous protège des attaques XSS
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            //début d'exemple de démo de comment on ferait un insert
            //code très incomplet
            $category = new Category();
            $category->setName($name);
            $category->setDescription($description);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            //si l'insert s'est bien passé...
            if ($category->insert()){
                //ajoute un message qui s'affichera sur la prochaine page !
                //pour l'affichage, voir dans header.tpl.php
                $_SESSION['alert'] = "Votre catégorie a bien été ajoutée";
                //on se redirige vers la liste des produits
                //attention bien enlever le dump($_POST);, sinon la redirection ne peut pas se faire
                header("Location: list");
                die();
            };
        }

        $this->show('category/add');
    }

    public function update($categoryId)
    {   
   
        $this->show('category/update');
    }


}
