$(document).ready(function () {
    setTimeout(() => {
        $('#spinner').fadeOut();
    }, 1000);
    $('input').attr('autocomplete','off');
});
var uri = $('#uri').attr('href');
function postData(type,table,payload,reload){
    $('#spinner').show();
    var data={
        type:type,
        table:table,
        payload:payload
    };
    $.ajax({
        type: "post",
        url:'models/ajax.php',
        data: {'data':data},
        success: function (response) {
            if (reload){
                location.reload();
            }
            setTimeout(() => {
                $('#spinner').fadeOut();
            }, 1000);
        },
        error: function (e){
            console.log(e);
        }
    });
}
