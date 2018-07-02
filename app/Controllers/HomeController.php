<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class HomeController extends Controller
{

    public function __construct($app=Null)
    {
        \TimeLog::set(__CLASS__);
        //controller
        $this->setApp($app);
    }

    // 기본실행 메서드
    public function index()
    {
        \TimeLog::set(__METHOD__);
        return "Hi, Jiny!";
    }

    public function hello()
    {
        \TimeLog::set(__METHOD__);  
        return $this->view();      
    }

}