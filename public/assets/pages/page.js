// 클릭시 수정모드로 변경됨
$('#mainbody').on("click",function(){
    $(this).css({'background-color':'#ffff99'});
    $(this).attr('contenteditable','true');
});


// content 부분을 마우스위가 벗어날때
// ajax를 통하여 페이지를 수정합니다.
/*
$('#content').on('mouseleave',function(event){

    // 수정모드 일경우
    var editable = $('#content').attr('contenteditable');
    if(editable == 'true'){

        event.stopPropagation();  // 이벤트버블링 방지

        maskShow();
        $('#ajax_progress').show();
        popup_center('#ajax_progress',400,100);

        // 수정한 페이지를 저장
        var pages = $('#content').html();
        $('#content').val(pages);

        var url = \"/pages/ajax_pagesUpdate.php\";
        $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                beforeSend:function(){

                },
                success:function(data){
                    maskHide();
                    alert(\"save\");
                }
        });

        // alert(\"mouse leave\");

        $('#content').css({'background-color':''});
        $('#content').attr('contenteditable','false');

    }

});
*/