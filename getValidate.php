<?php
session_start();
$t = isset($_GET['t'])?$_GET['t']:0;

/**
 * 获取ViewState
 * @return [type] [description]
 */
function getViewState(){
	$cookieFile = dirname(__FILE__)."/cookie.tmp";
	$ch1 = curl_init();
	$header[]="User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
	$header[]="Cache-Control: max-age=0";   
	$header[]="Referer:http://218.22.58.76:2346/_data/login_home.aspx";
	$header[]="Connection: keep-alive";
	$header[]="Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"; 
	$header[]="Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3";
	$header[]="Host:218.22.58.76:2346";    
	curl_setopt($ch1,CURLOPT_HTTPHEADER,$header);
	curl_setopt($ch1, CURLOPT_URL, "http://218.22.58.76:2346/_data/login_home.aspx");
	curl_setopt($ch1,CURLOPT_VERBOSE,1);
	curl_setopt($ch1,CURLOPT_COOKIEJAR,$cookieFile);
	curl_setopt($ch1, CURLOPT_HEADER,true);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	$filecontent=curl_exec($ch1);
	preg_match('/<input type=\"hidden\" name=\"__VIEWSTATE\" value=\"(.*)\"/iU',$filecontent,$str_view);
	$_SESSION['__VIEWSTATE']=$str_view[1];
	

}

/**
 * 获取验证码
 * @param  [type] $t [description]
 * @return [type]    [description]
 */
function getValidate($t){
	$verify_code_url = "http://218.22.58.76:2346/sys/ValidateCode.aspx?t=".$t;
	$header = [
    'Accept:image/webp,image/apng,image/*,*/*;q=0.8',
    'Accept-Encoding:gzip, deflate',
    'Accept-Language:zh-CN,zh;q=0.8',
    'Cache-Control:no-cache',
    'Connection:keep-alive',
    'Host:218.22.58.76:2346',  
    'Pragma:no-cache',
   	'Referer:http://218.22.58.76:2346/_data/login_home.aspx',
    'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL',
	];
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.tmp");
	curl_setopt($curl,CURLOPT_HTTPHEADER,$header);  
	curl_setopt($curl, CURLOPT_URL, $verify_code_url); 
	$img = curl_exec($curl);
	curl_close($curl);
	echo $img;
}
//获取ViewState与SessionId
getViewState();
//获取验证码
getValidate($t);


?>