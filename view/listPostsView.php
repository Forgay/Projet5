<?php ob_start(); ?>

<div class="section">

    <!--   Icon Section   -->
    <div class="row">
        <?php
        while ($data = $posts->fetch())
        {
        ?>
        <div class="col s12 m4">
            <div class="icon-block">
                <div class="card-image">
                    <img src="/vendor/img/<?= ($data['image']) ?>.jpg" width="200px"/>
                </div>
                <h5 class="center"><?= htmlspecialchars($data['title']) ?></h5>

                <p class="light"><?= htmlspecialchars($data['content']) ?></p>
                <em><a href="../web/index.php?action=article&amp;id=<?= $data['id']?>">Voir l'article</a></em>
            </div>
        </div>
       <?php
        }
        $posts->closeCursor();
        ?>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require ('template.php'); ?>

