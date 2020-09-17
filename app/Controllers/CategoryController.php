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
        dump($_POST);
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

            $category->insert();
        }

        $this->show('category/add');
    }
}
