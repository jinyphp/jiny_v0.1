## 부트스트랩 collapse

collapse 기능은 어떠한 객체를 보이거나 숨김을 처리 합니다.

collapse를 사용하기 위해서는 먼저 `panel-group` 클래스를 사용합니다.

```html
<div id="accordion" class="panel-group">
    <div class="pannel pannel-primary">

        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#panelBody1" data-toggle="collapse" data-parent="#accordion">Asia</a>
            </h4>
        </div>

        <div id="panelBody1" class="panel-collapse collapse">
            <div class="panel-body">                <ul>
                    <li>Korea</li>
                    <li>China</li>
                    <li>Japan</li>
                </ul>
            </div>
        </div>

    </div>
</div>
```




https://www.youtube.com/watch?v=LxUACFT8QEY&index=38&list=PL6n9fhu94yhXd4xnk-j5FGhHjUv1LsF0V