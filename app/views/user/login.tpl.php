<a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>
<h2>Se connecter</h2>

<!--dans le formulaire on rajoute novalidate="novalidate"-->
<form method="POST" class="mt-5" novalidate="novalidate">
<div class="form-group">
<label for="email">E-mail</label>
<!-- bien mettre type = email pour une validation du champs de type email -->
<input name="email" type="email" class="form-control" id="email" placeholder="email">
</div>
<div class="form-group">
<label for="password">Mot de passe</label>
<!-- bien mettre type = password, masque par des bullet le mots de passe que l'on tape -->
<input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="subtitleHelpBlock">
</div>


<!-- boucle Pour afficher les erreurs du tableau $errorsList. S il est vide, la boucle foreach n'affiche rien-->
<?php foreach($errorsList as $error): ?>
<div><?= $error ?></div>
<?php endforeach; ?>
<button type="submit" class="btn btn-primary btn-block mt-5">Se connecter</button>
</form> 