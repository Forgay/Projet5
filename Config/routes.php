<?php

return [

        'Home'   => ['path' => '/',
        'action' => Src\UI\Action\HomeAction::class,
        'params' => ''],

        'Post_detail' => ['path' => '/post/detail/{id}',
        'action' => Src\UI\Action\PostDetailAction::class,
        'params' => '\d+'],

        'Add_comment' => ['path'=> '/comment/add/{id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params' => '\d+'],

        'Connect' => ['path' => '/connect',
        'action' => Src\UI\Action\ConnectAction::class,
        'params' => ''],

        'Enroll' => ['path' => '/enroll',
        'action' => Src\UI\Action\Enroll::class,
        'params' => '']
];

