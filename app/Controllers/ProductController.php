<?php

namespace App\Controllers;

use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class ProductController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        //récupère toutes les categories, sous forme d'instance de mon modèle Category
        $products = Product::findAll();

        //on passe ce tableau de résultats à la vue
        $this->show('product/list', ["products" => $products]);
    }
}
