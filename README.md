# Jiny FreamWork
지니는 PHP언어로 개발된 MVC기반의 미니 프레임웍 입니다.

## 설치
컴포저를 통하여 지니 프로젝트를 설치합니다.
```
composer create-project jiny/jiny
```

기본 프로젝트가 생성시 관련된 페키지들은 제외되어 있습니다. 컴포저를 통하여 관련 페키지를 설치합니다.
```
composer install
```

## 시작방법

PHP 내부서버를 통하여 로컬 실행을 할 수 있습니다. 다음과 같이 콘솔상에서 명령을 입력합니다.
```
php -S localhost:8000 -t ./public
```