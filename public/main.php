<?php
//오토로드 설정
//spl_autoload_register('spl_autoload', false);
require_once "../vendor/autoload.php";

// 네임스페이스 별칭선언
use \Jiny\Core\Config;
use \Jiny\Core\Debug;
use \Jiny\Core\Registry;

//Debug::on();

// 환경설정 인스턴스를 생성등록 합니다.
$conf =Registry::create("\Jiny\Core\Config","Config");
$conf->setLoad("site.ini");
$conf->setLoad("conf.php");
$conf->Load();
// Debug::print_r(Registry::name("Config")());

// 클래스 생성
// Application의 객체를 생성합니다.
// __construction()이 실행이 됩니다.
new \Jiny\Core\Application;