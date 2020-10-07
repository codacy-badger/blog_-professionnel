<?php
$title = 'Mon blog';
?>

<?php ob_start();
?>
<br />

<div class="row bordure">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="card border-success mb-3" style="max-width: 50rem;">
            <h2 class="bordure">gestion des commentaires :</h2>
            <?php foreach ($posts as $post) :

                $title = htmlspecialchars($post->getTitle()); ?>
                <div class="row news">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="card border-primary mb-3" style="max-width: 50rem;">
                            <h3 class="bordure card-header  ">
                                <?= htmlspecialchars($post->getTitle()); ?>
                                <em>le <?= $post->getDate(); ?></em>
                                <p>auteur : <?= nl2br(htmlspecialchars($post->getUserId())); ?></p>
                            </h3>

                            <div class="bordure card-title list-group-item">
                                <?= nl2br(htmlspecialchars($post->getChapo())); ?>

                            </div>
                            <p class="bordure card-text">
                                <?= nl2br(htmlspecialchars($post->getContent()));  ?>
                            </p>

                        </div>
                    </div>
                </div>
            <?php endforeach;
            ?>
            <?php
            foreach ($comments as $comment) :
            ?>
                <div class="row bordureCom">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="card border-success mb-3 ">
                            <label for="title"> Par <?= htmlspecialchars($comment->getUserId()); ?>, le <?= $comment->getDate()  ?> </label>
                            <h4 class="table-success"><?= nl2br(htmlspecialchars(($comment->getTitle()))) ?> </h4>
                            </label>
                            <div class="card-text bordureCom  ">
                                <label for="content"> <?= nl2br(htmlspecialchars(($comment->getContent()))); ?></label>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <form action="index.php?action=updateStatusComment&id=<?= $comment->getId() ?>" method="POST">
                                        <div class="bordure"> <button type="submit" class="btn btn-success"> Valider </button>
                                    </form>
                                </div>
                                <form action="index.php?action=deleteComment&id=<?= $comment->getId() ?>" method="POST">
                                    <div class="bordure"><button type="submit" class="btn btn-primary"> Rejeter</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div> <br />
<?php
            endforeach;
?>


<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>