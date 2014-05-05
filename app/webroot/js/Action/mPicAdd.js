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
	
	K.create('#WxDataTwFMemo', {
		width: '700px',
		height: '300px',
		items: [
		        'emoticons'
		]
	});
});

// 图文预览
$(document).ready(function() {
    $("#previewbox").on("click",function() {
        var proceitem, prehtml;
        prehtml = $('<div id="prebox" class="multbox appmsg" />');
        tempurl = $('#WxDataTwFUrl').val();
        temph = $('<h4 class="appmsg_title" />').text($("#WxDataTwFTitle").val());
        tempurl ? tempimg = $('<img class="appmsg_thumb" />').attr('src', BASE_URL + tempurl) : tempimg = '';
        prehtml.append($('<div class="cover_appmsg_item" />').append(temph, $('<div class="appmsg_thumb_wrp" />').append(tempimg)));
        $(".media_preview_area").each(function(){
            var tempdiv = $('<div class="appmsg_item" />');
            tempdiv.append($('img', this).outerHTML(), $('.appmsg_title', this).outerHTML());
            prehtml.append(tempdiv.outerHTML());
        });
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
});
