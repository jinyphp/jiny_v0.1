<?php
namespace App\Core;

class Controller
{
    protected $_view;
    protected $_model;

    public function view($viewName, $data=[])
    {
        //echo "View 객체를 생성합니다.<br>";
        $this->_view = new \App\Core\View($viewName, $data);
        return $this->_view;
    }

    public function model($modelName, $data=[])
    {
        if (file_exists(MODELS. $modelName. '.php')) {
            // require MODEL. $modelName. '.php';
            // 오토로드를 통하여 파일 자동로드
            $this->_model = new $modelName;
        }
    }

}