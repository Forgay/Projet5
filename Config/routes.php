<?php

return [

    'home' => ['path' => '/Web/',
        'action' => Src\UI\Action\HomeAction::class,
        'params' => ''],
    'Post_detail' => ['path' => '/post/detail/{id}',
        'action' => Src\UI\Action\PostDetailAction::class,
        'params' => '/d+'],
    'Add_comment'=>['path'=> '/comment/add/{id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params'=>'' ]
];