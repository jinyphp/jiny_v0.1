---
layout: default
tree: /jiny
---

## 템플릿 엔진
---

지니 프레임워크는 여러 종류의 템플릿을 지원합니다. 원하시는 템플릿을 선택하여 페이지의 랜더링을 처리할 수 있습니다.

## 기본설정
템플릿의 기본설정값은 `.env.php`설정에서 하게 됩니다.
```
'Tamplate'=> [
    'PreProcess' => true,
    'Engine' => "Liquid"
]
```


## 템플릿 엔진 확인

```
$this->template->isEngine();
```
페이지에서 처리되는 템플릿의 타입을 확인할 수 있습니다.