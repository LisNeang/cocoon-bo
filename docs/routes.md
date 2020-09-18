# Routes

## Sprint 2

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Backoffice oShop | Backoffice dashboard | - |
| `/category/list` | `GET`| `CategoryController` | `list` | Liste des catégories | Categories list | - |
| `/category/add` | `GET|POST`| `CategoryController` | `add` | Ajouter une catégorie | Form to add a category | - |
| `/category/update/[i:categoryId]` | `GET|POST`| `CategoryController` | `update` | Éditer une catégorie | Form to update a category | [i:categoryId] is the category to update |
| `/category/delete/[i:categoryId]` | `GET`| `CategoryController` | `delete` | Supprimer une catégorie | Category delete | [i:categoryId] is the category to delete |
| `/category/home/edit` | `GET|POST`| `CategoryController` | `homeEdit` | Modifier les catégories de l'accueil | Form to update home categories list | - |
| `/brand/list` | `GET`| `BrandController` | `list` | Liste des marques | Categories list | - |
| `/brand/add` | `GET|POST`| `BrandController` | `add` | Ajouter une marque | Form to add a brand | - |
| `/brand/update/[i:brandId]` | `GET|POST`| `BrandController` | `update` | Éditer une marque | Form to update a brand | [i:brandId] is the brand to update |
| `/brand/delete/[i:brandId]` | `GET`| `BrandController` | `delete` | Supprimer une marque | Brand delete | [i:brandId] is the brand to delete |
| `/brand/footer/edit` | `GET|POST`| `BrandController` | `footerEdit` | Modifier les marques du footer | Form to update footer brands list | - |
| `/product/list` | `GET`| `ProductController` | `list` | Liste des produits | Product list | - |
| `/product/add` | `GET|POST`| `ProductController` | `add` | Ajouter un produit | Form to add a product | - |
| `/product/update/[i:productId]` | `GET|POST`| `ProductController` | `update` | Éditer un produit | Form to update a product | [i:productId] is the product to update |
| `/product/delete/[i:productId]` | `GET`| `ProductController` | `delete` | Supprimer un produit | Product delete | [i:productId] is the product to delete |
| `/type/list` | `GET`| `TypeController` | `list` | Liste des types | Types list | - |
| `/type/add` | `GET|POST`| `TypeController` | `add` | Ajouter un type | Form to add a type | - |
| `/type/update/[i:typeId]` | `GET|POST`| `TypeController` | `update` | Éditer un type | Form to update a type | [i:typeId] is the type to update |
| `/type/delete/[i:typeId]` | `GET`| `TypeController` | `delete` | Supprimer un type | Type delete | [i:typeId] is the type to delete |
| `/type/footer/edit` | `GET|POST`| `TypeController` | `footerEdit` | Modifier les types du footer | Form to update footer types list | - |
| `/user/list` | `GET`| `UserController` | `list` | Liste des utilisateurs | Users list | - |
| `/user/add` | `GET|POST`| `UserController` | `add` | Ajouter un utilisateur | Form to add a user | - |
| `/user/update/[i:userId]` | `GET|POST`| `UserController` | `update` | Éditer un utilisateur | Form to update a user | [i:userId] is the user to update |
| `/user/delete/[i:userId]` | `GET`| `UserController` | `delete` | Supprimer un utilisateur | User delete | [i:userId] is the user to delete |
| `/login` | `GET|POST`| `UserController` | `login` | Connecter un utilisateur | Form to connect a user | - |
| `/logout` | `GET`| `UserController` | `logout` | Déconnecter un utilisateur | User disconnection | - |
| `/tag/list` | `GET`| `TagController` | `list` | Liste des tags | tags list | - |
| `/tag/add` | `GET|POST`| `TagController` | `add` | Ajouter un tag | Form to add a tag | - |
| `/tag/update/[i:tagId]` | `GET|POST`| `TagController` | `update` | Éditer un tag | Form to update a tag | [i:tagId] is the tag to update |
| `/tag/delete/[i:tagId]` | `GET`| `TagController` | `delete` | Supprimer un tag | tag delete | [i:tagId] is the tag to delete |
| `/tag/product/edit` | `GET|POST`| `TagController` | `tagProduct` | Modifier les tags d'un produit | Form to update product tags | - |