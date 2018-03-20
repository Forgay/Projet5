<?php

return[

    'home'=> ['path'=>'/Web/','action'=>Src\UI\Action\HomeAction::class],
    'Post_details'=>['path'=>'/post/details/{id}',
        'action'=>Src/UI/Action/ArticleDetailsAction::class,
        'params'=>['id'=>'/d+']
    ]
];