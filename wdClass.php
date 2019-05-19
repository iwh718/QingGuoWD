<?php  

error_reporting(0);
session_start();
require("./classes/yb-globals.inc.php");
require_once './config.php';
//初始化
    $api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
    $iapp  = $api->getIApp();
    
    try {
       //轻应用获取access_token，未授权则跳转至授权页面
       $info = $iapp->perform();
    } catch (YBException $ex) {
       echo $ex->getMessage();
    }
    $token = $info['visit_oauth']['access_token'];//轻应用获取的token
    $_SESSION['token'] = $token;
    $api->bind($token);
    //获取基本用户信息
    $userInfo = $api->request('user/me');
    //去除用户名
    $info = $userInfo['info'];
    //存储到Session
    $_SESSION['userName'] = $info['yb_username']

 ?>
<html>
<head>
    <title>文院一键查成绩</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <script src="./js/jquery.min.js"></script>

    <script src="./md5.js"></script>
    <script src="./check.js"></script>
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection"/>

    <link rel="stylesheet" href="./css/font-awesome.css">
    <style type="text/css">
    body{
        padding-bottom:30px;
    }
        .sign_box {
            position: fixed;
            left: 5%;
            width: 90%;
            right: 5%;

            padding: 2.5%;
            box-sizing: border-box;
            top: 10%;
           
           

        }

        .form-group, .form-control, input {
            border-radius: 0 !important;
            border-top: none;
            border-left: none;
            box-shadow: none;
            border-right: none;
        }

        .form-control:focus {
            border-color: #1e88e5;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .logo {
            width: 20%;
            margin-left: 40%;
            margin-right: 40%;
            border-radius: 50%;
        }

        .h4 {
            width: 100%;
            text-align: center;
        }

        .info {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
        }

        .info-content {

            position: fixed;
            width: 80%;
            left: 10%;
            right: 25%;
            top: 20%;
            border-radius: 10px;
            padding: 5px;
            background: #ffffff;
        }

        #info-close {
            text-align: center;
            display: block;
            width: 100%;
        }

        .footer {
            opacity: .5;
        position: absolute;
          width: 90%;
          bottom: 5%;
          position: fixed;
         left:5%;
            color: #000;
        }



    </style>
    <script type="text/javascript">


        $(function () {

            $('.modal').modal();

            $('#info').click(function () {
                $('#modal1').modal('open');
            });


            $('#revokeCode').click(function () {
                location.href = "./wdClass/revoke.php";
                console.log('click')
            });
            $('.requestCode').click(function () {

            });

            $('#label_password').click(function(){
                $('#txt_pewerwedsdfsdff').focus();
                $('.footer').hide();
            });
             $('#label_account').click(function(){
                $('#txt_asmcdefsddsd').focus();
                $('.footer').hide();
                
            });
             $('#txt_sdertfgsadscxcadsads').bind('focus',function(){
               $('.footer').hide();
             });
             $('#txt_asmcdefsddsd').bind('blur',function(){
                $('.footer').show()
             })

        })
    </script>
</head>
<body>


<div class="info">
    <div class="info-content">
        <p>1.该应用不保留您的账户信息。</p>
        <p>2.应用数据来自文达教务系统。</p>
        <p>3.如果查询失败，可能接口失效了，或者网络阻塞。</p>
        <p>4.反馈QQ群：778399961</p>
        <p>5.青果教务的官方APP喜鹊已经支持文院，如需更好的体验，自行下载。</p>
        <p>5.by：iwh</p>
        <span class="fa fa-close  fa-2x" id="info-close"></span>
    </div>

</div>
<div class="container ">
    <div class="sign_box card ">
        <img class="logo" src="./logo.jpg"/>

        <div class="h4 text-enter">文院成绩助手<span class="fa fa-question-circle-o" id="info"></span></div>
        

        <form name="Logon" method="post" id="Logon" action="./login.php" autocomplete="off">

            <div class=" input-field">

                <i class="fa fa-user-circle prefix"></i>
                <input name="txt_asmcdefsddsd" id="txt_asmcdefsddsd" class=" validate" type="text">
                <label for="name" id="label_account">学号</label>
            </div>
            <div class="input-field">
                <i class="fa fa-eye-slash prefix"></i>
                <label for="name" id="label_password">密码</label>
                <input class="validate" id="txt_pewerwedsdfsdff" name="txt_pewerwedsdfsdff" onblur="chkpwd(this)"
                       onkeyup="chkpwd(this)" type="password" >
            </div>

            <input id="dsdsdsdsdxcxdfgfg" name="dsdsdsdsdxcxdfgfg" type="hidden">
            <input id="fgfggfdgtyuuyyuuckjg" name="fgfggfdgtyuuyyuuckjg" type="hidden">
            <div class="form-group">
                <label for="name">输入验证码</label>
                <input class="form-control" id="txt_sdertfgsadscxcadsads" name="txt_sdertfgsadscxcadsads"
                       onblur="chkyzm(this)" onkeyup="chkyzm(this)">
            </div>
            <div class="form-group">
                <img id="imgCode" src="./getValidate.php" onclick="changeValidateCode(this)" alt="单击可更换图片！"
                     title="点击更换">
            </div>

            <div class="center-align">
                <button class="btn-floating btn-large pulse  waves-effect waves-light center-block loginButton #1e88e5 blue darken-1"
                        type="submit"><span
                            class="fa fa-send-o "></span></button>
            </div>
        </form>
    </div>

</div>

<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="row">

            <div class="col s12 m12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Update</span>
                         <p>v1.2 2019.05.19<br>
                            1.忒坑爹了，学校教务网站又改版。<br>
                            2.适配新版教务系统。。。。
                        <p>v1.2 2019.04.25<br>
                            1.调整UI。<br>
                        <p>v1.1 2019.04.17<br>
                            1.修复错误页面。<br>

                        <p>v1.1 2019.04.13<br>
                            1.更改部分UI为Material设计<br>
                            2.使用易班接口登录。</p>
                    </div>

                </div>
            </div>

            <div class="col s12 m12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">About</span>
                        <p>本应用适用于文达学院青果教务系统，其它学校请移步GitHub自行适配。<br>
                            权限说明：应用通过易班接口获取你的基本信息，仅仅用于查询成绩使用，服务器未保留您的个人信息！<br>
                            如果有建议或者bug返回，点击下方QQ群。</p>
                    </div>
                    <div class="card-action">
                        <a href="//shang.qq.com/wpa/qunwpa?idkey=01e46bf72e74f5448932de00867d071221e4d6263ed4075a8b6e907afd3ef4a3">QQ群：778399961</a>

                    </div>
                </div>
            </div>

            <div class="col s12 m12">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">GitHub</span>
                        <p>本应用源代码以开源：欢迎来访，下方链接即可快速查看！<br>
                            应用使用的开源库：<br>
                            1.Materialize<br>
                            2.jQuery
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="https://github.com/iwh718/QingGuoWD">GitHub：iwh718</a>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<div class="footer">
    <div class="center-align"><a href="#" class="black-text">BY:IWH |文达 |19.04.25</a></div>
</div>
</body>
<script src="./check.js"></script>
<script type="text/javascript" src="./js/materialize.min.js"></script>

</html>