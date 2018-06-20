<?php

/**
* JINY - A PHP Framework
*
* @package  Jiny
* @author   Hojin Lee <infohojin@gmail.com>
*/
define('JINY_START', microtime(true));
require "./public/TimeLog.php";

// 캐쉬방지 처리 해더 전송
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.


// 에러 메세지 출력
if (php_sapi_name() == "cli-server") {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// 상수처리
// 디렉토리 구분자 상수 alias
const DS = DIRECTORY_SEPARATOR;
const PS = PATH_SEPARATOR;

if (DS == "/") {
    define("SYSTEM", "Linux");
} else {
    define("SYSTEM", "Window");
}

// 상대입력값의 절대경로를 저장합니다.
// 3권 236페이지 참조
define("ROOTPATH", realpath("."));

define("ROOT", ".");
// getcwd()
define("ROOT_PUBLIC","/public");



/**
 * 오토로드 설정
 */
require_once ROOT.DS."vendor".DS."autoload.php";

/**
 * Jiny Framwork Application
 * __construction()이 실행이 됩니다.
 */
new \Jiny\Core\Application();

