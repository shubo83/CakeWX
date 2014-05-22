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
KindEditor.ready(function(K) {
    var editor = K.editor({
        uploadJson: UPLOAD_URL,
        allowFileManager : false
    });
    K('#WX_icon').click(function() {
        var iconText = $('#WX_icon').parent().find('input');
        editor.loadPlugin('image', function() {
            editor.plugin.imageDialog({
                showRemote : false,
                imageUrl : iconText.val(),
                clickFn : function(url, title, width, height, border, align) {
                    iconText.val(url);
                    editor.hideDialog();
                }
            });
        });
    });

	K.create('#WxDataTwFContent', {
		width: '700px',
		height: '300px',
		items: [
		        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
		        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
		        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
		        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
		        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
		        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
		        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
		        'anchor', 'link', 'unlink', '|', 'about'
		],
		allowImageUpload: true,
		uploadJson: UPLOAD_URL + '?prefix',
		allowFileManager : false,
		afterUpload: function(url) {
			url = BASE_URL + url;
		}
	});
});

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
});

// 图文预览
$("#previewbox").on("click",function() {
    var prehtml,tempurl,tempsum,temph;
    var type = $(".twSelect").val();
    prehtml = $('<div id="prebox" class="multbox appmsg" />');
    tempurl = $('#WxDataTwFUrl').val();
    tempsum = $('#WxDataTwFMemo').val();
    temph = $('<h4 class="appmsg_title" />').text($("#WxDataTwFTitle").val());
    tempurl ? tempimg = $('<img class="appmsg_thumb" />').attr('src', BASE_URL + tempurl) : tempimg = '';
    if(type == 0){
        prehtml.append($('<div class="appmsg_content" />').append(temph, $('<div class="appmsg_thumb_wrp" />').append(tempimg), $('<p class="appmsg_desc" />').append(tempsum)));
    } else{
        prehtml.append($('<div class="cover_appmsg_item" />').append(temph, $('<div class="appmsg_thumb_wrp" />').append(tempimg)));
        $(".u-chooses .media_preview_area").each(function(){
            var tempdiv = $('<div class="appmsg_item" />');
            tempdiv.append($('img', this).outerHTML(), $('.appmsg_title', this).outerHTML());
            prehtml.append(tempdiv.outerHTML());
        });
    }
    bootbox.dialog({
        message: prehtml.outerHTML(),
        title: "图文预览",
        buttons: {
            success: {
                label: "确定",
                className: "btn-primary",
            },
        }
    });
});
function prebootbox(event) {
    var hids = $(".media_preview_area").length;
    var data = [];
    var tmpurl = '',swnode = $(this).parent().parent().parent();
    if(hids){
        $(".media_preview_area").each(function(index) {
            data[index] = $(this).attr("id");
        });
        data = $.unique(data);
    }
    tmpurl = event.data.atype == "switem" ? ADMIN_WC_URL + "mPic?_a=twj" : ADMIN_WC_URL + "mPic?_a=twj&_m=simple";
    tmptype = event.data.atype;
    //console.log(data.length);
    $.ajax({
        url: tmpurl,
        async: false,
        data : data,
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
                            //$(".u-chooses").empty();
                            if(tmptype == "switem"){
                                $("#addTw").prev().append(selehtm);
                                $(".icon_item_selected").html("<span class='delitem'>删除</span><span class='pipe'>|</span><span class='editem'>修改</span>");
                            } else {
                                $(".icon_item_selected").html("<span class='delitem'>删除</span><span class='pipe'>|</span><span class='editem'>修改</span>");
                                //console.log(selehtm);
                                swnode.replaceWith(selehtm);
                            }
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
// 更换图文集
$(document).on("click","#addTw",{atype:"switem"}, prebootbox);
$(".u-chooses").on("click",".editem",{atype:"editem"}, prebootbox);
$(".u-chooses").on("click",".delitem", function() {
    var delbox = $(this).parent().parent().parent();
    bootbox.confirm("确定要删除么？", function(result) {
        result ? delbox.remove() : '';
    });
});
// 多图文判断JS
$(".twSelect").on("change", function(){
    var type = $(this).val();
    $("#WxDataTwFPreTwj").hide();
    if(type == 0){
        $("#twj").hide();
        $(".u-chooses").empty();
    } else{
        $("#twj").show();
    }
});
