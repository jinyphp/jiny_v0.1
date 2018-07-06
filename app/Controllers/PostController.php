<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class PostController extends Controller
{
    public function __construct($app=NULL)
    {
        //controller
        $this->setApp($app);    
    }

    // 기본실행 메서드
    public function index()
    {
        
        // 처리될 페이지 경로
        //echo $this->App->Route->_viewFile."<br>";
        //print_r($this->App->Route->_param);

        // 포스트의 데이터를 읽어옵니다.
        $post = $this->postMatter("/resource/post");

        return $this->view($this->App->_viewFile, $post);     

    }

    public function postView()
    {

    }

    public function postMatter($path)
    {
        $path = rtrim($path,"/");
        $posts = \Jiny\Core\Base\File::dir(ROOT.$path);
        $data = [];
        foreach ($posts as $post) {
            $docs = $this->parsing(ROOT.$path.DS.$post);
            array_push($data, $docs->getData());            
        }
        return $data;
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