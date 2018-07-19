---
layout: post
---
# 포스트 입니다.
<h1>Products</h1>
<table class="table table-striped">
    <thead>
        <tr>
        <th>작성일자</th>
        <th>제목</th>
        <th>작성자</th>
        </tr>
    </thead>
    <tbody>
    {% if posts %}
        {% for data in posts %}
            <tr>
                <td>{{data.date}}</td>
                <td><a href="/post{{data.filename}}">{{data.title}}</a></td>
                <td>{{data.writer}}</td>
            </tr>                
        {% endfor %}
    {% endif %}
    </tbody>
</table>