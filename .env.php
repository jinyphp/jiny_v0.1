<?php
return [
    'base'=>'',
    'path'=> [
        'app'=>"../app",
        'conf' => "/conf",
        'theme' => "/theme",
        'view' => "/resource/htmls"
    ],    
    'Resource'=> [
        'Indexs'=>[
            "index.htm",
            "index.md",
            "index.docx"
        ]
    ],
    'Tamplate'=> [
        'PreProcess' => true,
        'Engine' => "Liquid"
    ],
    'theme'=>[
        'engine'=>'hexo'
    ]
];