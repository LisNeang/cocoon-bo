<a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
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
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="34.99">
        </div>

        <div class="form-group">
            <label for="picture">Rate</label>
            <select name="rate" type="text" class="form-control" id="rate" placeholder="Rate">
            <option value="1">1 étoile</option>
            <option value="2">2 étoiles</option>
            <option value="3">3 étoiles</option>
            <option value="4">4 étoiles</option>
            <option value="5">5 étoiles</option>
            </select>
        </div>

        <div class="form-group">
            <label for="picture">Status</label>
            <select name="status" type="text" class="form-control" id="price" placeholder="Status">
            <option value="0">Pas disponible</option>
            <option value="1">Disponible</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>