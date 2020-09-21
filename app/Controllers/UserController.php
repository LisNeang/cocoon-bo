<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{
    public function login()
    {
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
                if ($password === $foundUser->getPassword()) {
                    //si c'est bon...
                    //connecte le user
                    echo "bravo ! ";
                } 
                 else {
                echo "mauvais mdp !";
                }
            }
            else{
                echo "mauvais email !";
            }     
        }   
        $this->show('user/login', []);
    }

}




