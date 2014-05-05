$(function() {
	var wxTypeId = $("#WxWebchatFWxType").val();
	wxTypeShow(wxTypeId);
	
	$("#WxWebchatFWxType").on("change", function() {
		var v = $(this).val();
		wxTypeShow(v);
	});
	
});

// Change事件
function wxTypeShow(wxTypeVal) {
	if (wxTypeVal == 'M') {
		$("#dAppId").hide();
		$("#dAppSecret").hide();
	} else {
		$("#dAppId").show();
		$("#dAppSecret").show();
	}
}