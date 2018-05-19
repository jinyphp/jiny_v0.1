<?php
namespace App\Core;

class Application
{
    protected $_uri = [];
    protected $_control;
    protected $_controller;
    protected $_action = 'index';
    protected $_prams = [];

    protected $_body;

    // 생성자 매직 매서드
    public function __construct()
    {
        //echo "기본 동작클래스 ".__CLASS__." 객체가 생성이 되었습니다.<br>";
        
        // ReWrite로 전달된 부스트래핑 URL을 분석합니다.
        // 분석한 URL은 _controller, _action, _param에 저장됩니다.
        $this->explodeURI()->prepareURL();
        
        // 컨트롤러 호출
        if (!empty($this->_controller)) {
         
            // 컨트롤러 클래스 파일이 존재여부를 확인후에 처리함
            $controllerFilename = CONTROLLERS. $this->_controller. ".php";
            // echo $controllerFilename. "<br>";
            if (file_exists($controllerFilename)) {
                
                // 인스턴스 생성, 재저장 합니다.
                // echo "컨트롤러 인스턴스를 생성합니다.<br>";
                $this->_controller = new $this->_controller;

                // 액션 매소드를 호출합니다.
                if (method_exists($this->_controller, $this->_action)) {
                    // echo "메서드 호출";
                    // 콜백함수로 클래스의 메서드를 호출합니다.
                    call_user_func_array([$this->_controller, $this->_action], $this->_prams);
                } else {
                    // echo "컨트롤러에 메서드가 존재하지 않습니다.";
                }            

            } else {
                // echo "컨트롤러 파일이 존재하지 않습니다.<br>";
                // echo "기본 컨트롤러로 대체하여 실행이 됩니다.<br>";

                // 인스턴스를 기본 컨트롤러로 재저장 합니다.
                $this->_controller = new \App\Core\PageController;
                $this->_body = $this->_controller->index();                      

            }
       
        } else {
            // URI가 비어 있는 경우 동작.
            // 초기 root index 접속시 비어 있습니다. 이런경우 index 컨트롤러를 실행합니다.
            //echo "URI가 비어있는 동작처리 입니다.<br>";

            $this->_controller = new \App\Core\IndexController;
            $this->_action = "index";
            call_user_func_array([$this->_controller, $this->_action], $this->_prams);
        }
        

    }

    protected function prepareURL()
    {
        if (!empty($this->_uri)) {
            $url = $this->_uri;

            // 컨트롤러 선택합니다.
            $this->_controller = isset($url[0]) ? "\App\Core\".".ucwords($url[0]).'Controller' : '"\App\Core\IndexController';
            // echo "선택된 컨트롤러는 = ". $this->_controller. "입니다.<br>";

            // 실행 매서드를 선택합니다.
            $this->_action = isset($url[1]) ? $url[1] : 'index';            
            // echo "선택된 매소드는 = ". $this->_action. "입니다.<br>";

            // 파라미터
            // 추가 $url 배열값이 없는 경우 비어있는 [] 배열을 저장
            unset($url[0],$url[1]);
            $this->_prams = !empty($url) ? array_values($url): [];
        } else {
            // root 접속일 경우, URI가 비어있을 수 있습니다.
            // echo "URI가 비어 있습니다.<br>";
        }

        return $this;
    }

    protected function explodeURI()
    {
        //echo "URL을 분석하여 explod합니다.<br>";
        $request_uri = $_SERVER['REQUEST_URI'];
        $request = trim($request_uri, '/');
        if (!empty($request)) {
            $this->_uri = explode('/', $request);
        }

        return $this;
    }

}