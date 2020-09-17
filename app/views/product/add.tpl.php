<a href="<?= $router->generate('product-add') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un produit</h2>
    
    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Nom</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Nom du produit">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" class="form-control" id="decription" placeholder="description" aria-describedby="subtitleHelpBlock">
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input name="image" type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>

        <div class="form-group">
            <label for="picture">Prix</label>
            <input name="prix" type="text" class="form-control" id="price" placeholder="34.99">
        </div>

        <div class="form-group">
            <label for="picture">Status</label>
            <input name="type" type="text" class="form-control" id="price" placeholder="Status">
            <small id="statusHelpBlock" class="form-text text-muted">
                Le status est de 0 si le produit n'est pas disponible, 1 s'il est disponible
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>