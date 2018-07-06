<?php

/**
 * 포스트
 */
$r->get('/post', function(){
    $this->App->_controller = "PostController";
    $this->App->_action = 'index';

    $this->App->_viewFile = "/post";
    echo "hello";

});

$r->addRoute('GET', '/post/{id:\d+}', function(){
    $this->App->_controller = "PostController";
    $this->App->_action = 'index';
    $this->App->_viewFile = "/post";
    echo "post_ids";
});

