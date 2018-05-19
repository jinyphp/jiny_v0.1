<?php
namespace App\Core;

class PageController extends Controller
{
    // 기본실행 메서드
    public function index()
    {
        // echo __METHOD__."를 호출합니다.<br>";
        
        $request_uri = $_SERVER['REQUEST_URI'];
        $request = trim($request_uri, '/');
        if (!empty($request)) {
            $url = explode('/', $request);

            // 정적 페이지의 파일 경로를 재생성합니다.
            foreach ($url as $path) $page .= $path. DS;                        
            $this->view($page."index", [
                'name'=>$name,
                'id'=>$id
            ]);

            // 매서드체인 호출방식으로 실행을 합니다.
            // 메서드 체인은 1권, 344페이지 설명 참고
            $this->_view->create()->show();
            
        }
    }

}