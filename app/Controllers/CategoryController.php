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
            //Le FILTER_SANITIZE_FULL_SPECIAL_CHARS enlève aussi les balises ! (voir dans la doc php, plusieurs filter_sanitize...)
            $name = strip_tags(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
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

        //récupère la catégorie dans la bdd, pour préremplir le form
        $category = Category::find($categoryId);

        //si le formulaire est soumis
        if (!empty($_POST)) {
            //récupère les données du form (en les purifiant, voir dans la methode add au dessus)
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            //les injecter dans mon instance de catégorie
            $category->setName($name);
            $category->setDescription($description);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            //sauvegarde les changements en bdd
            if ($category->update()){
                //prepare un message à afficher sur la prochaine page
                $_SESSION['alert'] = 'Categorie modifiée ! Bravo !';
            

            //redirection - on le met en place seuleemtn si tout marche bien précédemment
             //on se redirige vers la liste des produits
                //attention bien enlever le dump($_POST);, sinon la redirection ne peut pas se faire
                //methode de redirection utilisé pour add(au dessus)
                //header("Location: list");
               // die();
               //autre methode (penser à bien activier la session avec session start dans index)
               //global $router;
               //header("Location: " . $router->generate("category-list"));
               //voir le CoreController.php (methode pour la redirection route)
              $this->redirectToRoute("category-list");
               die();
            }
        }
        $this->show('category/update', ["category" => $category]);
    }


}
