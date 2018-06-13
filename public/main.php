<?php

define("ROOT", "..");
define("ROOT_PUBLIC","");
/**
 * 오토로드 설정
 */
require_once ROOT.DS."vendor".DS."autoload.php";

/**
 * Jiny Framwork Application
 * __construction()이 실행이 됩니다.
 */
new \Jiny\Core\Application();
