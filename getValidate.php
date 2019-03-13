<?php
session_start();
$ch1 = curl_init();
$header[]="User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
$header[]="Cache-Control: max-age=0";   
$header[]="Connection: keep-alive";
$header[]="Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
$header[]="Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3";
$header[]="Host:218.22.58.76:2346";    
curl_setopt($ch1,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch1, CURLOPT_URL, "http://218.22.58.76:2346/_data/login_new.aspx");
curl_setopt($ch1,CURLOPT_VERBOSE,1);
curl_setopt($ch1, CURLOPT_HEADER,true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
$filecontent=curl_exec($ch1);
preg_match('/Set-Cookie:(.*);/iU',$filecontent,$str_cookie); //正则匹配
$cookie = $str_cookie[1]; //获得COOKIE（SESSIONID）
$_SESSION['cookie']=$cookie;
preg_match('/<input type=\"hidden\" name=\"__VIEWSTATE\" value=\"(.*)\"/iU',$filecontent,$str_view);
$_SESSION['__VIEWSTATE']=$str_view[1];

$cookie = $_SESSION['cookie'];

$t = isset($_GET['t'])?$_GET['t']:0;
$verify_code_url = "http://218.22.58.76:2346/sys/ValidateCode.aspx?t=".$t;

//不用纠结那条需要不需要，直接header都写上是不会错的
$header = [
    'Accept:image/webp,image/apng,image/*,*/*;q=0.8',
    'Accept-Encoding:gzip, deflate',
    'Accept-Language:zh-CN,zh;q=0.8',
    'Cache-Control:no-cache',
    'Connection:keep-alive',
    'Host:218.22.58.76:2346',  //修改名称
    'Pragma:no-cache',
    'Referer:http://218.22.58.76:2346/_data/home_login.aspx',//修改名称
    'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL',
];
$curl = curl_init();
curl_setopt($curl,CURLOPT_COOKIE,$cookie);
curl_setopt($curl,CURLOPT_HTTPHEADER,$header);  //设置表头
curl_setopt($curl, CURLOPT_URL, $verify_code_url); // 设置请求地址
$img = curl_exec($curl);
curl_close($curl);
echo $img;


?>