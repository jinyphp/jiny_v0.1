<?php
/**
 * 사이트 메뉴배열을 설정할 수 있습니다.
 * 메뉴배열을 적용하기 위해서는 템플릿 코드를 문서내에 같이 사용해야 합니다.
 */
return [
    [
        'name'=>"Framworks",
        'href'=>"/jiny",
        'ko'=>'지니',
        'en'=>"jiny",
        'menu1'=>[
            [
                'name'=>"core",
                'href'=>"/jiny/core",
                'ko'=>'코어',
                'en'=>"core"
            ],
            [
                'name'=>"template",
                'href'=>"/jiny/template",
                'ko'=>"템플릿",
                'en'=>"template"
            ]
        ]
    ],
    [
        'name'=>"SRC",
        'ko'=>'소스코드',
        'en'=>"Source",
        'href'=>"/source"
    ],
    [
        'name'=>"PHP",
        'href'=>"/php",
        'ko'=>"PHP",
        'en'=>"PHP",
        'menu1'=>[
            [
                'name'=>"php1",
                'href'=>"/php/php1",
                'ko'=>'넘버원',
                'en'=>"PHP1"
            ],
            [
                'name'=>"php2",
                'href'=>"/php/php2",
                'ko'=>'넘버투',
                'en'=>"PHP2"
            ],
            [
                'name'=>"php3",
                'href'=>"/php/php3",
                'ko'=>'넘버쓰리',
                'en'=>"PHP3"
            ]
        ]
    ],
    [
        'name'=>"HTML",
        'href'=>"/html",
        'ko'=>"HTML",
        'en'=>"HTML"
    ],
    [
        'name'=>"Javascript",
        'href'=>"/javascript",
        'ko'=>"Javascript",
        'en'=>"Javascript"
    ],
    [
        'name'=>"GIT",
        'href'=>"/git",
        'ko'=>"Git",
        'en'=>"Git"
    ],
    [
        'name'=>"Server",
        'href'=>"/server",
        'ko'=>"Server",
        'en'=>"Server"
    ]
];