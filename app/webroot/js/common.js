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

// 修复 IE 下 PNG 图片不能透明显示的问题
function fixPNG(myImage)
{
	var arVersion = navigator.appVersion.split("MSIE");
	var version = parseFloat(arVersion[1]);

	if ((version >= 5.5) && (version < 7) && (document.body.filters))
	{
		 var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
		 var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : "";
		 var imgTitle = (myImage.title) ? "title='" + myImage.title   + "' " : "title='" + myImage.alt + "' ";
		 var imgStyle = "display:inline-block;" + myImage.style.cssText;
		 var strNewHTML = "<span " + imgID + imgClass + imgTitle
	   + " style=\"" + "width:" + myImage.width
	   + "px; height:" + myImage.height
	   + "px;" + imgStyle + ";"
	   + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
	   + "(src=\'" + myImage.src + "\', sizingMethod='scale');\"></span>";
		 myImage.outerHTML = strNewHTML;
	} 
}

$(function() {
	$(".page_tips").animate({ opacity: 'hide' }, 3000);
});
