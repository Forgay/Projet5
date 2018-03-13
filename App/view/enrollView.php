<?php
ob_start(); ?>

    <div class="section">


    <div class="row">

        <div class="col l4 m6 s12 offset-l4 offset-m3">
            <div class="card-panel">
                <div class="row">
                    <img src="../../web/img/admin.png" alt="administrateur" width="50%"/>
                </div>
                <h4 class="center-align">S'inscrire</h4>
                <?php if (!empty($errors)) {
                    ?>
                    <div class="card red">
                        <div class="card-content white-text">
                            <?php foreach ($errors as $error) {
                                echo $error . "<br/>";
                            } ?>
                        </div>
                    </div>
                    <?php
                } ?>


                <form action="../../web/index1.php?action=inscription" method="POST">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="pseudo" name="pseudo"/>
                            <label for="pseudo">Votre pseudo</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="email" id="email" name="email"/>
                            <label for="password">votre adresse mail</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="password" id="password" name="password"/>
                            <label for="password">Mot de passe</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="password" id="passwordverif" name="passwordverif"/>
                            <label for="passwordverif">Vérification du mot de passe</label>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="waves-effect waves-light btn light-green">
                        <i class="material-icons left">perm_identity</i>
                        Se connecter
                    </button>
                    <br/><br/>
                    <a href="ew.php">s'identifier</a>

            </div>

        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>