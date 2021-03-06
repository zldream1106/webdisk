<?php 
session_start();
if ( $_SESSION['username'] == "" ) {
    echo "<script>window.location.href='./login.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<meta charset=utf-8>
	<head>
		<title>Demo TaskBar</title>
		<link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon">
		<link href="plug/AeroWindow V3.5/css/jquery-ui.css" rel="stylesheet" type="text/css"/> 
		<link href="css/luofei.css" rel="stylesheet" type="text/css">   
		<link href="css/right-hand-button.css" rel="stylesheet" type="text/css">
		<link href="plug/AeroWindow V3.5/css/AeroWindow.css?r=123" rel="stylesheet" type="text/css"/>
		<script language="JavaScript" src="js/jquery-1.6.js" ></script>
		<script language="JavaScript" src="plug/AeroWindow V3.5/js/jquery-ui-1.8.1.custom.min.js"></script> 
		<script language="JavaScript" src="plug/AeroWindow V3.5/js/jquery.easing.1.3.js"></script>         
		<script language="JavaScript" src="plug/AeroWindow V3.5/js/jquery-AeroWindow.js"></script>
		<script type="text/javascript" src="js/imagePreview-html5.js"></script>
		<script language="JavaScript" src="js/taskbar.js" ></script>
		<script language="JavaScript" src="js/desktop.js" ></script>
		<script language="JavaScript" src="js/windows.js" ></script>
		<script language="JavaScript" src="js/util.js" ></script>
		<script language="JavaScript" src="js/init.js" ></script>
		<script language="javascript" src="js/common.js"></script>
		<script language="javascript" src="js/rightButton.js"></script>
		<script language="javascript" src="js/autocomplete.js"></script>
		<script language="javascript">
			var contextMenuObj;
			var MSIE = navigator.userAgent.indexOf('MSIE')?true:false;
			var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g,'$1')/1;	
			var activeContextMenuItem = false;
			function highlightContextMenuItem()
			{
				this.className='contextMenuHighlighted';
			}
	
			function deHighlightContextMenuItem()
			{
				this.className='';
			}
	
			function showContextMenu(e)
	 		{
	  			contextMenuSource = this;
	  			if(activeContextMenuItem)activeContextMenuItem.className='';
	  			if(document.all)e = event;
	  			var xPos = e.clientX;
	  			if(xPos + contextMenuObj.offsetWidth > (document.documentElement.offsetWidth-20)){
	  			xPos = xPos + (document.documentElement.offsetWidth - (xPos + contextMenuObj.offsetWidth)) - 20; 
	 			}
	  
	  			var yPos = e.clientY;
	  			if(window.document.body.scrollTop > 0)
	    		{
	      			yPos = (window.screen.Height-20) ? e.clientY + window.document.body.scrollTop -60 : e.clientY;
	    		}
	    		else if (window.pageYOffset) 
	    		{
	     		 	yPos = (window.pageYOffset > 0) ? e.clientY + window.pageYOffset -20 : e.clientY;
	    		}
	    		else
	    		{ yPos = e.clientY; }
				/*处理边界问题*/
				if((yPos >= 0) && (yPos < 20)) {
					contextMenuObj.style.left = xPos + 'px';
	  				contextMenuObj.style.top = 0 + 'px';
	  				contextMenuObj.style.display='block';
				}
				else if((yPos <= 520) && (yPos >= 20)){
	  				contextMenuObj.style.left = xPos + 'px';
	  				contextMenuObj.style.top = yPos + 'px';
	  				contextMenuObj.style.display='block';
				}
				else if((yPos <= 643) && (yPos > 520)) {
					contextMenuObj.style.left = xPos + 'px';
	  				contextMenuObj.style.top = 520 + 'px';
					contextMenuObj.style.display='block';
				}
	  			return false; 
			}

			function hideContextMenu(e)
			{
				if(document.all) e = event;
				if(e.button==0 && !MSIE){
			
				}else{
					contextMenuObj.style.display='none';
				}
			}
	
			function initContextMenu()
			{
				contextMenuObj = document.getElementById('contextMenu');
				contextMenuObj.style.display = 'block';
				var menuItems = contextMenuObj.getElementsByTagName('LI');
				for(var no=0;no<menuItems.length;no++){
					menuItems[no].onmouseover = highlightContextMenuItem;
					menuItems[no].onmouseout = deHighlightContextMenuItem;
			
					var aTag = menuItems[no].getElementsByTagName('A')[0];
			
					var img = menuItems[no].getElementsByTagName('IMG')[0];
					if(img){
						var div = document.createElement('DIV');
						div.className = 'imageBox';
						div.appendChild(img);
				
						if(MSIE && navigatorVersion<6){
							aTag.style.paddingLeft = '0px';
						}
				
						var divTxt = document.createElement('DIV');	
						divTxt.className='itemTxt';
						divTxt.innerHTML = aTag.innerHTML;
				
						aTag.innerHTML = '';
						aTag.appendChild(div);
						aTag.appendChild(divTxt);
						if(MSIE && navigatorVersion<6){
							div.style.position = 'absolute';
							div.style.left = '2px';
							divTxt.style.paddingLeft = '15px';
						}
				
						if(!document.all){
							var clearDiv = document.createElement('DIV');
							clearDiv.style.clear = 'both';
							aTag.appendChild(clearDiv);		
						}
						}else{
							if(MSIE && navigatorVersion<6){
							aTag.style.paddingLeft = '15px';
							aTag.style.width = (aTag.offsetWidth - 30) + 'px';
							}else{
								aTag.style.paddingLeft = '30px';
								aTag.style.width = (aTag.offsetWidth - 60) + 'px';
							}
						}
					}
					function getMouse (event) {
                        mouseX = event.x;
                        mouseY = event.y;
                        
                        X.value = mouseX;
                        Y.value = mouseY;
				    }
					document.documentElement.onmousemove = getMouse;
					contextMenuObj.style.display = 'none';		
					document.documentElement.oncontextmenu = showContextMenu;
					document.documentElement.onclick = hideContextMenu;
					
			}
			function myDialog () {
				alert("hello world!");
			}

            $(function() {
                var screenY = $(window).height();
                $(window).mousemove(function( e ) {
                    //console.log(e.screenX + ' ' + e.screenY);
                    if ( e.screenY > screenY  ) {
                        $('.Qbanner').show();
                        $('.quickDialbox').show();
                    } else {
                        $('.Qbanner').hide();
                        $('.quickDialbox').hide();
                    }
                });
            });
			</script>
			
	</head>

<body style="padding:0;margin:0;">
<style type="text/css">
    .user {
        position: absolute;
        right: 20px;
        top: 20px;
        color: #fff;
    }
    .user a {
        text-decoration: none;
        color: #fff;
        font-size: 14px;
        margin: 0 10px;
    }
</style>
<div class="user">
    <a href="javascript:;"><?php echo $_SESSION['username'];?></a> |
    <a href="php/logout.php">退出</a>
</div>
	<!--桌面-->
	<div class="desktop" id="desktop">
	</div>
	<div class="desktop" id="windows">
	</div>
	<!--任务栏-->
	<div id="desktop"></div>
	<ul id="contextMenu">
		<li><a url="javascript:history.back();">后退</a></li>
		<li><a url="javascript:history.forward();">前进</a></li>
		<li><a href="#" onclick="reLoad();">刷新</a></li>
		<li><a href="#" onclick="addTask();">添加任务</a></li>
		<li><a href="#" onclick="deleteT();">删除任务</a></li>
		<li><a href="#" onclick="change_bg();">更换桌面背景</a></li>
		<li><a href="#" onclick="displayDesktop();">显示桌面</a></li>
		<li><a href="#" onclick="manageTask();">任务管理器</a></li>
	</ul>
	<script type="text/javascript">
		initContextMenu();
	</script>
	<div id="zuobiao" style="display:none">
		Y:<input type="text" id="Y" size="4"><br>
		X:<input type="text" id="X" size="4">
	</div>
	<div id="deleteTask">
		<p id="tishi">请输入你要删除的ID号</p>
		<input type="text" id="Did" name="Dname" size="10">
		<input type="button" value="确定" onclick="deleteTask();" id="Dsubmit">
		<input type="reset" value="取消"  id="DgiveUp" onclick="DgiveUp();">
	</div>
	<div id="createTask">
		<p>任务ID:<input type="text" size="10" id="ID" name="ID1" value="1000"><p>
		<p>任务名称:<input type="text" size="10" id="task_name" name="name"></p>
		<p>Left:<input type="text" size="4" id="task_left" name="Left" value="300">Top:<input type="text" size="4" id="task_top" name="Top" value="30"></p>
		<p>图标:<input type="file" name="image" id="demo_input"></p>
		<div id="demo_result"></div>
		<div id="blank_area_left"></div>
		<input type="button" value="确认" name="creatTask" id="task_submit" onclick="submit();"><input type="reset" value="取消" name="giveUp" onclick="quXiao();" id="task_reset">
	</div>
	<div id="task_mange">
	</div>
	<!--任务栏-->
	<div class="Qbanner">
		<div class="QbannerContainer">
			<div class="left">
			</div>
			<div class="center">
			</div>
			<div class="right">
			</div>
		</div>
	</div>
    <!--任务栏copy-->
    <div class="Qbanner-copy"></div>
	<!--图标显示-->
	<div class="quickDialbox">
		<div class="appBox" id="appBox_0">
			<div class="boxLogo" style="background-image: url('images/Qbanner/logo.png');"></div>
			<div class="boxTitle">
				<a>网址</a>
			</div>
		</div>
		<div class="appBox" id="appBox_1">
			<div class="boxLogo" style="background-image: url('images/Qbanner/logo_1.png');"></div>
			<div class="boxTitle">
				<a>图片</a>
			</div>
		</div>
		<div class="appBox" id="appBox_2">
			<div class="boxLogo" style="background-image: url('images/Qbanner/logo_2.png');"></div>
			<div class="boxTitle">
				<a href="plugin/showFile.php">文档</a>
			</div>
		</div>
		<div class="appBox" id="appBox_3">
			<div class="boxLogo" style="background-image: url('images/Qbanner/logo_3.png');"></div>
			<div class="boxTitle">
				<a>管理</a>
			</div>
		</div>
	</div>
</body>
</html>
