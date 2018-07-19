---
layout: jiny
title: 지니프레임웍
subtitle: installation
---
# 설치

지니는 PHP로 개발된 웹프레임 워크 입니다. 힘든 설치와 설정과정을 하지 않아도 간단하게 자신만의 웹사이트를 구축할 수 있습니다.

패키지는 3가지의 종류로 나누어 제공됩니다.

* Basic 버젼
* Prㅐ 버젼 (향후)
* Enter 버젼 (향후)

## 컴포저 방식
지니를 설치하기 위해서는 PHP 패키지 관리 소프트웨어인 컴포저를 필요로 합니다. 컴포저 프로그램은 getcomposer.org 사이트에서 무료로 다운로드 받을 수 있습니다. 컴포저 설치방법은 관련 포스팅을 참고해 주시길 바랍니다.

설치하고자 하는 디렉토리로 이동후에 아래와 같이 입력을 합니다.  

```
composer require jinyphp/jiny
```
컴포저는 깃에 등록된 지니 프레임웍의 패키지를 자동으로 다운로드 받아 자신의 컴퓨터에 설치해 줍니다. 지니 프래임워크의 모든 소스는 공개되어 있습니다. 필요한 기능을 추가하여 사용이 가능하며, 변경된 소스코드를 저희쪽에 기여해 주실 수도 있습니다.

## 실행방법
자체 설치된 PHP에서 로컬 내장 CLI를 통하여 지니 웹프래임워크를 실행해 보실 수 있습ㄴ디ㅏ.

```
php -S localhost:8000 -t ./public
```

실행하게 되면 다음과 같은 메시지가 출력됩니다.
```
PHP 7.1.15 Development Server started at Thu Jun 14 13:59:53 2018
Listening on http://localhost:8000
Document root is D:\htdocs\jinyphp\public
Press Ctrl-C to quit.
```

실행을 중단할려면 `Ctrl + C`를 입력하면 됩니다.



