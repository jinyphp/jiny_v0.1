<?php

use \Jiny\Core\Route\Route;

$this->App->_action = 'index';
$this->_viewFile = "/post";

Route::get('/post',function(){
    return "aaa";
});