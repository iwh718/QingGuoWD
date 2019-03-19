
<html><head>
		<title>文院一键查成绩</title>
			<meta charset="utf-8">
		 <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	     <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	     <script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.js"></script>
	     <script src="./md5.js"></script>
	     <script src="./check.js"></script>
		 <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet">	
		 <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		 <style type="text/css">
.sign_box{
	box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.4);
	padding: 10px;
	border-radius: 10px;
	margin: 10px;
	background:#fff;
}
body{
	background:  #595959;
	padding-top: 50px;
}
.loginButton{
	border-radius: 50%;
	height: 50px;
	width: 50px;
	box-shadow: 2px 2px 2px 2px rgba(0,0,0,0.2);
}
.form-group,.form-control,input{
	border-radius: 0!important;
	border-top: none;
	border-left: none;
	box-shadow: none;
	border-right:none;
}
.form-control:focus {
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: none;
     box-shadow: none; 
}



		</style>

	</head>
	<body >
		<div class="container">
			<div class="sign_box ">
				<div class="h4 text-center">文达学院一键查成绩 <small>版本：v1.0 | By IWH</small></div>
			<form name="Logon" method="post" action="./login.php" id="Logon"  autocomplete="off" >
				<div class="form-group">
    				<label for="name">学号</label>
    					<input name="txt_asmcdefsddsd" id="txt_asmcdefsddsd" class="form-control"  type="text">
  				</div>
  				<div class="form-group">
    				<label for="name">密码</label>
    					<input class="form-control" id="txt_pewerwedsdfsdff"  name="txt_pewerwedsdfsdff"  onblur="chkpwd(this)" onkeyup="chkpwd(this)" type="password">	
  				</div>
			
			<input id="dsdsdsdsdxcxdfgfg" name="dsdsdsdsdxcxdfgfg" type="hidden">
			<input id="fgfggfdgtyuuyyuuckjg" name="fgfggfdgtyuuyyuuckjg" type="hidden">			
			<div class="form-group">
    				<label for="name">输入验证码</label>
    					<input class="form-control" id="txt_sdertfgsadscxcadsads" name="txt_sdertfgsadscxcadsads"  onblur="chkyzm(this)" onkeyup="chkyzm(this)">
  				</div>
  				<div class="form-group">
    					<img id="imgCode" src="./getValidate.php" onclick="changeValidateCode(this)" alt="单击可更换图片！" title="点击更换">		
  				</div>
			
			<div class="form-group">
    			<button class="btn btn-primary center-block loginButton" type="submit"><span class="fa fa-chevron-right"></span></button>	
  			</div>
							
			
		</form>		
	</div>
			
		</div>
		<footer>
			<div class="text-center text-dark">版本：v1.0 | By IWH</div>
		</footer>			
	</body>
	 <script src="./check.js"></script>

</html>