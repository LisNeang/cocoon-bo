<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{   
    //gère la deconnexion d'un user
    public function logout()
    {
        //supprime trop de chose !
        //session_destroy();

        //onn supprime plutôt ce qui est important pour la connexion pour la connexion du user//Pour ne pas supprimer des données utiles - mais bon ça dépend du site
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);

        //après deconnexion redirection à chaque fois vers le template login
        $this->redirectToRoute('user-login');
    }


    public function login()
    {
        //tableau d'éventuels messages d'erreur de validation
        $errorsList = [];

        //si le form est soumis...     
        if (!empty($_POST)){
            //récupère l'email et le mot de passe du formulaire
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

            //aller chercher dans la bdd si j'ai bien un user ayant cet email
            $foundUser = AppUser::findByEmail($email);
            //dump($foundUser);

            //si on trouve le user 
            if ($foundUser){
                //on vérifie que son mdp est bon
                if (password_verify($password, $foundUser->getPassword())){
                    //si c'est le bon... 
                    //connecte le user 
                    //on stocke des informations en session pour mémoriser que le user est connecté
                    //tant qu'à y être, on stocke ce qu'il faut pour savoir qui est cette personne
                    $_SESSION['userId'] = $foundUser->getId();
                    //dump($foundUser);
                    $_SESSION['userObject'] = $foundUser;

                   // dump($foundUser);
                   //redirige après connexion du login vers la home
                    $this->redirectToRoute("main-home");
                }
                else {
                    $errorsList['password'] = "mauvais mdp !";
                }
            }
            else {
                $errorsList['email'] = "mauvais email !";
            }

            //valide l'email 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errorsList['email'] = "Votre email est mal formé !";
            }
        }

        $this->show('user/login', ["errorsList" => $errorsList]);
    }
}






