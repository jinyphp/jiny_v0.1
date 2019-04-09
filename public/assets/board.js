var tbl = document.getElementById('tblMain');
            if (tbl != null) {
                for (var i = 0; i < tbl.rows.length; i++) {
                    for (var j = 0; j < tbl.rows[i].cells.length; j++)
                        tbl.rows[i].cells[j].onclick = function () { getval(this); };
                }
            }
            function getval(cel) {
                alert(cel.innerHTML);
            }

var board_list = document.getElementById('board_list');
if (board_list) {
    board_list.onclick = function () {
        // alert("등록");
        location.href = '/board';
    }
}

var board_new = document.getElementById('board_new');
if (board_new) {
    board_new.onclick = function () {
        // alert("등록");
        location.href = '/board/new';
    }
}

var board_add = document.getElementById('board_add');
if (board_add) {
    board_add.onclick = function () {
        alert("저장합니다.");
        // location.href = '/board/new';
        submit();
    }
}

var board_delete = document.getElementById('board_delete');
if (board_delete) {
    board_delete.onclick = function () {
        document.getElementsByName('_method')[0].value = "DELETE";
        alert("삭제");
        // location.href = '/board/new';
    }
}

var board_edit = document.getElementById('board_edit');
if (board_edit) {
    board_edit.onclick = function () {

        $("#board").attr("action", "/board/edit");
        submit();
    }
}

var board_modify = document.getElementById('board_modify');
if (board_modify) {
    board_modify.onclick = function () {
        document.getElementsByName('_method')[0].value = "PUT";
        alert("수정합니다..");
        // location.href = '/board/new';
        submit();
    }
}