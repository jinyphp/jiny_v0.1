<?php

// echo $_SERVER['SERVER_NAME']."<br>";
// echo $_SERVER['SERVER_PORT']."<br>";

/**
 * 사용자 정의 환경설정
 * 도메인, 포트 값을 통하여 환경설정값을 다르게 설정할 수 있습니다.
 */
if ($_SERVER['SERVER_PORT'] == 8000) {
    $Config->setFile("site.ini","site");
} else {
    $Config->setFile("site2.ini", "site");
}

/**
 * 사용자 설정파일을 정의할 수 있습니다.
 */
$Config->setFile("test.yml", "test");

