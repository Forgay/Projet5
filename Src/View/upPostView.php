<?php
ob_start();
?>

<h2>Modifier l'article</h2>

<form method="post">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title" value="<?= ($postad['title']) ?>"/>
            <label for="title">Titre de l'article</label>
        </div>
        <div class="input-field col s12">
            <textarea id="content" name="content" class="materialize-textarea"><?=($postad['content']) ?></textarea>
            <label for="content">Contenu de l'article</label>
        </div>

        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public" <?php echo ($postad['title'=="1"]) ? "checked" : "" ?>/>
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>

        <div class="col s6 right-align">
            <br/><br/>
            <button type="submit" class="btn" name="submit">Modifier l'article</button>

        </div>


    </div>



</form>
<?php $content = ob_get_clean(); ?>
<?php require('backend/AdminsLayout.html.twig'); ?>
