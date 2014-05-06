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
};

$(function() {
    var jsonsdata = [{"tl":"菜单一", "url":"http://www.jd.com"}, {"tl":"菜单二", "url":"http://www.qq.com"}, {"tl":"菜单三", "url":"http://www.cc.com", "children":[{"tl":"3-1", "url":"http://www.jd.com"},{"tl":"3-2", "url":"http://www.jd.com"},{"tl":"3-3", "url":"http://www.jd.com"},{"tl":"3-4", "url":"http://www.jd.com"},{"tl":"3-5", "url":"http://www.jd.com"}]}];
    var jsonhtml = [], itemid = 1;
    $.each(jsonsdata, function(i, category) {
        var temphtml, subhtm, chrend = Boolean(category.children);
        if(chrend){
            temphtml = createNode(category.tl, "li", {'class':'dd-item', 'data-tl':category.tl, 'data-url':category.url}, itemid);
            subhtm = $('<ol class="dd-list" />');
            $.each(category.children, function(index, subitem) {
                subitem = createNode( subitem.tl, "li", {'class':'dd-item', 'data-tl':subitem.tl, 'data-url':subitem.url});
                subhtm.append(subitem);
            });
            temphtml.append(subhtm);
        } else {
            temphtml = createNode(category.tl, "li", {'class':'dd-item', 'data-tl':category.tl, 'data-url':category.url}, itemid);
        }
        itemid++;
        temphtml.find('.action-buttons').hide();
        jsonhtml.push(temphtml);
    });
    $(document).on({
        mouseenter: function () {
            $(this).find('.action-buttons').show();
        },
        mouseleave: function () {
            $(this).find('.action-buttons').hide();
        }
    }, ".dd-handle");
    $(document).on("click", '.dd-item .red', function(event) {
        event.preventDefault();
        $(this).parent().parent().parent().remove();
    });
    $(document).on("click", '.dd-handle .blue', function(event) {
        event.preventDefault();
        var temphtml, altitle, alurl, temobj;
        temobj = $(this);
        altitle = $(this).parent().parent().find("span").text();
        alurl = $(this).parent().parent().parent().attr('data-url');
        temphtml = $('<div id="tempview" />');
        temphtml.html('<div class="form-horizontal"><div class="form-group"><label class="col-sm-3 control-label">菜单名称：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-5" type="text" id="temptitle" value=""></div></div></div><div class="form-group"><label class="col-sm-3 control-label">链接地址：</label><div class="col-xs-12 col-sm-9"><div class="clearfix"><input class="col-xs-10 col-sm-10" type="text" value="" id="tempurl"></div></div></div></div>');
        temphtml.find("#temptitle").attr("value",altitle);
        temphtml.find("#tempurl").attr("value",alurl);
        bootbox.dialog({
            message: temphtml.html(),
            title: "编辑菜单",
            buttons: {
                success: {
                    label: "确定",
                    className: "btn-primary",
                    callback: function() {
                        //alert($('#temptitle').val());
                        temobj.parent().parent().find("span").text($('#temptitle').val());
                        temobj.parent().parent().parent().attr('data-url',$('#tempurl').val());
                    }
                },
            }
        });
    });
    $("#nestable ol").appendEach(jsonhtml);
	$('.dd').nestable({"maxDepth": 2});
    $(".dd a").on("mousedown", function(event) {
        event.preventDefault();
        return false;
    });
    $("#WxDataMusNewMenu").change(function() {
        var type = $("#WxDataMusNewMenu").val();
        type == 0 ? $("#WxDataMusNewsubMenu").removeAttr('disabled') : $("#WxDataMusNewsubMenu").attr('disabled', 'disabled');
        if(type == 0){
            var selectop = '';
            $(".firmenu").each(function() {
                $("#WxDataMusNewsubMenu").append($('<option value="'+$(this).attr('id')+'">'+$(this).text()+'</option>'));
            });
        }
    });
    //console.log($('.dd').nestable('serialize'));

});

$(document).on('click', '#addnewitem', function() {
    var type, newtitle, newurl,treejason;
    type = $("#WxDataMusNewMenu").val();
    newtitle = $('#WxDataMusFName').val();
    newurl = $('#WxDataMusFKeysOrLink').val();
    newitem = createNode( newtitle, "li", {'class':'dd-item', 'data-tl':newtitle, 'data-url':newurl});
    if(type == 0){
        targetid = $("#WxDataMusNewsubMenu").find("option:selected").attr('value');
        var hol = $("#"+targetid).parent().parent().has('ol').val();
        if(hol) {
            $("#"+targetid).parent().next('ol').append(newitem);
        } else {
            $("#"+targetid).parent().parent().append($('<ol class="dd-list" />').append(newitem));
        }
    } else {
        $("#nestable > ol").append(newitem);
    }
    clearForm("#WxDataMusWcForm");
    $(".dd a").on("mousedown", function(event) {
        event.preventDefault();
        return false;
    });
});

$(document).on('click', '#savejson', function() {
    var treejason = $('.dd').nestable('serialize');
    var pdata = $.toJSON(treejason);
    console.log(pdata);
    //alert(typeof pdata);
    $.ajax({
        url: ADMIN_WC_URL + "_mFields?_m=save",
        async: false,
        type: 'POST',
        data: pdata,
        success: function(data, status){
            bootbox.alert("提交成功！");
            // bootbox.alert($("#ajcont").html());
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
});