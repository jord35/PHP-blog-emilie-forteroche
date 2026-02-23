<?php 
    /** 
     * Affichage de la partie adminStats : liste les articles  avec pour chacun  le nombre de commentaires, le nombre de vue, la date de publication de l’article.
     * Et  Au clic sur chaque "Voir commentaires", en dessous du tableau, l'affichage de tous les commentaires correspondants à l'article. 
     */
?>

<h2>Statistiques des articles</h2>
<a class="submit" href="index.php?action=admin">← Gérer articles</a>

<div class="adminArticle">
    <?php foreach ($articles as $article): ?>
        <div class="articleLine">
            <div class="title"><?= htmlspecialchars($article->getTitle()) ?></div>
            <div class="content"><?= $article->getNumberOfViews() ?></div>
            <div class="content"><?= $article->getDateCreation() ?></div>
            <div class="content"><?= $article->getNumberOfReviews() ?></div>
            <div>
                <a class="submit" href="index.php?action=adminStats&article_id=<?= $article->getId() ?>">Voir commentaires</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($selectedArticle): ?>
    <h3>Commentaires pour : <?= htmlspecialchars($selectedArticle->getTitle()) ?></h3>
    
    <div class="adminArticle">
        <?php foreach ($comments as $comment): ?>
            <div class="articleLine">
                <div class="title"><?= htmlspecialchars($comment->getPseudo()) ?></div>
                <div class="content"><?= htmlspecialchars($comment->getContent()) ?></div>
                <div class="date"><?= $comment->getDateCreation() ?></div>
                <div>
                    <a class="submit" href="index.php?action=deleteComment&id=<?= $comment->getId() ?>"
                       <?= Utils::askConfirmation("Supprimer ce commentaire ?") ?>>
                        Supprimer
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($comments)): ?>
            <p>Aucun commentaire pour cet article.</p>
        <?php endif; ?>
    </div>
    
    <a class="submit" href="index.php?action=adminStats">← Retour stats</a>
<?php endif; ?>

