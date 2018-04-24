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
        'path' => '/comment/add/{post_id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params' => ['post_id' => '/\d+/']
    ],
    'Login' => [
        'path' => '/login',
        'action' => Src\UI\Action\LoginAction::class,
        'params' => []
    ],
    'Register' => [
        'path' => '/register',
        'action' => Src\UI\Action\RegisterAction::class,
        'params' => []
    ],
    'Logon' => [
        'path' => '/logon',
        'action' => Src\UI\Action\LogonAction::class,
        'params' => []
    ],
    'Connect' => [
        'path' => '/connect',
        'action' => Src\UI\Action\ConnectAction::class,
        'params' => []
    ],
    'Connecting' => [
        'path' => '/connecting',
        'action' => Src\UI\Action\ConnectingAction::class,
        'params' => []
    ],
    'Dashboard' =>[
        'path' => '/dashboard',
        'action' => Src\UI\Action\DashboardAction::class,
        'params' => [],
        'secured'=> true
    ],
    'Add_Post' => [
        'path' => '/post/add',
        'action' => Src\UI\Action\AddPostAction::class,
        'params' => [],
        'secured' => true
    ],
    'Post_Add ' => [
        'path' => '/add/post',
        'action' => Src\UI\Action\PostAddAction::class,
        'params' => [],
        'secured' => true
    ],
    'List_Post' => [
        'path' => '/post/list',
        'action' => Src\UI\Action\ShowPostAction::class,
        'params' => [],
        'secured' => true
    ],
    'Show_Post_detail' => [
        'path' => '/post/show/{showid}',
        'action' => Src\UI\Action\PostShowAction::class,
        'params' => ['showid' => '/\d+/'],
        'secured' => true
    ],
    'Update_Post' => [
        'path' => '/post/update/{PostId}',
        'action' => Src\UI\Action\UpdatePostAction::class,
        'params' => ['PostId' => '/\d+/'],
        'secured' => true
    ],
    'Sign_Out' => [
        'path' => '/',
        'action' => Src\UI\Action\SignOutAction::class,
        'params' => []
    ],
    'Contact' => [
        'path' => '/contact',
        'action' => Src\UI\Action\ContactAction::class,
        'params' => []
    ],
];
