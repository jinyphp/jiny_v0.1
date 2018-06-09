<?php

/**
 * 오토로드 설정
 */
require_once "../vendor/autoload.php";

/**
 * 클래스 인스턴스 pool 초기화
 */
$Registry = \Jiny\Core\Registry\Registry::init([
    "CONFIG"=>\Jiny\Config\Config::class,
    "FrontMatter"=>\Jiny\Frontmatter\FrontMatter::class
]);

// new \Jiny\Config\Yaml();


/**
 * 환경 설정을 읽어옵니다.
 * Registry Config 인스턴스를 이용합니다.
 */
$Registry->get("CONFIG")->autoUpFiles()->parser();
// \Jiny\Core\Registry::get("CONFIG")->setLoad("site.ini");
// \Jiny\Core\Registry::get("CONFIG")->setLoad("conf.php");


/**
 * 테마 클래스를 Registry pool에 등록합니다
 */
$Registry->createInstance("\Jiny\Theme\Theme","Theme");

// 클래스 생성
// Application의 객체를 생성합니다.
// __construction()이 실행이 됩니다.
new \Jiny\Core\Application($Registry);

/**
 * 생성한 객체의 메모리를 해제합니다.
 */
unset($Registry);

/*
echo "<pre>";
print_r(Jiny\Core\Registry::get("CONFIG")->data());
echo "</pre>";
*/

