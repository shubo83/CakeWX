$(function(){
	
	// BootBox
	$(".bootbox-confirm").on(ace.click_event, function() {
		var url = $(this).attr('alt');
		bootbox.confirm("确定要删除么？", function(result) {
			if(result) {
				location.href= url;
			}
		});
	});
	
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
	});
});