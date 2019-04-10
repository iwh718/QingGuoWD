<html>
<head>
    <title>文院一键查成绩</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./md5.js"></script>
    <script src="./check.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        .sign_box {

            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            background: #fff;
        }

        body {
            background: #fff;

        }

        .loginButton {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
        }

        .form-group, .form-control, input {
            border-radius: 0 !important;
            border-top: none;
            border-left: none;
            box-shadow: none;
            border-right: none;
        }

        .form-control:focus {
            border-color: #66afe9;
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


    </style>
    <script type="text/javascript">


        $(function () {
            $('#info').click(function () {
                $('.info').show(300);
            });
            $('#info-close').click(function () {
                $('.info').hide(300);
            });

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
        <p>5.by：iwh</p>
        <span class="fa fa-close  fa-2x" id="info-close"></span>
    </div>

</div>
<div class="container">
    <div class="sign_box ">
        <img class="logo" src="./logo.jpg"/>

        <div class="h4 text-enter">文达学院一键查成绩 <span class="fa fa-question-circle-o" id="info"></span></div>
        <!---->
        <form name="Logon" method="post" id="Logon" action="./login.php" autocomplete="off">
            <div class="form-group">
                <label for="name">学号</label>
                <input name="txt_asmcdefsddsd" id="txt_asmcdefsddsd" class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="name">密码</label>
                <input class="form-control" id="txt_pewerwedsdfsdff" name="txt_pewerwedsdfsdff" onblur="chkpwd(this)"
                       onkeyup="chkpwd(this)" type="password">
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

            <div class="form-group">
                <button class="btn btn-primary center-block loginButton" type="submit"><span
                            class="fa fa-chevron-right"></span></button>
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