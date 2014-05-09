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
    $("#WxDataTwFPreTwj").hide();
    var type = $(".twSelect").val();
    var tempdata = $("#WxDataKdsFPreTwj").val().split(',');
    var com = '', s = '';
    $.each(tempdata, function(index, value) {
        s += com + '"'+value+'"';
        com = ',';
    });
    var pdata = 'ids=['+s+']';
    type == 0 ? $("#addTw").hide() : $("#addTw").show();
    type == 1 ? $("textarea").hide() : $("#twj").show();
    $.ajax({
        url: ADMIN_WC_URL + "mPic?_a=getTwj",
        async: false,
        data: pdata,
        type: 'POST',
        success: function(data, status) {
            $(".u-chooses").html(JSON.parse(data));
            $("#aj_box").html("");
            $("#addTw , .Kreplaybox .maroon").hide();
            $(".Kreplaybox .icon_item_selected").text("修改");
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
});
//=============关键字等选择图文或者多图文JS
$(".twSelect").on("change", function(){
    var type = $(this).val();
    if(type == 0) {
        $(".Kreplaybox textarea, .Kreplaybox .help-inline").show();
        $(".Kreplaybox").children().not("textarea").hide();
        $(".u-chooses").empty();
        $(".Kreplaybox .help-inline, .Kreplaybox .maroon").show();
    } else {
		$.ajax({
			url: ADMIN_WC_URL + "mPic?_a=twj&_m=simple",
			async: false,
			success: function(data, status){
				$("#aj_box").html(JSON.parse(data));
				bootbox.dialog({
					message: $("#ajcont").html(),
					title: "添加图文",
					buttons: {
						success: {
							label: "确定",
							className: "btn-primary",
                			callback: function() {
								$(".selected .com_mask, .selected .icon_item_selected").hide();
			                    var selehtm = '';console.log(Atempids);
			                    $.each(Atempids, function(key,val) {
									var t_id = $('#'+val).attr('id');
									$('#'+val).append("<input type=\"hidden\" name=\"data[WxDataKds][FTwj][]\" value=\"" + t_id +"\" />");
									selehtm += $('#'+val).outerHTML() + "&nbsp;";
								});
			                   	$(".u-chooses").empty();
			                   	$(".u-chooses").prepend(selehtm);
		                        $(".u-chooses").parent().show();
		                        $(".Kreplaybox textarea, .Kreplaybox .maroon").hide();
                  			}
						},
					}
				});
			},
			error: function(){
				bootbox.alert("系统出错。");
			}
		});	
    }
});

$(".u-chooses").on("click", function() {
    $.ajax({
        url: ADMIN_WC_URL + "mPic?_a=twj&_m=simple",
        async: false,
        type: 'POST',
        success: function(data, status){
            $("#aj_box").html(JSON.parse(data));
            bootbox.dialog({
                message: $("#ajcont").html(),
                title: "添加图文",
                buttons: {
                    success: {
                        label: "确定",
                        className: "btn-primary",
                        callback: function() {
                            $(".selected .com_mask, .selected .icon_item_selected").hide();
                            //console.log(Atempids);
                            var selehtm = '';
                            $.each(Atempids, function(key,val) {
                                var t_id = $('#'+val).attr('id');
                                $('#'+val).append("<input type=\"hidden\" name=\"data[WxDataKds][FTwj][]\" value=\"" + t_id +"\" />");
                                selehtm += $('#'+val).outerHTML() + "&nbsp;";
                            });
                            $(".u-chooses").empty();
                            $(".u-chooses").prepend(selehtm);
                            $("#addTw").parent().show();
                            $(".Kreplaybox textarea").hide();
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
