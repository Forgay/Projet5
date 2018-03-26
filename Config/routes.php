<?php

return [

    'home' => ['path' => '/Web/',
        'action' => Src\UI\Action\HomeAction::class,
        'params' => ''],
    'Post_detail'=> ['path' => '/Web/post/detail/{id}',
        'action' => Src\UI\Action\PostDetailAction::class,
        'params' => '/d+'],
    'Add_comment'=>['path'=> '/Web/comment/add/{id}',
        'action' => Src\UI\Action\CommentAddAction::class,
        'params' =>'/d+'],
    'Connect'    =>['path'=> '/Web/connect',
        'action' => Src\UI\Action\ConnectAction::class,
        'params' =>'']
];
