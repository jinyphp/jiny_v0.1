<?php

echo "라우트 파일을 읽어옵니다.<br>";

$route['aaa']['bbb']['ccc'][':num'][':any']="home/index/$1/$2";
$route['aaa']['bbb']['ccc'][':num']="home/index/$1/$3";