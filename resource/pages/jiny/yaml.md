---
layout: yaml
---
# Yaml 데이터

Yaml의 데이터 구조는 트리 형태로 작성을 할 수 있습니다.

## 들여쓰기
트리 구조 형태로 데이터를 작성할 때는 들여쓰기를 이용하면 됩니다. 이때 주의해야 하는 점은 들여쓰기의 깊이가 같아야 한다는 것입니다. 
```
submenu:
    menu1: 
        name: Yaml 소개
        link: /jiny/yaml
    menu2: 
        name: Yaml 기본구조
        link: /jiny/yaml/basic 
```
들여쓰기를 통한 트리구조는 다차원 배열과 같습니다.

## 노드 구조
Yaml의 데이터는 `key:value`형태로 구성이 됩니다. 왼쪽에는 `key`이름, 오른쪽에는 `value`를 적어 줍니다. 중간에는 콜론`:`을 이용하여 구분을 합니다.

이는 PHP에서 연상배열과 같습니다.

값은 다양한 형태의 데이터 타입이 가능합니다. 문자열, 정수, 실수, 날짜등 정의가 가능합니다.

## 주석
Ymal은 데이터를 직렬화 하는 과정에서 사용자들이 쉽게 데이터를 인지할 수 있도록 주석문을 같이 사용할 수 있습니다. 이런점에서는 json 포맷보다 가독성이 좋습니다.

주석은 `#` 기호를 문서에 넣어주면 그 이후 부터 한줄은 주석으로 처리가 됩니다.

```
# this is valid comment
key: 
  - child: 1   # this is invalid comment
    name: tom
  - child: 2
    name: john
```


## 앵커/얼리어스
Yaml 데이터를 작성하면서 동일한 값을 반복해서 작성을 해야 되는 경우가 있습니다. PHP에서 상수와 변수가 있듯이 변수에 데이터를 저장하여 다른 곳에서 값을 재사용 하는 것과 비슷합니다.

```
anchors:
    first-anchor: &first <-- 앵커 선언.
        Name: tom
        Birth: 1977.4.21
    second-anchor: &second <-- 앵커 선언.
        Name: john
        Birth: 1979.7.15

first-child  : *first <-- 앵커 알리아스.
second-child : *second <-- 앵커 알리아스.
```



