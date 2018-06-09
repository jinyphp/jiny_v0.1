<?php
namespace App\Controllers;

class HomeController
{
    public $_app;

    public function __construct($app)
    {
        echo __CLASS__." 객체가 생성이 되었습니다.<br>";
        $this->_app = $app;
    }

    // 기본실행 메서드
    public function index()
    {
        echo __METHOD__."를 호출합니다.<br>";
        
    }

    // 기본실행 메서드
    public function boot()
    {
        echo __METHOD__."를 호출합니다.<br>";

        echo "<pre>";
        print_r($this->_app->_prams);
        echo "</pre>";
        echo "<hr>";
        
    }

}