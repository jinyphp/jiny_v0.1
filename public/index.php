<?php

    /**
    * JINY - A PHP Framework
    *
    * @package  Jiny
    * @author   Hojin Lee <infohojin@gmail.com>
    */
    
    require "TimeLog.php";

    TimeLog::init();    

    // 캐쉬방지 처리 해더 전송
    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
    header('Pragma: no-cache'); // HTTP 1.0.
    header('Expires: 0'); // Proxies.

    // TimeLog::set("Header 전송");

    // 상수처리
    // 디렉토리 구분자 상수 alias
    // P
    const DS = DIRECTORY_SEPARATOR;
    const PS = PATH_SEPARATOR;
    
    define("ROOT", "..");
    define("ROOT_PUBLIC","");
    
    /**
     * 오토로드 설정
     */
    require_once ROOT.DS."vendor".DS."autoload.php";
    //TimeLog::set("autoload");

    /**
     * Jiny Framwork Application
     * __construction()이 실행이 됩니다.
     */
    new \Jiny\Core\Application();
    
    TimeLog::set("END");
    // TimeLog::print();
    TimeLog::monitor();

   