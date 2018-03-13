<?php

ob_start(); ?>

<div class="section">
    <div class="row">
        <?php
        foreach($posts as $post){
            ?>
            <div class="col l6 m6 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="grey-text text-darken-2"><?= $post->title ?></h5>
                        <h6 class="grey-text">Le <?= date("d/m/Y à H:i",strtotime($post->date)); ?> par <?= $post->writer ?></h6>
                    </div>
                    <div class="card-image waves-effect waves-block waves-light">
                        <img src="../web/img/posts/<?= $post->image ?>.jpg" class="activator" alt="<?= $post->title ?>"/>
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
                        <p><a href="../../web/index1.php?action=article&amp;id=<?= $post->id ?>">Voir l'article complet</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><?= $post->title ?> <i class="material-icons right">close</i></span>
                        <p><?= substr(nl2br($post->content),0,1000); ?>...</p>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>
<?php if (array_key_exists('errors',$_SESSION)):?>

<div class="alert alert-danger">
    <?=implode('<br>', $_SESSION['errors']); ?>
</div>

<?php unset($_SESSION['errors']);  endif;?>

<form action="../../web/index1.php?action=contact" method="POST">
    <div class="row">
        <div class="input-field col s6">
            <input id="nom" type="text" class="validate">
            <label for="nom">Nom</label>
        </div>
        <div class="input-field col s6">
            <input id="email" type="text" class="validate">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea id="message" class="materialize-textarea"></textarea>
            <label for="message">Votre message</label>
        </div>
    </div>
    <a>
        <button class="btn waves-effect waves-ripple" type="submit" name="action">
          Envoyer
        </button>
    </a>
</form>

<?php $content = ob_get_clean();?>
<?php require('template.php'); ?>

