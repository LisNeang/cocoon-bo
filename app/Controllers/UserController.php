<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{
    public function login()
    {

        //tableau d'éventuels messages d'erreurs de validation
        $errorsList = [];
        //si le form st soumis ...
        if(!empty($_POST)){
            //récupère l'email et le mot de passe du formulaire//pas de soucis de securité ici car c'est un select et non un insert
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
        

            //aller chercher dans la bdd si j'ai bien un user ayant cet email
            //nouvelle class à créer (ctrl espace : créer le use  &  après créer la methode findByEmail)
            $foundUser = AppUser::findByEmail($email);
            //après avoir créer la methode fibdByEmail, on peut faire un dump pour tester
            dump($foundUser);

            //si on trouve le user
            if ($foundUser){
                //on verifie que son mdp est bon
                //je compare avec password_verify le password tapé dans le formulaire avec le hasch(du mdp) qui est dans la BDD
                if (password_verify($password, $foundUser->getPassword())) {
                    //si c'est bon...
                    //connecte le user
                    echo "bravo ! ";
                } 
                 else {
                     //on est libre de mettre ce qu' on veut pour le nom des clefs des champs, ici c'est bien de récupérer le nom du champs
                $errorsList['password'] = "mauvais mdp !";
                }
            }
            else{
                $errorsList['email'] = "mauvais email !";
            } 
            
            //valide l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errorsList['email'] = "Votre email est mal formé !";
            }

        }  
        
        //en 2 arguments on met la liste des erreurs, et dans la views il y a une boucle foreach qui affiche tous les messages d'erreurs
        $this->show('user/login', ["errorsList" => $errorsList]);
    }

}




