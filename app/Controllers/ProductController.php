<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;


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
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));
            $rate = strip_tags(filter_input(INPUT_POST, 'rate'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            
            //début d'exemple de démo de comment on ferait un insert
            //code très incomplet
            $product = new Product();
            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setPrice($price);
            $product->setRate($rate);
            $product->setStatus($status);

            //dans la BBD, brand_id, category_id et type_id sont repquis (infos qui proviennent d'autres tableau ( Grace à une requete SQL))
            //Pour l'instant on les met en dur pour voir si ça fonctionne

            $product->setBrandId(1);
            $product->setCategoryId(1);
            $product->setTypeId(1);


            

            $product->insert();
        }

        $this->show('product/add');
    }
}
