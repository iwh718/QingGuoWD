
<?php

/**
 * 青果教务系统登录
 * @author IWH 2868579699@qq.com
 *  
 **/

error_reporting(0);
session_start();
require('./SHDM/simple_html_dom.php');
header("Content-type:text/html;charset=utf-8");
 

/**
 * 登录函数
 * @param String $loginUrl 登录链接
 * @param String $__VIWESTATE  DOM状态值
  */
 
 function Login($loginUrl = 'http://218.22.58.76:2346/_data/login_new.aspx'){
   

$referer="http://218.22.58.76:2346/_data/login_new.aspx";
$pcInfo="Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";        
$data = array (
    'fgfggfdgtyuuyyuuckjg'=>$_POST['fgfggfdgtyuuyyuuckjg'],
    'dsdsdsdsdxcxdfgfg'=> $_POST['dsdsdsdsdxcxdfgfg'],
    'txt_asmcdefsddsd' => $_POST['txt_asmcdefsddsd'], 
    'txt_pewerwedsdfsdff' => '',
    'txt_sdertfgsadscxcadsads'=>'',
    'typeName' => iconv( "UTF-8", "gb2312//IGNORE","学生"),
    'sbtState'=>'',
    'Sel_Type'=>'STU',
    'pcInfo'=>$pcInfo,
    '__VIEWSTATE'=>$_SESSION['__VIEWSTATE']
); 

$data = http_build_query($data);
$header=array();
$header[]="User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
$header[]="Host:218.22.58.76:2346";
$header[] = "Content-Type: application/x-www-form-urlencoded";
$header[] = "Referer: http://218.22.58.76:2346/_data/login_new.aspx";
$header[] = "Origin: http://218.22.58.76:2346";
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $loginUrl); 
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);//设置请求头，青果会通过请求头来验证请求是否为爬虫
curl_setopt ($ch, CURLOPT_POST, 1 );//请求方式为post
curl_setopt($ch, CURLOPT_HEADER, true); //返回结果带头信息
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER,true);
curl_setopt($ch, CURLOPT_TIMEOUT,30); 
curl_setopt($ch, CURLOPT_COOKIE, $_SESSION['cookie']); //带上sessionCookie值
curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );//写入post信息
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
//写入文件，检查是否登录成功
$result=curl_exec($ch);
$file = dirname(__FILE__)."/result.html";
$fp = fopen($file,"w");
fwrite($fp,$result);
fwrite($fp, '结束');
fclose($fp);
$result = iconv('gbk', 'utf-8', $result);
$nums=substr_count($result,"验证码错误");
$nums2 = substr_count($result,"帐号已被锁定");
$nums3 = substr_count($result,"帐号或密码不正确");
if($nums >=1 ){
   echo 
   "<script>
   alert('验证码错误！！');
   location.href = './WdClass.php';
   </script>";
  die();
}elseif($nums2 >=1){
   echo 
   "<script>
   alert('iwh提示：由于你的账号或密码多次输入错误，已被锁定，去文鼎楼处理吧！');
    location.href = './WdClass.php';
   </script>";
  die();
}elseif($nums3 >=1){
    echo 
   "<script>
   alert('iwh温馨提示：账号或者密码错误，请不要超过三次！');
    location.href = './WdClass.php';
   </script>";
  die();
}


}

/**
 * 获取成绩
 * @param String $scoresUrl 查询分数url 
 * @return Array 返回分数数组
 */
function getScores($scoresUrl = "http://218.22.58.76:2346/xscj/Stu_cjfb_rpt.aspx"){
$dom = new simple_html_dom(); //new simple_html_dom对象
$dataScore = array (
    'SelXNXQ'=>'0',
    'submit'=> iconv( "UTF-8", "gb2312//IGNORE","检索"),
   
); 


$headerScore[]="User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
$headerScore[]="Host:218.22.58.76:2346";
$headerScore[] = "Content-Type: application/x-www-form-urlencoded";
$headerScore[] = "Referer: http://218.22.58.76:2346/xscj/Stu_cjfb.aspx";
$headerScore[] = "Origin: http://218.22.58.76:2346";
$dataScore[] = http_build_query($dataScore);
$chScore = curl_init(); 
curl_setopt($chScore, CURLOPT_URL, $scoresUrl); 
curl_setopt($chScore,CURLOPT_HTTPHEADER,$headerScore);//设置请求头，青果会通过请求头来验证请求是否为爬虫
curl_setopt ($chScore, CURLOPT_POST, 1 );//请求方式为post
curl_setopt($chScore, CURLOPT_HEADER, false); //返回结果带头信息
curl_setopt($chScore, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chScore, CURLOPT_TIMEOUT,30); 
curl_setopt($chScore, CURLOPT_COOKIE, $_SESSION['cookie']); //带上session值
curl_setopt ($chScore, CURLOPT_POSTFIELDS, $dataScore );//写入post信息
curl_setopt($chScore, CURLOPT_FOLLOWLOCATION,1); 

$resultScore=curl_exec($chScore);
$resultScore = iconv('gbk', 'utf-8', $resultScore);
$fileScore = dirname(__FILE__)."/resultScore.html";
$fpScore = fopen($fileScore,"w");
fwrite($fpScore,$resultScore);
fwrite($fpScore, 'ScoresOver');
fclose($fpScore);

$dom->load($resultScore);
$scoresList = $dom->find('#ID_Table',0);
$scoresArray;
$_SESSION['maxBad']  = 0;
foreach ($scoresList->find('tr') as $keyOuter => $valueOuter) {
        //获取历史成绩
        $scoresArray[] = array(
          'semester'=>$valueOuter->find('td',0)->plaintext,
          'course'=> preg_replace('/\[.*?\]/',"",$valueOuter->find('td',1)->plaintext),
          'credits'=> $valueOuter->find('td',2)->plaintext,
          'course_type'=> $valueOuter->find('td',3)->plaintext,
          'exam_type'=> $valueOuter->find('td',4)->plaintext,
          'scores'=> $valueOuter->find('td',11)->innertext
          
        );
        //检测一共挂了多少科目
        if((int)($valueOuter->find('td',11)->innertext) < 60 ){
          ++$_SESSION['maxBad'];
        }

    }
   //echo  $_SESSION['maxBad'];
    //die();

array_splice($scoresArray, count($scoresArray)-2, 2);
$_SESSION['maxBad'] -= 2;
return $scoresArray;

}

/**
 * 输出成绩表单
 * @return [type] [description]
 */
function echoScores($scoresArray){
$note = "";
if($_SESSION['maxBad'] == 0){
  $note = "你很优秀啊，目前没有挂科哦！";
}elseif($_SESSION['maxBad'] <=3){
  $note  = "注意补考哦，再接再厉！";
}elseif($_SESSION['maxBad'] >=4){
  $note = "同学，该关注关注学业啦！";
}


  print <<< SCORE
<html><head>
    <title>一键查成绩</title>
      <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
       <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
       <script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.js"></script>
     <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet"> 
      <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
  <div class="">
<table class="table table-bordered table-condensed">
  <caption class="text-center">入学以来成绩<br>你一共挂了 {$_SESSION['maxBad']} 个课程,{$note} &nbsp;&nbsp;<span class='fa fa-times-circle-o fa-2x' onclick="location.href = './WdClass.php';"></span></caption>
  <thead>
    <tr>
      <th>学期</th>
      <th>课程</th>
      <th>学分</th>
      <th>类别</th>
      <th>方式</th>
      <th>成绩</th>
    </tr>
  </thead>
  <tbody>
SCORE;
   foreach ($scoresArray as $element=> $value) {
print <<<TRS
 <tr>
      <td style="max-width:100px;min-width:80px;word-break: keep-all;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">{$value['semester']}</td>
      <td title="{$value['course']}" style="max-width:100px;min-width:90px;word-break: keep-all;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">{$value['course']}</td>
      <td>{$value['credits']}</td>
      <td style="max-width:50px;min-width:50px;word-break: keep-all;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">{$value['course_type']}</td>
      <td>{$value['exam_type']}</td>
      <td>{$value['scores']}</td>
    </tr>
TRS;
}

print <<<SCORE2
  </tbody>
</table>
</div>
</body>
</html>
SCORE2;


}


//Cookie
$cookie=$_SESSION['cookie']; 
//DOM状态值
$__VIEWSTATE=$_SESSION['__VIEWSTATE'];
//调用登录
Login();
//输出成绩
echoScores(getScores());







?>
