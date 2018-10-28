<?php
namespace Controller;

use Category\Category;
use Model\CategoriesManager;
use Twig_Loader_Filesystem;
use Twig_Environment;
class CategoriesController extends AbstractController {


    private $twig;


    public function index()
    {
        $categoriesManager = new CategoriesManager($this->pdo);
        $categories = $categoriesManager->selectAllCategories();
        return $this->twig->render('categories.html.twig', ['categories' => $categories]);
    }


    public function show(int $id)
    {
        $categoryManager = new CategoriesManager($this->pdo);
        $category = $categoryManager->selectOneCategory($id);
        return $this->twig->render('showCategory.html.twig', ['add' => $category]);
    }

    public function add()
    {
        if (!empty($_POST)) {
            // TODO : validations des valeurs saisies dans le form
            // création d'un nouvel objet Item et hydratation avec les données du formulaire
            $category = new Category();
            $category->setName($_POST['name']);

            $categoryManager = new CategoriesManager();
            // l'objet $add hydraté est simplement envoyé en paramètre de insert()
            $categoryManager->insert($category);
            // si tout se passe bien, redirection
            header('Location: /');
            exit();
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('add.html.twig');
    }

}


?>