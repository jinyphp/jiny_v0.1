# Request 테스트
리퀘스트 설정값을 확인합니다.

## req.uri 배열
배열값을 하나씩 출력합니다.

첫번째
{{- req.uri[0] -}}

두번째
{{- req.uri[1] -}}

## req.string
uri에 대한 문자열값을 출력합니다.

{{- req.string -}}

## 언어
{{- req.language -}}

## 국가
{{- req.country -}}
