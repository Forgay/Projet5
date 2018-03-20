<?php

return[

    'home'=> ['path'=>'/Web/','action'=>'HomeAction()','params'=>''],
    'Post_detail'=>['path'=>'/post/detail/{id}',
        'action'=>'Src/UI/Action/PostDetailAction::class',
        'params'=>'/d+'],
];