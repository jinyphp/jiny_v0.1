<?php
namespace App\Core;

class View {
    protected $view_file;
    protected $view_data;

    protected $_body;
    protected $_header;
    protected $_footer;

    protected $_menu = [];

    public function __construct($view_file, $view_data)
    {
        // echo "클래스 ".__CLASS__." 객체 인스턴스가 생성이 되었습니다.<br>";
        $this->view_file = $view_file;
        $this->view_data = $view_data;
    }

    // View HTML파일을 로드합니다. 읽어온 내용은 _body에 저장을 합니다.
    // HTMLS 경로디렉토리
    public function create($data=[])
    {
        // echo __METHOD__."를 호출합니다.<br>";
        // echo "뷰 파일을 생성합니다.<br>";
        $filename = HTMLS. $this->view_file. '.htm';
        // echo $filename."<br>";
        if (file_exists($filename)) {
            // 파일이 존재할경우 내용을 읽어옵니다.
            $this->_body = file_get_contents($filename);
            
            // 환경설정에서 허용한 html 테그만 허용합니다.
            /*
            if ($GLOBAL['config']['html']['tags_allow']) {
                $this->_body = strip_tags($this->_body, $GLOBAL['config']['html']['tags_allow']);
            }
            */            

        } else {
            $this->_body = "렌더링할 view 파일이 없습니다.";
        }

        return $this;
    }

    // 화면을 출력합니다.
    public function show()
    {
        // echo __METHOD__."를 호출합니다.<br>";
        // 해더와 푸터 데이터를 Loading 합니다.
        $this->header()->footer();
        
        // 해더 화면을 먼저 출력합니다.
        echo $this->_header;

        // 바디를 출력합니다.
        echo $this->_body;

        // 푸터를 출력합니다.
        echo $this->_footer;        
    }

    public function getAction()
    {
        // echo __METHOD__."를 호출합니다.<br>";
        // 반환되는 값은 배열타입 입니다.
        // 배열의 1을 반환합니다.
        // echo "view_file = ". $this->view_file. "<br>";
        return (explode('\\', $this->view_file)[1]);
    }

    // 공통적으로 처리되는 상단 내용을 읽어옵니다.
    // 읽어올 설정파일은 config에 설정되어 있습니다.
    public function header()
    {
        // echo __METHOD__."를 호출합니다.<br>";
        // 해더 HTML의 파일의 경로를 확인합니다.
        // 지정한 경로에 상단해더 파일이 있는지 확인후에 값을 읽어옵니다.
        $filename = $GLOBALS['config']['theme']['path']. DS. $GLOBALS['config']['theme']['name']. DS. $GLOBALS['config']['theme']['header'];
        if (file_exists($filename)) {
            $this->_header = file_get_contents($filename);
        } else {
            $this->_header = "해더파일이 없습니다.";
        }
        
        return $this;
    }

    // 공통적으로 처리되는 하단 내용을 읽어옵니다.
    // 읽어올 설정파일은 config에 설정되어 있습니다.
    public function footer()
    {
        // echo __METHOD__."를 호출합니다.<br>";
        // 하단 HTML의 파일의 경로를 확인합니다.
        // 지정한 경로에 하단푸터 파일이 있는지 확인후에 값을 읽어옵니다.
        $filename = $GLOBALS['config']['theme']['path']. DS. $GLOBALS['config']['theme']['name']. DS. $GLOBALS['config']['theme']['footer'];
        if (file_exists($filename)) {
            $this->_footer = file_get_contents($filename);
        } else {
            $this->_footer = "푸터 파일이 없습니다.";
        }

        return $this;
    }




}