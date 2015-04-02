$(document).ready(function(){
	$('.banner').unslider();
});
function register(handleType,nameNullMsg,pwdNullMsg,pwdLengthMsg,successMsg){
	if($("#username").val()==""){
		alert(nameNullMsg);
		return false;
	}
	if($("#pwd").val()==""){
		alert(pwdNullMsg);
		return false;
	}
	if($("#pwd").val().length<6 || $("#pwd").val().length>22){
		alert(pwdLengthMsg);
		return false;
	}
	var user = new Object(); 
	user.username = $("#username").val();
	user.pwd = $("#pwd").val();
	user.gender = $('input[name="gender"]:checked').val();
	if(handleType=="modify"){
		user.id = $("#userId").val();
	}
	$.post(
	"/common/"+handleType+"Info",
	{
		'info_type':'user',
		'data':JSON.stringify(user)
	},
	function(data){
		var result=$.parseJSON(data);
		if(result.result=="success"){
			alert(successMsg);
			location.href='/home/login';
		}else{
			alert(result.message);
		}
	});
}
function addForum(titleNullMsg,successMsg){
	if($("#title").val()==""){
		alert(titleNullMsg);
		return false;
	}
	var forum = new Object(); 
	forum.title = $("#title").val();
	forum.content = textEditor.html();
	forum.column_id = $("#column_id").val();
	$.post(
	"/common/"+'add'+"Info",
	{
		'info_type':'forum',
		'data':JSON.stringify(forum)
	},
	function(data){
		var result=$.parseJSON(data);
		if(result.result=="success"){
			alert(successMsg);
			location.href='/home/forumList?id='+$("#column_id").val();
		}else{
			alert(result.message);
		}
	});
}
var comment_type='';
var comment_id='';
function reply(type,id){
	comment_type=type;
	comment_id=id;
	setDivCenter('#dialog',true);
}
function comment(successMsg){
	var comment = new Object(); 
	comment.to_type = comment_type;
	comment.to_id = comment_id;
	comment.content = $("#comment_content").val();
	$.post(
	"/common/"+'add'+"Info",
	{
		'info_type':'comment',
		'data':JSON.stringify(comment)
	},
	function(data){
		var result=$.parseJSON(data);
		if(result.result=="success"){
			alert(successMsg);
			location.reload();
		}else{
			alert(result.message);
		}
	});
}
function uploadAvatar(){
	uploadImage(addThumbBeforeUpload,addThumbAfterUpload);
}
function addThumbBeforeUpload(){
	$("#avatar").attr("src","/assets/images/cms/loading.gif");
}
function addThumbAfterUpload(imageSrc){
	$("#avatar").attr("src",imageSrc);
}
function saveUser(nameNullMsg,pwdLengthMsg,oldPwdNullMsg,successMsg){
	if($("#username").val()==""){
		alert(nameNullMsg);
		return false;
	}
	if($("#newPwd").val()!=""){
		if($("#newPwd").val().length<6 || $("#newPwd").val().length>22){
			alert(pwdLengthMsg);
			return false;
		}
		if($("#oldPwd").val()==""){
			alert(oldPwdNullMsg);
			return false;
		}
	}
	var user = new Object();
	user.username = $("#username").val();
	user.avatar = $("#avatar").attr('src');
	user.oldPwd = $("#oldPwd").val();
	user.newPwd = $("#newPwd").val();
	user.gender = $('input[name="gender"]:checked').val();
	user.email = $("#email").val();
	user.phone = $("#phone").val();
	$.post(
	"/common/"+'modify'+"Info",
	{
		'info_type':'user',
		'data':JSON.stringify(user)
	},
	function(data){
		var result=$.parseJSON(data);
		if(result.result=="success"){
			alert(successMsg);
			location.reload();
		}else{
			alert(result.message);
		}
	});
}