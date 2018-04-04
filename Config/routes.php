<?php

return [

        'Home'   => ['path' => '/',
        'action' => Src\UI\Action\HomeAction::class,
        'params' => ''],

        'Post_detail' => ['path' => '/post/detail/{id}',
        'action' => Src\UI\Action\PostDetailAction::class,
        'params' => ['id'=>'/\d+/']],

        'Add_comment' => ['path'=> '/comment/add/{id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params' => ['id'=>'/\d+/']],

        'Connect' => ['path' => '/connect',
        'action' => Src\UI\Action\ConnectAction::class,
        'params' => '']
];

