var textEditor;
$(document).ready(function(){
	KindEditor.ready(function(K) {
		textEditor = K.create('#textEditor', {
			uploadJson : '/assets/kindEditor/php/upload_json.php',
			fileManagerJson : '/assets/kindEditor/php/file_manager_json.php',
			allowFileManager : true,
			width : '100%',
			height:'300px',
			resizeType:0,
			imageTabIndex:1
		});
	});
});
//让指定的DIV始终显示在屏幕正中间   
function setDivCenter(divId,bk){  
	var top = ($(window).height() > $(divId).height())?($(window).height() - $(divId).height())/2:0;   
	var left = ($(window).width() - $(divId).width())/2;   
	var scrollTop = $(document).scrollTop();   
	var scrollLeft = $(document).scrollLeft();   
	$(divId).css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show(100);
	if(bk) $("#bkDiv").show();
}
function removeDiv(divId){  
	$(divId).hide(100);
	$("#bkDiv").hide(100);
}
function showWait(){
	setDivCenter("#waitDiv",true);
}
function closeWait(){
	removeDiv("#waitDiv");
}
function showMsg(msg){
	$("#msgBox").show();
	$("#newMsg").text(msg);
	var d = new Date();
	var timeStr = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	$("#msgTime").text(timeStr);
	setTimeout(closeMsg,2500);
}
function closeMsg(){
	$("#msgBox").hide();
}
function jumpPage(url){
	var pageNum=$('#page_num').val();
	if(pageNum!=null && pageNum>0)
		location.href=url+pageNum;
	else
		alert("请输入正确页数!");
}
function getThumb(wraperId){
	var objJson = [];
	$(wraperId).each(function(index){
		objJson.push(jQuery.parseJSON('{"src":"' + $(this).find('.thumb-src').attr("src") + '"}')); 
	})
	return objJson;
}
/**
 * 数据与后台交互
 * (object)postData
 * 默认值：callBack="NoCallBack",confirmMsg="NoConfirmation",refresh=false
 */
function dataHandler(funcType,dataType,postDataObj,callBack,confirmMsg,cancelCallBack,successMsg,refresh){
	if(confirmMsg && !confirm(confirmMsg)){
		if(cancelCallBack) cancelCallBack();
		return false;
	}
	$.post(
	"/common/"+funcType+"Info",
	{
		'info_type':dataType,
		'data':JSON.stringify(postDataObj)
	},
	function(data){
		var result=$.parseJSON(data);
		if(result.result=="success"){
			if(successMsg) showMsg(successMsg);
			if(callBack) callBack();
			if(refresh) location.reload();
		}else{
			alert(result.message);
		}
	});
}
function addImage(){
	$("#file").click();
}
function uploadImage(beforeUpload,successHandler){
	$("#upload_image_form").ajaxSubmit({
		success: function (data) {
			var result=$.parseJSON(data);
			if(result.code){
				successHandler(result.message);
			}else{
				alert(result.message);
			}
		},
		url: "/common/uploadImage",
		data: $("#upload_image_form").formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			beforeUpload();
		}
	});
	return false;
}
/*
//搜索
function search(){
	var p_name="";
	var p_listed="";
	if($("#type").val()!=undefined){
		p_name=$("#p_name").val();
		if($("#p_listed option:selected").val()!=undefined){
			p_listed=$("#p_listed option:selected").val()!="all"?"&listed="+$("#p_listed option:selected").val():"";
		}
		location.href="/merchant/"+$("#type").val()+"?name="+p_name+p_listed;
	}
	else{
	alert("没有商品可搜索！");}
	
}

function scroll_delete(scrollid,order,amount){
	if(confirm("确定删除该滚动图片？")){
		$.post(
			"/kmadmin/admin/del_info",
			{
				'info_type':"scroll",
				'scrollid':scrollid,
				'order':order,
				'amount':amount
			},
			function(data){
				var result=$.parseJSON(data);
				if(result.result=="success"){
					location.reload();
				}else{
					alert(result.message);
				}
			});
	}
}
function add_thumb(){
	$("#file").click();
}
function upload_thumb_img(form_id){
	$(form_id).ajaxSubmit({
		success: function (data) {
			var result=$.parseJSON(data);
			if(result.code){
				$("#addImgList div img").attr("src","/assets/images/cms/appbg_ad.png");
				var new_img_item='<li onmouseover="imgover(this)" onmouseout="imgout(this)" class="img-item imagelist"><img class="thumb-src" width="77" height="77" src="'+result.message+'"><img onclick="delclick(this)" class="del-bt" title="删除该缩略图" src="/assets/images/cms/delete.png"></li>';
				$("#addImgList").before(new_img_item);
				if($("#imgListDivs").children(".imagelist").length>=3){
					$("#addImgList").hide();
				}
			}else{
				alert(result.message);
			}
		},
		url: "/cms/index/upload_img",
		data: $(form_id).formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			$("#addImgList div img").attr("src","/assets/images/cms/loading.gif");
		}
	});
	return false;
}
function uploadImg(formId,handlerCase){
	$(formId).ajaxSubmit({
		success: function (data) {
			closeWait();
			var result=$.parseJSON(data);
			if(result.code){
				handler(handlerCase,result.message);
			}else{
				alert(result.message);
			}
		},
		url: "/cms/index/upload_img",
		data: $(formId).formSerialize(),
		type: 'POST',
		beforeSubmit: function () {
			showWait();
		}
	});
	return false;
}*/
function language(language){
	$.post(
	"/cms/index/set_language",
	{
		'language':language
	},
	function(data){
		location.reload();
	});
}