
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Parallax Template - Materialize</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../Web/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../Web/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="../Web/index1.php?action=home" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">

            <li><a href="../Web/index1.php?action=write">Ajouter un article</a></li>
            <li><a href="../Web/index1.php?action=list">liste des articles</a></li>
            <li><a href="../Web/index1.php?action=logout">Se déconnecter</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">

            <li><a href="../Web/index1.php?action=write">Ajouter un article</a></li>
            <li><a href="../Web/index1.php?action=list">liste des articles</a></li>
            <li><a href="../Web/index1.php?action=logout">Se déconnecter</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center teal-text text-lighten-2"></h1>
            <div class="row center">
                <h5 class="header col s12 light">« Créer, c’est vivre deux fois », Albert Camus</h5>
            </div>
            <div class="row center">
                <a href="http://materializecss.com/getting-started.html" id="download-button"
                   class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
            </div>
            <br><br>

        </div>
    </div>
    <div class="parallax"><img src="../Web/img/background1.jpg" alt="Unsplashed background img 1"></div>
</div>


<div class="container">
    <?= $content ?>
</div>


<footer class="page-footer teal">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Company Bio</h5>
                <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's
                    our full time job. Any amount would help support and continue development on this project and is
                    greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="/Web/js/materialize.js"></script>
<script src="/Web/js/init.js"></script>

</body>
</html>