<?php

/**
 * 포스트
 * 컨트롤러를 호출합니다.
 */

$r->get('/post', function($vars=[]){
    // echo "라우트 포스트 실행<br>";
    return controller("PostController", "index", $vars);
});

$r->get('/post/{year}/{month}/{day}/{name}', function($vars=[]){
    //echo "라우트 포스트 실행<br>";
    return controller("PostController", "View", $vars);
});

/**
 * 직접 뷰를 호출 할수 있습니다.
 */
$r->get('/welcom', function($vars=[]){
    return view("/test/welcom", $vars);
});

/**
 * 직접 메시지를 출력할 수 있습니다.
 */
$r->get('/message', function($vars=[]){
    return "hello world!";
});


$r->get('/datas', function($vars=[]){
    return [1, 2, 3, 4, 5, 6, 7, 8, 9];
});
