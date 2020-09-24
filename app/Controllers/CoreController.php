<?php

namespace App\Controllers;

class CoreController {

    protected function checkAuthorization($allowedRoles = [])
    {
        //si le user n'est pas connecté ...
        if (empty($_SESSION['userObject'])){
            //Un message qui s'affichera sur le login
            $_SESSION['alert'] = "veuillez vous connecter d'abord !";

            //redirige gentiment vers le login
            $this->redirectToRoute("user-login"); 
        }
        //sinon, s'il est connecté
        else{
            //récupère les infos du user connecté
            $user = $_SESSION['userObject'];

            //récupère son rôle
            $role = $user->getRole();
        
            //est-ce que le rôle du user fait parti des rôles autorisés pour cette page ?
            //si non (le rôle n'est pas autorisé)
            //in array recherche une aiguille($role du user connecté) dans une botte de foin($allowedRoles)
            //ça donne ça :   if(!in_array("admin", ["admin", "catalog-manager"])){
           //}
            if (!in_array($role, $allowedRoles)){

                //on pète une erreur 403
                $errorController = new ErrorController();
                $errorController->err403();

                // on arrête tout ici !
                die();
            }
        }    
    }
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }

    //permet de rediriger facilement vers une route de notre application
    public function redirectToRoute($route)
    {
        //redirection
        global $router;
        header("Location: " .$router->generate($route));
        die();
    }




}
