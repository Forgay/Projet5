<?php

return [
    'Home' => [
        'path' => '/',
        'action' => Src\UI\Action\HomeAction::class,
        'params' => []
    ],
    'Post_detail' => [
        'path' => '/post/detail/{id}',
        'action' => Src\UI\Action\PostDetailAction::class,
        'params' => ['id' => '/\d+/']
    ],
    'Add_comment' => [
        'path' => '/comment/add/{id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params' => ['id' => '/\d+/']
    ],
    'Register' => [
        'path' => '/register',
        'action' => Src\UI\Action\RegisterAction::class,
        'params' => []
    ],
    'Connect' => [
        'path' => '/connect',
        'action' => Src\UI\Action\ConnectAction::class,
        'params' => []
    ],
    'Add_Post' => [
        'path' => '/post/add',
        'action' => Src\UI\Action\PostAddAction::class,
        'params' => []
    ],
    'List_Post' => [
        'path' => '/post/list',
        'action' => Src\UI\Action\ShowPostAction::class,
        'params' => []
    ],
    'Update_Post' => [
        'path' => '/post/update/{id}',
        'action' => Src\UI\Action\UpdatePostAction::class,
        'params' => ['id' => '/\d+/']
    ],
    'Sign_Out' => [
        'path' => '/',
        'action' => Src\UI\Action\SignOutAction::class,
        'params' => []
    ],
];
