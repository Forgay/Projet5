<?php
ob_start();

?>

    <h2>Poster un article</h2>

    <div class="card red">
        <div class="card-content white-text">
            <?php
            foreach($errors as $error){
                echo $error."<br/>";
            }
            ?>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title"/>
            <label for="title">Titre de l'article</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
            <label for="content">Contenu de l'article</label>
        </div>
        <div class="col s12">
            <div class="input-field file-field">
                <div class="btn col s2">
                    <span>Image de l'article</span>
                    <input type="file" name="image" class="col s12"/>
                </div>
                <input type="text" class="file-path col s10" readonly/>
            </div>
        </div>

        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public"/>
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>

        <div class="col s6 right-align">
            <br/><br/>
            <button class="btn" type="submit" name="post">Publier</button>
        </div>

    </div>
<?php $content = ob_get_clean(); ?>
<?php require('backend/AdminsLayout.html.twig'); ?>