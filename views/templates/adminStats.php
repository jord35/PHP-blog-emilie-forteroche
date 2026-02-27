<?php 
    /** 
     * Affichage de la partie adminStats : liste les articles  avec pour chacun  le nombre de commentaires, le nombre de vue, la date de publication de l’article.
     * Et  Au clic sur chaque "Voir commentaires", en dessous du tableau, l'affichage de tous les commentaires correspondants à l'article. 
     */
?>

<h2>Statistiques des articles</h2>

<a class="submit" href="index.php?action=admin">← Gérer articles</a>

<div class="adminArticle">
    <?php foreach ($articles as $article) { ?>
        <div class="articleLine">
            <div class="title"><?= htmlspecialchars($article->getTitle()) ?></div>

            <div class="content">
                Vues : <?= (int) $article->getNumberOfViews() ?>
            </div>

            <div class="content">
                Publié : <?= $article->getDateCreation()->format('d/m/Y H:i') ?>
            </div>

            <div class="content">
                Commentaires : <?= (int) $article->getNumberOfComments() ?>
            </div>

            <div>
                <a class="submit" href="index.php?action=adminStats&article_id=<?= $article->getId() ?>">
                    Voir commentaires
                </a>
            </div>
        </div>
    <?php } ?>
</div>

<?php if ($selectedArticle) { ?>
    <h3>Commentaires pour : <?= htmlspecialchars($selectedArticle->getTitle()) ?></h3>

    <div class="adminArticle">
        <?php foreach ($comments as $comment) { ?>
            <div class="articleLine">
                <div class="title"><?= htmlspecialchars($comment->getPseudo()) ?></div>

                <div class="content"><?= htmlspecialchars($comment->getContent()) ?></div>

                <div class="content">
                    <?= $comment->getDateCreation()->format('d/m/Y H:i') ?>
                </div>

                <div>
                    <a class="submit"
                       href="index.php?action=deleteComment&id=<?= $comment->getId() ?>&article_id=<?= $selectedArticle->getId() ?>"
                       <?= Utils::askConfirmation("Supprimer ce commentaire ?") ?>>
                        Supprimer
                    </a>
                </div>
            </div>
        <?php } ?>

        <?php if (empty($comments)) { ?>
            <p>Aucun commentaire pour cet article.</p>
        <?php } ?>
    </div>
    <?php if ($totalCommentPages > 1) { ?>
        <div class="pagination">
            <?php if ($commentPage > 1) { ?>
                <a class="submit"
                   href="index.php?action=adminStats&article_id=<?= (int) $selectedArticle->getId() ?>&comment_page=<?= (int) ($commentPage - 1) ?>">
                    ← Précédent
                </a>
            <?php } ?>

            <?php if ($commentPage < $totalCommentPages) { ?>
                <a class="submit"
                   href="index.php?action=adminStats&article_id=<?= (int) $selectedArticle->getId() ?>&comment_page=<?= (int) ($commentPage + 1) ?>">
                    Suivant →
                </a>
            <?php } ?>
        </div>
    <?php } ?>

    <a class="submit" href="index.php?action=adminStats">← Retour stats</a>
<?php } ?>
