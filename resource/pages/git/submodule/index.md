---
layout: git
---
# 서브모듈 submodule

서브모듈은 깃 저장소 안에 또 하나의 서브 저장소를 만들어 사용하는 것을 말합니다.
저장소가 부모의 저장소와 자식의 저장소 2개로 나누어서 운영이 가능합니다.

## 실습하기

먼저 저장소 AAA를 하나 만듭니다.
```
$ cd AAA
$ git init 
```

## 서브모듈 추가
이미 만들어진 깃저장소에 서브모듈로 자식 저장소를 하나 만들어 봅니다.
서브모듈을 만들쌔 사용하는 명령어는 `submodule`입니다.

```
git submodule add 저장소주소 폴더명
```
위와 같이 명령을 입력하면 지정한 `폴더명`으로 자식 저장소가 하나 추가된 것을 확인할 수 있습니다.

서브모듈을 설치하고 상태를 확인해 보도록 합니다.
```
$ git status
On branch master
Your branch is up to date with 'origin/master'.

Changes to be committed:
  (use "git reset HEAD <file>..." to unstage)

        new file:   .gitmodules
        new file:   aaa
```

위와 같이 서브모듈이 설치된 `디렉토리`와 `.gitmodules`라는 파일이 생성된 것을 확인할 수 있습니다. `.gitmodules`에는 서브모듈들에 대한 정보들을 담고 있습니다.

```
$ cat .gitmodules
[submodule "aaa"]
        path = aaa
        url = https://github.com/infohojin/hojin.git

```
파일의 내용을 확인해 보면 위와 같습니다.

## 모듈추가 커밋
저장소에 서브모듈을 설치후에는 설치되었다는 것을 부모의 깃저장소가 알 수 있도록 커밋작업을 해주어야 합니다.

```
$ git commit -am "add submodule"
[master 4d90a00] add submodule
 2 files changed, 4 insertions(+)
 create mode 100644 .gitmodules
 create mode 160000 aaa

```

# 부모 저장소에 자식 저장소 추가하여 작업하기

자식 저장소에 새로운 파일을 생성해 봅시다. 그리고 부모의 저장소에서 상태를 확인합니다.
```
$ git status
On branch master
Your branch is ahead of 'origin/master' by 1 commit.
  (use "git push" to publish your local commits)

Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

        modified:   aaa (new commits)

no changes added to commit (use "git add" and/or "git commit -a")


```
와 같이 자식 저장소가 변경이 되었다고 상태가 출력이 됩니다.

```
$ git diff
diff --git a/aaa b/aaa
index 966b0a4..2657758 160000
--- a/aaa
+++ b/aaa
@@ -1 +1 @@
-Subproject commit 966b0a400f3b030b2882ebd5af300280a139c094
+Subproject commit 2657758d73e90fe3b410a2735189751e0445a678

```
부모에서는 서브모듈의 저장소를 추적하기 때문에 위와 같이 `git diff`명령을 통하여 확인할 수 있습니다.

원격 저장소의 push는 각각 합니다.
자식의 원격 저장소로 push는 자식 저장소로 이동후에 push를 하면 됩니다.

부모 저장소도 push를 하면 됩니다.

## 저장소 머지

이번에는 자식 저장소에서 작업한 내용을 부모의 저장소에 적용해 보는 실습을 해보도록 합니다.

자식 서브모듈 저장소로 이동합니다. 이동후에 pull을 통하여 리모트에서 자료를 내려 받습니다.

```
cd child
git pull origin master
```

자식 저장소를 업데이트하였습니다. 자식 저장소가 업데이트로 변경이 되면, 자식저장소가 변경이 되었다는 부모의 깃에게 알려 줍니다.

즉 부모는 자식 서브모듈의 변경내용을 모니터링 하고 있는 것입니다.

변경된 사항을 커밋하고 저장합니다.
```
$ git commit -am "update submodule"
```

## 부모/자식 저장소 클론하기

만일 내가 가지고 있는 저장소가 부모/자식 관계의 서브모듈이 설정된 저장소를 클론할려고 합니다.

서브모듈이 있는 저장소를 클론하게 되면, 서브모듈이 설치되어 있는 저장소의 데이터까지 한번에 가지고 올 수는 없습니다.

서브모듈의 저장소는 존재하지만, 서브모듈의 내용을 가지고 오기 위해서는 초기화와 업데이트 작업을 해주어야 합니다.

```]
git submodule init
git submodule update
```

서브 모듈을 업데이트 할때 부모 저장소에는 부모 저장소에서 비어있는 서브모듈의 커밋 위치를 자식 저장소의 리모드에서 체크아웃 하여 가지고 오는 역활을 수행합니다.


# 서브모듈 업데이트
누군가 서브모듈의 내용을 변경하였습니다. 그리고 변경된 내용을 반형한 부모 저장소도 push를 하였다고 생각해 봅니다.

이런경우 우리는 먼저 부모의 저장소를 pull 하여 갱신을 합니다.
그리고 서브모듈을 같이 업데이트 해야 합니다. 서브모듈 내용까지 자동으로 업데이트 되지는 않습니다.

```
git pull origin master
git submodule update
```

