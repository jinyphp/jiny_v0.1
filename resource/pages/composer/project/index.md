# 컴포저 프로젝트
컴포저는 라이브러리를 패키지화여 의존성을 관리 합니다. 패키지를 /vendor 폴더에 설치하는것 대신에 프로젝트 형태로 배포를 할 수 있습니다.

프로젝트를 배포하는 방법은
```
composer create-project jiny/jiny 폴더명

``` 
위의 명령을 입력하면 패티지를 프로젝트 형태로 설치를 합니다. 설치파일과 해당 프로젝트의 관련 패키지들을 동시에 설치를 할 수 있습니다.

```
$ composer create-project jiny/jiny 0.1.5
Installing jiny/jiny (0.1.4)
  - Installing jiny/jiny (0.1.4): Loading from cache
Created project in 0.1.5
Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 17 installs, 0 updates, 0 removals
  - Installing erusev/parsedown (1.7.1): Loading from cache
  - Installing jiny/config (0.0.4): Loading from cache
  - Installing jiny/core (0.0.5): Loading from cache
  - Installing symfony/polyfill-ctype (v1.8.0): Loading from cache
  - Installing symfony/yaml (v4.1.0): Loading from cache
  - Installing webuni/front-matter (1.1.0): Loading from cache
  - Installing jiny/frontmatter (0.0.3): Loading from cache
  - Installing jiny/lamp (0.0.1): Loading from cache
  - Installing jiny/locale (0.0.2): Loading from cache
  - Installing jiny/menu (0.0.2): Loading from cache
  - Installing jiny/pages (0.0.3): Loading from cache
  - Installing jiny/template (0.0.3): Loading from cache
  - Installing jiny/theme (0.0.3): Loading from cache
  - Installing liquid/liquid (1.4.8): Loading from cache
  - Installing nadirhamid/docx-to-html (v0.0.1): Loading from cache
  - Installing sunra/php-simple-html-dom-parser (v1.5.2): Loading from cache
  - Installing symfony/filesystem (v4.1.0): Loading from cache
symfony/yaml suggests installing symfony/console (For validating YAML files using the lint command)
webuni/front-matter suggests installing nette/neon (If you want to use NEON as front matter)
webuni/front-matter suggests installing yosymfony/toml (If you want to use TOML as front matter)
Generating autoload files
```

## 프로젝트 페키지
프로젝트 형태로 패키지를 배포하기 위해서는 `composer.json` 설정 파일에 페키지 타입을 프로젝트 형태로 선언을 해주어야 합니다.

```
"type": "project"
```