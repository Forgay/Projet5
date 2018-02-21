<?php

require('../model/frontend.php');

function listPost()
{
    $posts = getPosts();

    require('../view/listPostsView.php');
}