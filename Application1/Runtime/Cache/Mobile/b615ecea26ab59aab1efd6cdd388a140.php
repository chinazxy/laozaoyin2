<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="format-detection" content="telphone=no, email=no" />
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="cchen" />
    <meta name="description" content="诚享东方经销商下单系统" />
    <meta name="author" content="cchen, 719857499@qq.com" />
    <meta name="x5-page-mode" content="app">
    <title>找回密码</title>
    <!-- 通用类 -->
    <link rel="stylesheet" href="/Public/jd/css/reset.css">
    <link rel="stylesheet" href="/Public/jd/css/bootstrap3.min.css">
    <!-- 插件类 独立性 -->
    <link rel="stylesheet" href="/Public/jd/css/plugin.css">
    <!-- 所有页面类 -->
    <link rel="stylesheet" href="/Public/jd/css/chencc.css">
</head>
<body class="body-bg">
<div class="signup_box">
    <!-- logo -->
    <div class="logo">
        <img class="logo-img" src="/Public/jd/img/logo.png" alt="">
    </div>
    <div class="primary-text">找回密码</div>
    <!-- 输入框 -->
	<form id="fo" method='POST' action="">
		<div class="ccinput-group">
			<input id="tel" type="tel" class="ccinput-input" name='tel' placeholder="手机号">
		</div>
		<div class="ccinput-group">
			<input id="inputMask" type="tel" class="ccinput-input" name='viry' placeholder="输入验证码">
			  <div id="mask" class="ccinput-label">验证码</div>
		</div>
		<!-- 输入框 -->

		<!-- 下一步 -->
		<a class="cc-btn" href="javascript:void(0);">下一步</a>
    </form>
</div>
    <script src="/Public/jd/js/jquery.js"></script>
    <script src="/Public/jd/js/plugin.min.js"></script>
	<script>
        $(function(){
			$('.signup_box').css('min-height',$(window).innerHeight());
            function numDown(times){
				if(!times){times=60;}

                var timer,
                timerNum=times;
                var $mask=$("#mask");
                $mask.addClass("active");
                timer=setInterval(function(){
                    timerNum--;
                    var str="剩余"+timerNum+"秒";
                    $mask.text(str);
                    if(timerNum<=0){
                        clearInterval(timer);
                        flag=true;
                        $mask.text("重新获取").removeClass("active");                         
                    }
                },1000);
            };
         	var flag = true;  
            $("#mask").on("click",function(){
            	var tel=$("#tel").val().trim();
                var telPattern=/^[1][34578][0-9]{9}$/;
                var $mask=$(this);
                if(tel==""||isNaN(tel)){
                    $.toast({text:"请输入手机号"});
                    return;
                };
                if(tel.length<11){
                    $.toast({text:"请输入11位手机号"});
                    return;
                }
                if(!telPattern.test(tel)){
                    $.toast({text:"请输入正确的手机号"});
                    return;
                }
				 $.post("<?php echo U('index/forget');?>",{mobile:tel},function(data){
				    console.log(data);
					var obj = $.parseJSON(data);
					console.log(obj);
					if(obj.status == 1002){
					   $.toast({text:"正在发送..."});
             	       $.post("<?php echo U('send_msg');?>",{mobile:tel,type:2},function(data){
					    if(data.status==1000){
             			  numDown();
             		    }else if(data.status==1003){
             			$.toast({text:'短信发送太频繁'});
             			numDown(data.res_time);
             			return;
             		    }else{
             			$.toast({text:'短信发送失败,请重新发送 '});
             		    return;
             		    }
					  });
					}
					else if(obj.status == 1003){
					    $.toast({text:"不存在该用户"});
					    return;
					}
				 });
                /*if(flag){
                    flag=false;
                    $.toast({text:"正在发送..."});
             	    $.post("<?php echo U('send_msg');?>",{mobile:tel,type:2},function(data){
             		  flag = true;
             		 if(data.status==1000){
             			  numDown();
             		
             		 }else if(data.status==1003){
             			$.toast({text:'短信发送太频繁'});
             			 
             			numDown(data.res_time);
             			return;
             		 }else{
             			
             			 $.toast({text:'短信发送失败,请重新发送 '});
             		    return;
             		 }
           	   	   })
                }   
				}*/
            });
            var isclick=true;
            /* 显示 */
            $("#show").on("click",function(){
                if($(this).hasClass("active")){
                    $(this).removeClass("active").text("显示");
                    $("#pos1").attr("type","password");
                }else {
                    $(this).addClass("active").text("隐藏");
                    $("#pos1").attr("type","text");
                }
            });
            $("#show2").on("click",function(){
                if($(this).hasClass("active")){
                    $(this).removeClass("active").text("显示");
                    $("#pos2").attr("type","password");
                }else {
                    $(this).addClass("active").text("隐藏");
                    $("#pos2").attr("type","text");
                }
            });
            /* 下一步 */
              $(".cc-btn").on('click',function(){
			   var tel=$("#tel").val().trim();
			   var inputMask=$("#inputMask").val().trim();
			   var telPattern=/^[1][3578][0-9]{9}$/;
			   if(tel==""||isNaN(tel)){
                    $.toast({text:"请输入手机号"});
                    return;
                };
                if(tel.length<11){
                    $.toast({text:"请输入11位手机号"});
                    return;
                }
                if(!telPattern.test(tel)){
                    $.toast({text:"请输入正确的手机号"});
                    return;
                }
                if(inputMask==""||isNaN(inputMask)){
                    $.toast({text:"请输入验证码"});
                    return;
                }
            	  $('#fo').submit();
              })
/*             $(".cc-btn").on("click",function(){
                var tel=$("#tel").val().trim();
                var inputMask=$("#inputMask").val().trim();
                var pos=$("#pos1").val().trim();
                var pos2 =$("#pos2").val().trim();
                var telPattern=/^[1][3578][0-9]{9}$/;
                var posPattern=/(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{6,16}$/;
                if(tel==""||isNaN(tel)){
                    $.toast({text:"请输入手机号"});
                    return;
                };
                if(tel.length<11){
                    $.toast({text:"请输入11位手机号"});
                    return;
                }
                if(!telPattern.test(tel)){
                    $.toast({text:"请输入正确的手机号"});
                    return;
                }
                if(inputMask==""||isNaN(inputMask)){
                    $.toast({text:"请输入验证码"});
                    return;
                }
                if(pos==""){
                    $.toast({text:"请输入密码"});
                    return;
                }
                if(pos!=pos2){
                	 $.toast({text:"两次密码输入不一致"});
                }
              
                if(isclick){
                	console.log(tel);
                	console.log(pos);
                	console.log(pos2);
                	console.log(inputMask);
             	   $.post("<?php echo U('mobile_exist');?>",{mobile:tel,password:pos,password2:pos2,verify:inputMask},function(data){
            		   if(data.status==1000){
            			   console.log(data);
            			   window.location.href  = data.success.url+"?mobile="+data.success.mobile+"&password="+data.success.password;
            		   }
            	   })
              }
           }); */
        });
    </script>
</body>
</html>