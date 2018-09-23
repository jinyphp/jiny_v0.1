<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class HomeController extends Controller
{

    public function __construct($app=Null)
    {
        //controller
        $this->setApp($app);
    }

    // 기본실행 메서드
    public function index()
    {
        echo "Home 기본컨트롤러 실행<br>";
        return "Hi, Jiny!";
    }

    public function hello()
    { 
        return $this->view();      
    }

}