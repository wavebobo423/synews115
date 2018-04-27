;$(function(){
    $("#all").click(function(){
        $(".ids").prop("checked", this.checked);
    });
    $(".ids").click(function(){
        var option = $(".ids");
        option.each(function(i){
            if (!this.checked) {
                $("#all").prop("checked", false);
                return false;
            } else {
                $("#all").prop("checked", true);
            }
        });
    });
});

$(function() {
    $('#side-menu').metisMenu();
});

function highlight_nav(url) {
    var nav = $('#sidebar').find('a[href="'+url+'"]');
    nav.closest('li').parent().parent().addClass('active');
    nav.addClass('active');
}
$('.ajax-status').click(function(){
    var that = this;
    var id = $(this).parent().siblings('.id').text();
    var status = $(this).attr('status');
    if ($(this).hasClass('confirm')) {
        if (!confirm('Are you sure you want to do this?')) {
            return false;
        }
    }
    $.ajax({
        url: "{:U('updateStatus')}",
        type: 'post',
        data: {
            'id': id,
            'status': status
        },
        success: function(data) {
            $(that).attr('disabled', 'disabled')
        }
    });
});