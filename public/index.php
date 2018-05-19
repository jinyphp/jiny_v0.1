<?php

    // 캐쉬방지 처리 해더 전송
    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
    header('Pragma: no-cache'); // HTTP 1.0.
    header('Expires: 0'); // Proxies.

    // 상수처리
    // 디렉토리 구분자 상수 alias
    const DS = DIRECTORY_SEPARATOR;
    const PS = PATH_SEPARATOR;

    define('ROOT', dirname(__DIR__). DS);
    define('APP', ROOT. 'app'. DS);
    define('VIEWS', ROOT. 'app'. DS. 'views'. DS);
    define('MODELS', ROOT. 'app'. DS. 'model'. DS);
    define('DATA', ROOT. 'app'. DS. 'data'. DS);
    define('CORE', ROOT. 'app'. DS. 'core'. DS);
    define('CONTROLLERS', ROOT. 'app'. DS. 'Controllers'. DS);

    define('HTMLS', ROOT. 'resource'. DS. 'htmls'. DS);

    $modules = [ROOT, APP, CORE, CONTROLLERS, DATA];
    set_include_path(get_include_path(). PS. implode(PS, $modules));
   

    // 환경설정을 파일을 읽어옵니다.
    $config = include "..".DS."app".DS."conf".DS."config.php";
    
    // 메인루틴으로 전달합니다.
    require_once "main.php";