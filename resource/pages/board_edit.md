---
layout: board
javascript: "/public/assets/board.js"
---

# 글수정

<form action="" method='post' id='board'>

    <input type="hidden" name="_method">
    <input type="hidden" name="_id" value="{{-data.id-}}">

  <div class="form-group">
    <label for="regdate">등록일자:</label>
    <input type="text" name='regdate' class="form-control" id="regdate">
  </div>

  <div class="form-group">
    <label for="title">제목:</label>
    <input type="text" name='title' class="form-control" value='{{-data.title-}}' id="title">
  </div>

  <button type="butten" class="btn btn-primary" id="board_modify">수정</button>
</form>