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
    'ResetPassword' => [
        'path' =>'/mailreset/password/{token}',
        'action' => Src\UI\Action\ShowResetPasswordAction::class,
        'params' => ['token' => '/[a-zA-Z0-9]+/']
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
    'Contact' => [
        'path' => '/contact',
        'action' => Src\UI\Action\ContactAction::class,
        'params' => []
    ],
    'Reset' => [
        'path' => '/reset',
        'action' => Src\UI\Action\ResetAction::class,
        'params' => []
    ],
    'Send' => [
        'path' => '/send',
        'action' => Src\UI\Action\SendPasswordAction::class,
        'params' => []
    ],
    'UpDatePassword'=>[
        'path' =>'/update/password',
        'action' => Src\UI\Action\UpDatePasswordAction::class,
        'params' => []
    ],
    'Dashboard' => [
        'path' => '/dashboard',
        'action' => Src\UI\Action\DashboardAction::class,
        'params' => [],
        'secured' => true
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
        'action' => Src\UI\Action\UpDatePostAction::class,
        'params' => ['PostId' => '/\d+/'],
        'secured' => true
    ],
    'Valid_Comment' => [
        'path' => '/validcomment/{comid}',
        'action' => Src\UI\Action\ValidCommentAction::class,
        'params' => ['comid' => '/\d+/'],
        'secured' => true
    ],
    'Delet_Post' => [
        'path' => '/deletepost/{poid}',
        'action' => Src\UI\Action\DeletePostAction::class,
        'params' => ['poid' => '/\d+/'],
        'secured' => true
    ],
    'Delet_Comment' => [
        'path' => '/deletecomment/{coid}',
        'action' => Src\UI\Action\DeleteCommentAction::class,
        'params' => ['coid' => '/\d+/'],
        'secured' => true
    ],
    'Disconnect' => [
        'path' => '/disconnect',
        'action' => Src\UI\Action\DisconnectAction::class,
        'params' => []
    ],
];
