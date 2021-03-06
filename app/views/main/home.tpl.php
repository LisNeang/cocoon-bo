<p class="display-4 message">
      Bienvenue dans le backOffice
</p>

<div class="row mt-5">
    <div class="col-12 col-md-6">
        <div class="card text-white mb-3">
            <div class="card-header">Liste des catégories</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="theight">
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                      <?php foreach($categories as $category): ?>

                        <tr>
                            <th scope="row"><?= $category->getId()?></th>
                            <td><?= $category->getName()?></td>
                            <td class="text-right">
                                <a href="<?= $router->generate("category-update", ["categoryId" => $category ->getId()]) ?>" class="btn btn-sm btn-warning">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                      <?php endforeach; ?>

                    </tbody>
                </table>
                <a href="<?= $router->generate('category-list') ?>" class="btn btn-block btn-blue">Voir plus</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card text-white mb-3">
            <div class="card-header">Liste des produits</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $product): ?>

                      <tr>
                          <th scope="row"><?= $product->getId()?></th>
                          <td><?= $product->getName()?></td>
                          <td class="text-right">
                              <a href="<?= $router->generate("product-update", ["productId" => $product ->getId()]) ?>" class="btn btn-sm btn-warning">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>
                              <!-- Example single danger button -->
                              <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                      <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                  </div>
                              </div>
                          </td>
                      </tr>

                      <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= $router->generate('product-list') ?>" class="btn btn-block btn-blue">Voir plus</a>
            </div>
        </div>
    </div>
</div>
