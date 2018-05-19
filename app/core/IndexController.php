<?php
namespace App\Core;

class IndexController extends Controller
{
    // 생성자 매직 매서드
    public function __construct()
    {
        //echo __CLASS__. "객체를 생성합니다.<br>";
    }

    public function index($id='', $name='')
    {   
        // echo __METHOD__."를 호출합니다.<br>";

        // 뷰객체 인스턴스를 생성합니다. 컨트롤러의 팩토리패턴을 이용하여 생성을 합니다.
        // $viewFile = "home\index";
        $viewFile = "index";
        $this->view($viewFile, [
            'name'=>$name,
            'id'=>$id
        ]);

        /*
        echo "action = ". $this->view->getAction();
        */  
        
        // 뷰를 페이지를 생성합니다.
        $this->_view->create($data)->show();
        
    }


}