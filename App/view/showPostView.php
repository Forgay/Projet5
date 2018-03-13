<?php
ob_start();
?>

    <h2>Listing des articles</h2>
    <hr/>

<?php

$posts = getPosts();
foreach($posts as $post){
    ?>
    <div class="row">
        <div class="col s12">
            <h4><?= $post->title ?><?php echo ($post->posted == "1") ? "<i class='material-icons'>lock</i>" : "" ?></h4>

            <div class="row">
                <div class="col s12 m6 l8">
                    <?= substr(nl2br($post->content),0,1200) ?>...
                </div>
                <div class="col s12 m6 l4">
                    <img src="../web/img/posts/<?= $post->image ?>" class="materialboxed responsive-img" alt="<?= $post->title ?>"/>
                    <br/><br/>
                    <a class="btn light-blue waves-effect waves-light" href="../../web/index1.php?action=post&amp;id=<?= $post->id ?>">Lire l'article complet</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>

<?php $content = ob_get_clean(); ?>
<?php require('backend/template.php'); ?>