$(function() {
	// Jquery Plugin
 	jQuery.fn.appendEach = function(arrayOfWrappers){
	    var rawArray = jQuery.map(
	        arrayOfWrappers,
	        function(value, index){
	            return(value.get());
	        }
	    );

	    this.append(rawArray);
	    return(this);
	};
	
	// 添加菜单
	$(document).on('click', '#addnewitem', function() {
	 	event.preventDefault();
	    var temphtml, altitle, alurl, temobj;
	    temobj = $(this);
	    altitle = $(this).parent().parent().find("span").text();
	    alurl = $(this).parent().parent().parent().attr('data-url');
	    temphtml = $('<div id="tempview" />');
	    temphtml.html('<div class="form-horizontal"><div class="form-group"><label class="col-sm-3 control-label">菜单名称：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-10" type="text" id="temptitle" value=""></div></div></div><div class="form-group"><label class="col-sm-3 control-label">关键字或链接：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-10" type="text" value="" id="tempurl"></div></div></div></div>');
	    temphtml.find("#temptitle").attr("value",'');
	    temphtml.find("#tempurl").attr("value",alurl);
		saveMenuData(temphtml.html());	// 保存菜单数据
	});
	
	// 保存排序
	$(document).on('click', '#saveitem', function() {
		saveAllData();
	});
	
	// 加载Menus
	var loaded = freshMus();
	if (loaded) {
		domFresh()		// 刷新DOM
	}
});

// ==============================Public Function
function saveAllData() {
	var pdata = 'post=' + $.toJSON($('.dd').nestable('serialize'));
	
	$.ajax({
        url: ADMIN_WC_URL + "mFields?_m=api&_a=svMenus",
        async: false,
        type: 'POST',
        data: pdata,
        success: function(data, status){
			// freshMus();
            bootbox.alert("菜单成功保存！");
            // bootbox.alert($("#ajcont").html());
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
}
function saveMenuData(temphtml, id) {
	var title = id ? '编辑菜单' : '添加菜单';
	var edt = id ? 'edit' : 'add';
    clearForm(".modal-body");
	bootbox.dialog({
        message: temphtml,
        title: title,
        buttons: {
            success: {
                label: "确定",
                className: "btn-primary",
                callback: function() {
					var mus = new Object();
					mus.FName = $('#temptitle').val();
					mus.FKeysOrLink = encodeURIComponent($('#tempurl').val());
					if (id) {
						mus.Id = id;
					}
					var pdata = 'post=' + JSON.stringify(mus); 
					$.ajax({
				        url: ADMIN_WC_URL + "mFields?_m=api&_a=save",
				        async: false,
				        data: pdata,
				        type: 'POST',
				        success: function(data, status) {
							data = JSON.parse(data);
							if (data.state == 1) {
								var FKeysOrLink = $('#tempurl').val();
								_doMenu(edt, mus.FName, FKeysOrLink, data.data); 	//操作菜单
							}
				        },
				        error: function(){
				            bootbox.alert("系统出错。");
				        }
				    });
                }
            },
        }
    });
}
function freshMus() {
	$.ajax({
        url: ADMIN_WC_URL + "mFields?_m=api",
        async: false,
        type: 'POST',
        success: function(data, status) {
			var jsonsdata = JSON.parse(data);
			var jsonhtml = [], itemid = 1;
			$.each(jsonsdata, function(i, category) {
		        var temphtml, subhtm;
				var chrend = category.children?1:0;
		        if(chrend){
		            temphtml = createNode(category.name, "li", {'class':'dd-item', 'data-url':category.url, 'data-id':category.id}, itemid);
		            subhtm = $('<ol class="dd-list" />');
		            $.each(category.children, function(index, subitem) {
		                subitem = createNode( subitem.name, "li", {'class':'dd-item', 'data-url':subitem.url, 'data-id':subitem.id});
		                subhtm.append(subitem);
		            });
		            temphtml.append(subhtm);
		        } else {
		            temphtml = createNode(category.name, "li", {'class':'dd-item', 'data-url':category.url, 'data-id':category.id}, itemid);
		        }
		        itemid++;
		        temphtml.find('.action-buttons').hide();
		        jsonhtml.push(temphtml);
		    });
			$("#nestable ol").appendEach(jsonhtml);
			$('.dd').nestable({"maxDepth": 2});
            // bootbox.alert($("#ajcont").html());
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
	return true;
}
function domFresh(id) {
	//alert(id);
	// var msdom;
	// msdom = id ? $("#nestable > ol").find("li[data-id='" + id + "']") : $("#nestable ol");
	// 
	// alert(dom);
	// DOM - 鼠标滑过
	$(document).on({
        mouseenter: function () {
            $(this).find('.action-buttons').show();
        },
        mouseleave: function () {
            $(this).find('.action-buttons').hide();
        }
    }, ".dd-handle");
	// 编辑菜单
	$(document).on("click", '.dd-handle .blue', function(event) {
        event.preventDefault();
        var temphtml, altitle, alurl, temobj;
        temobj = $(this);
        altitle = $(this).parent().parent().find("span").text();
        alurl = $(this).parent().parent().parent().attr('data-url');
		alid = $(this).parent().parent().parent().attr('data-id');
        temphtml = $('<div id="tempview" />');
        temphtml.html('<div class="form-horizontal"><div class="form-group"><label class="col-sm-3 control-label">菜单名称：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-5" type="text" id="temptitle" value=""></div></div></div><div class="form-group"><label class="col-sm-3 control-label">链接地址：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-10" type="text" value="" id="tempurl"></div></div></div></div>');
        temphtml.find("#temptitle").attr("value",altitle);
        temphtml.find("#tempurl").attr("value",alurl);
		saveMenuData(temphtml.html(), alid);	// 保存菜单数据
    });
	// 菜单删除
	$(document).on("click", '.dd-item .red', function(event) {
		event.preventDefault();
		var lm = $(this).parent().parent().parent();
		var id = lm.attr('data-id');
		var pdata = 'post=' + id;
		bootbox.confirm("确定要删除么？", function(result) {
			if(result) {
				$.ajax({
			        url: ADMIN_WC_URL + "mFields?_m=api&_a=del",
			        async: false,
					data: pdata,
			        type: 'POST',
			        success: function(data, status) {
						data = JSON.parse(data);
						if (data.state == 1) {
					        lm.remove();
						}
			        },
			        error: function(){
			            bootbox.alert("系统出错。");
			        }
			    });
			}
		});
    });
	// Other
	$(".dd a").on("mousedown", function(event) {
        event.preventDefault();
        return false;
    });
}
// ==============================Private Function
function _doMenu(type, name, url, id, tempobj) {
	if (type == 'add') {
		newitem = createNode(name, "li", {'class':'dd-item', 'data-id':id, 'data-url':url});
	    $("#nestable > ol").append(newitem);
		//domFresh(id)		// 刷新DOM
		$(".dd a").on("mousedown", function(event) {
	        event.preventDefault();
	        return false;
	    });
	} else {
		var muli = $("li[data-id='" + id + "']");
		muli.attr('data-url', url);
		muli.find('.dd-handle span').first().text(name);
	}
}
function createNode(name, nodetag, attr,itemid) {
    var tempnode = $("<"+nodetag+">" + "</"+nodetag+">"), i = 1;
    if(attr){
        $.map(attr, function(val, key) {
            tempnode.attr(key, val);
        });
    }
    if(itemid){
        tempnode.html("<div class='dd-handle'><span id='item"+itemid+"' class='firmenu'>"+name+"</span><div class='pull-right action-buttons'><a class='blue' href='#'><i class='icon-pencil bigger-130'></i></a><a class='red' href='#'><i class='icon-trash bigger-130'></i></a></div>");
    } else{
        tempnode.html("<div class='dd-handle'><span>"+name+"</span><div class='pull-right action-buttons'><a class='blue' href='#'><i class='icon-pencil bigger-130'></i></a><a class='red' href='#'><i class='icon-trash bigger-130'></i></a></div>");
    }
    return tempnode;
}
function clearForm(form) {
    $(':input', form).each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase(); // normalize case
        if (type == 'text' || type == 'password' || tag == 'textarea')
            this.value = "";
        else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
        else if (tag == 'select')
            this.selectedIndex = 0;
    });
}