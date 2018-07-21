# Jiny FreamWork
지니는 PHP언어로 개발된 MVC기반의 미니 프레임웍 입니다.

## 요구사항
지니PHP 를 설치하기 위해서는 PHP 7.0 이상의 버전을 컴퓨터에 설치하셔야 합니다. 공식 PHP.net 사이트 또는 비트나미 WAPM, MAPM 을 다운로드 받아 설치하는 것이 보다 수월합니다.

또한 PHP 패키지 관리 소프트웨어인 컴포저가 설치가 되어 있어야 합니다.
https://getcomposer.org/ 으로 접속하여 윈도우/맥용을 설치하시길 바랍니다. 

## 설치

다양한 방식으로 설치를 하실 수 있습니다.
컴포저가 설치되어 있는 경우, 전용 인스톨러를 설치할 수 있습니다.

```php
composer global require jiny/installer
```

전용 설치 프로그렘을 글로벌로 설정이 되었다면, 전용 명령어를 통하여 쉽게 새로운 프로젝트를 생성할 수 있습니다.

```php
jiny new 프로젝트명
```

### 컴포저 프로젝트 

컴포저를 통하여 지니 프로젝트를 설치합니다.
```
composer create-project jiny/jiny
```

기본 프로젝트가 생성시 관련된 페키지들은 제외되어 있습니다. 컴포저를 통하여 관련 페키지를 설치합니다.
```
composer install
```

### 깃허브 클론

```php
git clone -b 버젼 https://github.com/jinyphp/jiny.git 설치폴더

```

## 시작방법

PHP 내부서버를 통하여 로컬 실행을 할 수 있습니다. 다음과 같이 콘솔상에서 명령을 입력합니다.
```
php -S localhost:8000 -t ./public
```