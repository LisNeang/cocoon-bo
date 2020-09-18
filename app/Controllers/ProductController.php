<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;


class ProductController extends CoreController
{

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
        // Le dump bloque la redirection du header, il faut l'enlever pour que la redirection se fasse
        //dump($_POST);

        //est-ce que le form est soumis ??
        //si oui, on le traite
        if (!empty($_POST)) {
            //récupère les données du form
            //le strip_tags vire les éventuelles balises HTML des données
            //ça nous protège des attaques XSS
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));
            $rate = strip_tags(filter_input(INPUT_POST, 'rate'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            
            $brandId = strip_tags(filter_input(INPUT_POST, 'brand_id'));
            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $typeId= strip_tags(filter_input(INPUT_POST, 'type_id'));
            
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

            $product->setBrandId($brandId);
            $product->setCategoryId($categoryId);
            $product->setTypeId($typeId);


            //si l'insert s'est bien passé...
            if ($product->insert()){
                $_SESSION['alert'] = "Votre produit a bien été ajouté";
                //on se redirige vers la liste des produits
                //attention bien enlever le dump($_POST);, sinon la redirection ne peut pas se faire
                header("Location: list");
                die();
            };
        }

        //récupère toutes les categories pour construire ma liste déroulante dans le form !
        // pas besoin d' instancier Brand car la methode est en static$brandModel = new Brand();
        $allBrands = Brand::findAll();

        $allCategories = Category::findAll();

        $allTypes = Type::findAll();

        $this->show('product/add', [
            "allBrands" =>  $allBrands,
            "allCategories" =>  $allCategories,
            "allTypes" =>  $allTypes

        ]);
    }
}