<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        /*
        $categoryModel = new Category;
        $homeCategories = $categoryModel->findAllBackOfficeHomePage();
        */

        //Pour appeler une methode statique, on utilise pamayim nekudotayim( les doubles 2 points)
       // au dessus lancien code. En dessous quand on utilise une methode statique, on peut appeler la methode directement comme ça, sans la flèche
        $homeCategories = Category::findAllBackOfficeHomepage();

        $homeProducts = Product::findAllBackOfficeHomepage();


    
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home', ["categories" => $homeCategories, "products" => $homeProducts]);
    }
}
