<?php
session_start();
ob_start(); ?>

<div class="section">
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
<?php if (array_key_exists('errors',$_SESSION)):?>

<div class="alert alert-danger">
    <?=implode('<br>', $_SESSION['errors']); ?>
</div>

<?php unset($_SESSION['errors']);  endif;?>
<form action="../model/contact.php" method="POST">
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
<?php require ('template.php'); ?>

