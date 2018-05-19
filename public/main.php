<?php
//오토로드 설정
//spl_autoload_register('spl_autoload', false);
require_once "../vendor/autoload.php";
    
// 클래스 생성
// Application의 객체를 생성합니다.
// __construction()이 실행이 됩니다.
new \App\Core\Application;