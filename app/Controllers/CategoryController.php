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
}
