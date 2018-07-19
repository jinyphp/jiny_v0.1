<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class MenuController extends Controller
{
    public $_body = "";

    public function __construct($app=NULL)
    {
        //controller
        $this->setApp($app);
    }

    // 기본실행 메서드
    public function index()
    {
        //echo $_SERVER['REQUEST_METHOD']."<br>";
        // echo $_POST["_method"]."<br>";
        if($_SERVER['REQUEST_METHOD'] == "post") {
            // echo "<script> alert('post'); </script>";
        }

        //echo "메뉴 어드민을 출력합니다.<br>";
      
        // $menu = include "./data/menu/menu.php";
        $menu = file_get_contents("./data/menu/menu.json");
        
        $menu =\json_decode($menu, TRUE);
        //print_r($menu);
        $this->html_ul($menu);

        // 처리될 페이지 경로
        //$this->App->_viewFile = "menu";
        $viewData['content'] = $this->_body;
        $viewData['menus'] = menu();

        return view("menu", $viewData);

    }

    public function html_ul($arr)
    {
        $this->_body .= "<ul>";
        foreach ($arr as $name) {
            $this->_body .= "<li> <a data-toggle='modal' data-target='#exampleModalCenter'>".$name['name']."</a>";

            if (isset($name['menu']) && is_array($name['menu'])) $this->html_ul($name['menu']);
            $this->_body .= "</li>";
        }
        $this->_body .= "</ul>";
    }


}