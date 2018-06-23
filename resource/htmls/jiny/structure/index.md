---
layout: php
title: 지니프레임웍
subtitle: structure
---

# 폴더구조
이번 포스트에서는 지니 웹프레임워크의 디렉토리 구조에 대해서 알아 보도록 하겠습니다.
디렉토리 구성은 간단합니다.

Root에는 몇개의 설정파일들이 존재합니다.
* .htaccess
* .env.php
* composer.json

## public 폴더
public 폴더는 지니프레임의 시작 시점입니다. 처음 설치후 실행을 하신것에서 알 수 있듯이 `-t ./public` 옵션을 사용한 것을 알 수 있습니다. `-t` 옵션은 PHP에게 서버 시작시 기준이 되는 DOCUMENT ROOT 경로를 알려주는 설정입니다.

`./public` 폴더 안에 있는 `index.php`파일이 처음 시작하게 됩니다.

public 폴더 안에는 또한 assets 과 images 폴더가 있습니다. assets에는 CSS, Javascript와 같은 파일들이 있습니다. images 에는 사이트에 같이 출력될 이미지들을 담고 있습니다.

## resource 폴더
지니는 프레임워크와 테마, 컨덴츠의 내용을 분리하여 관리 될 수 있도록 설계 되었습니다. 향후, 프레임워크의 버젼이 업그레이드가 되어도 영향을 받지 않고 유지가 되기 위함입니다. 또한 테마도 변경되어도 컨덴츠의 내용은 유지하기 위함입니다.

resource 폴더에는 htmls 서브폴더가 있습니다. 이곳에 홈페이지의 내용을 작성해 주시면 됩니다.
이 경로는 `.env.php` 설정 파일을 이용하여 수정할 수도 있습니다.