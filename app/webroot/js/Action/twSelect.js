(function($) {
    if (!$.outerHTML) {
        $.extend({
            outerHTML: function(ele) {
                var $return = undefined;
                if (ele.length === 1) {
                    $return = ele[0].outerHTML;
                }
                else if (ele.length > 1) {
                    $return = {};
                    ele.each(function(i) {
                        $return[i] = $(this)[0].outerHTML;
                    })
                };
                return $return;
            }
        });
        $.fn.extend({
            outerHTML: function() {
                return $.outerHTML($(this));
            }
        });
    }
})(jQuery);

$(document).ready(function() {
    $("#FPreTwj").hide();
    var type = $(".twSelect").val();
    var tempdata = $("#FPreTwj").val().split(',');
    var com = '', s = '';
    $.each(tempdata, function(index, value) {
        s += com + '"'+value+'"';
        com = ',';
    });
    var pdata = 'ids=['+s+']';
    //type == 0 ? $("#addTw").hide() : $("#addTw").show();
    //type == 1 ? $("textarea").hide() : $("#twj").show();
    if(type == 1) {
        $(".u-chooses").parent().show();
        $("textarea").parent().hide();
        $("#addTw").show();
        $.ajax({
            url: ADMIN_WC_URL + "mPic?_a=getTwj",
            async: false,
            data: pdata,
            type: 'POST',
            success: function(data, status) {
                $(".u-chooses").html(JSON.parse(data));
                $(".u-chooses").find(".com_mask, .icon_item_selected").remove();
                $("#aj_box").html("");
            },
            error: function(){
                bootbox.alert("系统出错。");
            }
        });
    } else {
        $("textarea").parent().show();
        $(".u-chooses").parent().hide();
    }
});

//=============关键字等选择图文或者多图文JS
$(".twSelect").on("change", function(){
    var type = $(this).val();
    if(type == 0) {
        $("textarea").parent().show();
        $(".u-chooses").parent().hide();
    } else {
        $(".u-chooses").parent().show();
        $("#addTw").show();
        $("textarea").parent().hide();
        var tempdata = $("#FPreTwj").val().split(',');
        var com = '', s = '';
        $.each(tempdata, function(index, value) {
            s += com + '"'+value+'"';
            com = ',';
        });
        var pdata = 'ids=['+s+']';
        $.ajax({
            url: ADMIN_WC_URL + "mPic?_a=getTwj",
            async: false,
            data: pdata,
            type: 'POST',
            success: function(data, status) {
                $(".u-chooses").html(JSON.parse(data));
                $(".u-chooses").find(".com_mask, .icon_item_selected").remove();
                $("#aj_box").html("");
            },
            error: function(){
                bootbox.alert("系统出错。");
            }
        });
        if($(".u-chooses").children().length == 0){
            $("#addTw").text("添加图文");
        }
    }
});

$("#addTw").on("click", function() {
    $.ajax({
        url: ADMIN_WC_URL + "mPic?_a=twj&_m=simple",
        async: false,
        type: 'POST',
        success: function(data, status){
            $("#aj_box").html(JSON.parse(data));
            bootbox.dialog({
                message: $("#ajcont").html(),
                title: "选择图文",
                buttons: {
                    success: {
                        label: "确定",
                        className: "btn-primary",
                        callback: function() {
                            //console.log(Atempids);
                            var selehtm = '',tmpid;
                            $.each(Atempids, function(key,val) {
                                var t_id = $('#'+val).attr('id');
                                tmpid = t_id;
                                var t_form = $("#t_form").val();
                                t_form = t_form ? t_form : 'WxDataKds';
                                $('#'+val).append("<input type=\"hidden\" name=\"data[" + t_form + "][FTwj][]\" value=\"" + t_id +"\" />");
                                selehtm += $('#'+val).outerHTML() + "&nbsp;";
                            });
                            $(".u-chooses").empty();
                            $(".u-chooses").prepend(selehtm);
                            $(".u-chooses").find(".com_mask, .icon_item_selected").remove();
                            $("#addTw").text("更换图文");
                            $("#FPreTwj").attr("value", tmpid);
                        }
                    },
                }
            });
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
});
