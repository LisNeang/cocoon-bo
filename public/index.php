<?php

// POINT D'ENTRÉE UNIQUE : 
// FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';

//activer les sessions !
session_start();

/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
/*ancienne methode
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);
*/
$router->map('GET', '/', 'MainController#home', 'main-home');

//route pour l'affichage des categories
$router->map('GET', '/category/list', 'CategoryController#list', 'category-list');

//route pour rajouter une category
$router->map('GET|POST', '/category/add', 'CategoryController#add', 'category-add');

//route pour modifier une catégorie.
//On a besoin de connaitre l'id du produit modifié. Grâce à Altorouter on peut utliser [i:categoryId] ou [i:id] pour spécifier une categorie en particuler
$router->map('GET|POST', '/category/update/[i:categoryId]', 'CategoryController#update', 'category-update');



//route pour l'affichage des produits
$router->map('GET', '/product/list', 'ProductController#list', 'product-list');


//route pour rajouter produit
$router->map('GET|POST', '/product/add', 'ProductController#add', 'product-add');

//route pour modifier un produit.
//On a besoin de connaitre l'id du produit modifié. Grâce à Altorouter on peut utliser [i:categoryId] ou [i:id] pour spécifier une categorie en particuler
$router->map('GET|POST', '/product/update/[i:productId]', 'ProductController#update', 'product-update');




/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

//pour éviter de répéter partout le namespace, tx ben
$dispatcher->setControllersNamespace('\App\Controllers');


// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();