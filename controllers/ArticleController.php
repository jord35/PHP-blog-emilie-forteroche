<?php 

class ArticleController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle() : void
{
    // Récupère l'id
    $id = (int) Utils::request("id", -1);

    // Charge l'article + incrémente les vues
    $articleManager = new ArticleManager();
    if (
            isset($_SESSION['skip_view_increment_for_article']) &&
            (int)$_SESSION['skip_view_increment_for_article'] === $id
        ) 
        {
            unset($_SESSION['skip_view_increment_for_article']);
        } 
    else {
    $articleManager->incrementViews($id);
    }
    $article = $articleManager->getArticleById($id);

    if (!$article) {
        throw new Exception("L'article demandé n'existe pas.");
    }

    // Charge les commentaires
    $commentManager = new CommentManager();
    $comments = $commentManager->getAllCommentsByArticleId($id);

    // Affiche la vue
    $view = new View($article->getTitle());
    $view->render("detailArticle", [
        'article' => $article,
        'comments' => $comments
    ]);
}

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }
}