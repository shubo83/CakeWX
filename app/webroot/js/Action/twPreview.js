$(document).ready(function() {
    $("#WxDataTwFPreTwj").hide();
    var type = $(".twSelect").val();
    var tempdata = $("#WxDataTwFPreTwj").val().split(',');
    var com = '', s = '';
    $.each(tempdata, function(index, value) {
        s += com + '"'+value+'"';
        com = ',';
    });
    var pdata = 'ids=['+s+']';
    type == 0 ? $("#twj").hide() : $("#twj").show();
    $.ajax({
        url: ADMIN_WC_URL + "mPic?_a=getTwj",
        async: false,
        data: pdata,
        type: 'POST',
        success: function(data, status) {
			var selehtm = '';
			$("#aj_box").html(JSON.parse(data));
			$("#aj_box").find(".media_preview_area").each(function() {
				var t_id = $(this).attr('id');
                $(this).append("<input type=\"hidden\" name=\"data[WxDataTw][FTwj][]\" value=\"" + t_id +"\" />");
            	selehtm += $(this).outerHTML() + "&nbsp;";
			});
            $(".u-chooses").html(selehtm);
			$("#aj_box").html("");
            // bootbox.alert($("#ajcont").html());
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });

    $(".u-chooses .media_preview_area").click(function(){
        var delbox = $(this);
        bootbox.confirm("确定要删除么？", function(result) {
            result ? delbox.remove() : '';
        });
    });
});

// 图文预览
$(".twPreview").on("click",function(){
		var pdata = {id: $(this).attr('id')};
		$.ajax({
            url: ADMIN_WC_URL + "mPic?_a=preview",
            async: false,
            data: pdata,
            success: function(data, status){
                $("#aj_box").html(JSON.parse(data));
                $("#aj_box").find(".com_mask, .icon_item_selected").remove();
                bootbox.dialog({
                    message: $("#ajcont").html(),
                    title: "图文预览",
                    buttons: {
                        success: {
                            label: "确定",
                            className: "btn-primary"
                        }
                    }
                });
                // bootbox.alert($("#ajcont").html());
            },
            error: function(){
                bootbox.alert("系统出错。");
            }
        });
});

// 添加图文集
$("#addTw").on("click", function(){
	$.ajax({
			url: ADMIN_WC_URL + "mPic?_a=twj",
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
                            //console.log(Atempids);
                            var selehtm = '';
                            $.each(Atempids, function(key,val){
                                var t_id = $('#'+val).attr('id');
                                $('#'+val).append("<input type=\"hidden\" name=\"data[WxDataTw][FTwj][]\" value=\"" + t_id +"\" />");
                            	selehtm += $('#'+val).outerHTML() + "&nbsp;";
                            });
                            $(".u-chooses").empty();
                            $("#addTw").prev().append(selehtm);
                            $(".icon_item_selected").text("删除");
                            $(".u-chooses .media_preview_area").click(function(){
                                var delbox = $(this);
                                bootbox.confirm("确定要删除么？", function(result) {
                                    result ? delbox.remove() : '';
                                });
                            });
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

// 多图文判断JS
$(".twSelect").on("change", function(){
	var type = $(this).val();
	$("#WxDataTwFPreTwj").hide();
	type == 0 ? $("#twj").hide() : $("#twj").show();
});



