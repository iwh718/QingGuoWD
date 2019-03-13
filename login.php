
<?php
error_reporting(0);
session_start();
require('./SHDM/simple_html_dom.php');
header("Content-type:text/html;charset=utf-8");
$dom = new simple_html_dom(); //new simple_html_dom对象                            
   // $dom->load($content);  //加载html  
   // $formNode =  $dom->find('form[name=form1]',0);
$cookie=$_SESSION['cookie']; 
$VIEWSTATE = $_SESSION['__VIEWSTATE'];
//首先去登录页面获取viewState，注意是表单提交的url，不少青果登录首页那个url！
$url = 'http://218.22.58.76:2346/_data/login_new.aspx';
$referer="http://218.22.58.76:2346/_data/login_new.aspx";
$pcInfo="Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
$__VIEWSTATE=$_SESSION['__VIEWSTATE'];
        
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
    '__VIEWSTATE'=>$__VIEWSTATE
); 


$data = http_build_query($data);
$header=array();
$header[]="User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0Windows NT 10.0; WOW645.0 (Windows) SN:NULL";
$header[]="Host:218.22.58.76:2346";
$header[] = "Content-Type: application/x-www-form-urlencoded";
$header[] = "Referer: http://218.22.58.76:2346/_data/login_new.aspx";
$header[] = "Origin: http://218.22.58.76:2346";
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $referer); 
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);//设置请求头，青果会通过请求头来验证请求是否为爬虫
curl_setopt ($ch, CURLOPT_POST, 1 );//请求方式为post
curl_setopt($ch, CURLOPT_HEADER, true); //返回结果带头信息
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER,true);
curl_setopt($ch, CURLOPT_TIMEOUT,30); 
curl_setopt($ch, CURLOPT_COOKIE, $cookie); //带上session值
curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );//写入post信息
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 

$result=curl_exec($ch);
$file = dirname(__FILE__)."/result.html";
$fp = fopen($file,"w");
fwrite($fp,$result);
fwrite($fp, '结束');
fclose($fp);


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
$headerScoreUrl = "http://218.22.58.76:2346/xscj/Stu_cjfb_rpt.aspx";
$chScore = curl_init(); 
curl_setopt($chScore, CURLOPT_URL, $headerScoreUrl); 
curl_setopt($chScore,CURLOPT_HTTPHEADER,$headerScore);//设置请求头，青果会通过请求头来验证请求是否为爬虫
curl_setopt ($chScore, CURLOPT_POST, 1 );//请求方式为post
curl_setopt($chScore, CURLOPT_HEADER, false); //返回结果带头信息
curl_setopt($chScore, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chScore, CURLOPT_TIMEOUT,30); 
curl_setopt($chScore, CURLOPT_COOKIE, $cookie); //带上session值
curl_setopt ($chScore, CURLOPT_POSTFIELDS, $dataScore );//写入post信息
curl_setopt($chScore, CURLOPT_FOLLOWLOCATION,1); 

$resultScore=curl_exec($chScore);
$resultScore = iconv('gbk', 'utf-8', $resultScore);
//$fileScore = dirname(__FILE__)."/resultScore.html";
//$fpScore = fopen($fileScore,"w");
//fwrite($fpScore,$resultScore);
//fwrite($fpScore, 'ScoresOver');
//fclose($fpScore);

$dom->load($resultScore);
$scoresList = $dom->find('#ID_Table',0);
$scoresArray;
foreach ($scoresList->find('tr') as $keyOuter => $valueOuter) {
    		//获取单本图书数据
    		$scoresArray[] = array(
    			'semester'=>$valueOuter->find('td',0)->plaintext,
    			'course'=> preg_replace('/\[.*?\]/',"",$valueOuter->find('td',1)->plaintext),
    			'credits'=> $valueOuter->find('td',2)->plaintext,
    			'course_type'=> $valueOuter->find('td',3)->plaintext,
    			'exam_type'=> $valueOuter->find('td',4)->plaintext,
    			'scores'=> $valueOuter->find('td',11)->innertext
    			
    		);

    }

array_splice($scoresArray, count($scoresArray)-2, 2);
 // print_r($scoresArray);
print <<< SCORE
<html><head>
		<title>一键查成绩</title>
			<meta charset="utf-8">
		 <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	     <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	     <script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.js"></script>
		 <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet">	

	</head>
	<body>
	<div class="">
<table class="table table-bordered table-condensed">
  <caption class="text-center">入学以来成绩</caption>
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
?>
