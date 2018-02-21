<?php

function dbConnect()
{
    try
    {
    $db = new PDO('mysql:dbname=blog; host=localhost', 'root', '');
    return $db;
    }
    catch(Exception $e)
    {
        die('erreur :' . $e->getMessage());
    }
}
function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id,title,content,writer,image,DATE_FORMAT(date,\%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM posts WHERE posted = 1 ORDER BY id DESC');
    return $req;
}