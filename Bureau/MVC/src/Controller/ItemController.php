<?php

namespace Controller;
use Model\ItemManager;
use Model\Item;

class ItemController extends AbstractController {


    protected $twig;

    public function index()
    {
        $itemManager = new ItemManager($this->pdo);
        $items = $itemManager->selectAll();
        return $this->twig->render('item.html.twig', ['items' => $items]);
    }


    public function show(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        return $this->twig->render('showItem.html.twig', ['item' => $item]);
    }

    public function add() // on crée une fonction add
    {
        if (!empty($_POST)) {
            // TODO : validations des valeurs saisies dans le form
            // création d'un nouvel objet Item et hydratation avec les données du formulaire
            $item = new Item();
            $item->setTitle($_POST['title']);

            $itemManager = new ItemManager($this->pdo);
            // l'objet $item hydraté est simplement envoyé en paramètre de insert()
            $itemManager->insert($item);
            // si tout se passe bien, redirection
            header('Location: /');
            exit();
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('add.html.twig'); // pour que le programme comprenne sur quelle page la fonction doit être appliquée
    }

    public function update($id) // on crée une fonction update
    {
        $itemManager=new ItemManager($this->pdo); // on instancie un nouvel itemManager
        $item=$itemManager->selectOneById($id); // on utilise la fonction de itemManager pour sélectionner un item par son id

        if (!empty($_POST)){ // si il y a POST
            $item->setTitle($_POST['title']); // setTitle de item.php permet de changer de titre
            $itemManager->update($item); // la fonction update permet de valider le changement de titre dans la base de données
            header('location: /'); // on redirige vers la page d'accueil
            exit();
        }
        return $this->twig->render('update.html.twig', ['item' => $item]); // pour que le programme comprenne sur quelle page la fonction doit etre appliquée
    }

    public function delete($id)  // on crée une fonction delete
    {
        $itemManager=new ItemManager($this->pdo); // on instancie un nouvel itemmanager
        $item=$itemManager->selectOneById($id); // on utlise la fonction de itemManager pour sélectionner un item par son id

        if (!empty($_POST)){ // si il y a POST
            $item->setTitle($_POST['title']); // setTitle de item.php ne sert à rien ici mais est nécéssaire au déroulement de la fonction
            $itemManager->delete($item); // on supprime l'item grace à delete de itemManager
            header('location: /'); // on redirige vers la page d'accueil
            exit();
        }
        return $this->twig->render('delete.html.twig', ['item' => $item]); // pour que le programme comprenne sur quelle page la fonction doit etre appliquée
    }

}

?>