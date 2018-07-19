<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class PostController extends Controller
{
    public function __construct($app=NULL)
    {
        //echo "<br> 포스트 컨트럴러를 생성합니다.".__CLASS__."<br>";
        //controller
        $this->setApp($app);    
    }

    // 기본실행 메서드
    public function index()
    {        
        // 라우터에서 설정한 파일이 있을 경우
        if ($this->App->Route->_viewFile) {
            $viewFile = $this->App->Route->_viewFile;
        } else {
            // 처리될 페이지 경로
            $viewFile = $this->getPath();
        }

        $viewData['menus'] = menu();
        $viewData['posts'] = $this->postMatter("/resource/pages/post");

        //echo "뷰파일 = ".$viewFile."<br><br>";
        return view($viewFile, $viewData);     
      
    }

    public function View($param)
    {
        //echo "<br>포스트 보기<br>";

        $viewname = "/post".DS.$param['year']."-".$param['month']."-".$param['day']."_".$param['name'];
        //echo $viewname;

        return view("/post".DS.$param['year']."-".$param['month']."-".$param['day']."_".$param['name']);

    }

    public function postMatter($path)
    {
        $path = rtrim($path,"/");

        $path = ROOT.str_replace("/",DS,$path);
        
 
        $this->listFiles($path);
        return $this->_fileData;

    }

    public $_fileData = [];
    public function listFiles($path)
    {
        static $base = [];
        $_files = [];

        if (is_dir($path)) {
            $dir = scandir($path);
            foreach ($dir as $name) {

                // 디렉토리 제어 폴더는 . .. 은 제외합니다.
                if($name == ".") continue;
                if($name == "..") continue;

                if(is_dir($path.DS.$name)) {
                    array_push($base, $name);
                    $this->listFiles($path.DS.$name);
                } else {
               
                    $subapth = \Jiny\Core\Base\BaseArray::path($base);                   
                    
                    if(file_exists($path.DS.$name)){                       
                        $docs = $this->parsing($path.DS.$name);
                        // 머리말 데이터가 있는 POST만
                        if($docs = $docs->getData()){
                            $filename = $subapth.DS.pathinfo($name)['filename']; 
                            $docs['path'] = $base;
                            $docs['filename'] = $filename;                
                            array_push( $this->_fileData, $docs);
                        } 
                    }
                   

                }                
            }
            array_pop($base);
        }

    }

    

    public function parsing($filename)
    {
        $doc = $this->readPosting($filename);
        return Registry::get("FrontMatter")->parse($doc);
    }

    public function readPosting($filename)
    {
        return file_get_contents($filename);
    }

}