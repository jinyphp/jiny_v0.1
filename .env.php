<?php
return [
    'base'=>'',
    'path'=> [
        'app'=>"../app",
        'conf' => "/conf",
        'theme' => "/theme",
        'view' => "/resource/views",
        'pages' => "/resource/pages",
        'layout' => "/resource/layout",
        'route' => "/app/route"
    ],    
    'Resource'=> [
        'Indexs'=>[
            "index.htm",
            "index.md",
            "index.docx"
        ],
        'menu'=>[
            'type' => "json",
            'path' => "/resource/menu",
            'file' => "menu.json"
        ]
    ],
    'Tamplate'=> [
        'PreProcess' => true,
        'Engine' => "Liquid",
        'Cache' => false
    ]
];