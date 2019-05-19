
function ChkValue(){
 var vU=$('UID').innerHTML;
 vU=vU.substring(0,1)+vU.substring(2,3);
 var vcFlag = "YES"; if ($('txt_asmcdefsddsd').value==''){
 alert('须录入'+vU+'！');$('txt_asmcdefsddsd').focus();return false;
}
 else if ($('txt_pewerwedsdfsdff').value==''){
 alert('须录入密码！');$('txt_pewerwedsdfsdff').focus();return false;
}
 else if ($('txt_sdertfgsadscxcadsads').value=='' && vcFlag == "YES"){
 alert('须录入验证码！');$('txt_sdertfgsadscxcadsads').focus();return false;
}
 else { $('divLogNote').innerHTML='<font color="red">正在通过身份验证...请稍候!</font>';
   document.getElementById("txt_pewerwedsdfsdff").value = '';
 document.getElementById("txt_sdertfgsadscxcadsads").value = ''; 
 return true;}
 }
function SelType(obj){
 var s=obj.options[obj.selectedIndex].getAttribute('usrID');
 $('UID').innerHTML=s;
 selTyeName();
}
function openWinLog(theURL,w,h){
var Tform,retStr;
eval("Tform='width="+w+",height="+h+",scrollbars=no,resizable=no'");
 if(theURL.indexOf('ReSet_PassWord.aspx')>-1) {
 parent.doMobileReset(); } else {
pop=window.open(theURL,'winKPT',Tform); //pop.moveTo(0,75);
eval("Tform='dialogWidth:"+w+"px;dialogHeight:"+h+"px;status:no;scrollbars=no;help:no'");
pop.moveTo((screen.width-w)/2,(screen.height-h)/2);if(typeof(retStr)!='undefined') alert(retStr);
}
}
function showLay(divId){
var objDiv = eval(divId);
if (objDiv.style.display=="none")
{objDiv.style.display="";}
else{objDiv.style.display="none";}
}
function selTyeName(){
  $('typeName').value=$N('Sel_Type')[0].options[$N('Sel_Type')[0].selectedIndex].text;
}
window.onload=function(){
  var sPC=MSIE?window.navigator.userAgent+window.navigator.cpuClass+window.navigator.appMinorVersion+' SN:NULL':window.navigator.userAgent+window.navigator.oscpu+window.navigator.appVersion+' SN:NULL';
try{$('pcInfo').value=sPC;}catch(err){}
try{$('txt_asmcdefsddsd').focus();}catch(err){}
try{$('typeName').value=$N('Sel_Type')[0].options[$N('Sel_Type')[0].selectedIndex].text;}catch(err){}
}
function openWinDialog(url,scr,w,h)
{
var Tform;
eval("Tform='dialogWidth:"+w+"px;dialogHeight:"+h+"px;status:"+scr+";scrollbars=no;help:no'");
window.showModalDialog(url,1,Tform);
}
function openWin(theURL){
var Tform,w,h;
try{
  w=window.screen.width-10;
}catch(e){}
try{
h=window.screen.height-30;
}catch(e){}
try{eval("Tform='width="+w+",height="+h+",scrollbars=no,status=no,resizable=yes'");
pop=parent.window.open(theURL,'',Tform);
pop.moveTo(0,0);
parent.opener=null;
parent.close();}catch(e){}
}
function changeValidateCode(Obj){
var dt = new Date();
Obj.src="../sys/ValidateCode.aspx?t="+dt.getMilliseconds();
}
function chkpwd(obj) {  if(obj.value!='')  {    var s=md5(document.all.txt_asmcdefsddsd.value+md5(obj.value).substring(0,30).toUpperCase()+'12810').substring(0,30).toUpperCase();   document.all.dsdsdsdsdxcxdfgfg.value=s;} else { document.all.dsdsdsdsdxcxdfgfg.value=obj.value;}chkLxstr(obj.value); }  function chkyzm(obj) {  if(obj.value!='') {   var s=md5(md5(obj.value.toUpperCase()).substring(0,30).toUpperCase()+'12810').substring(0,30).toUpperCase();   document.all.fgfggfdgtyuuyyuuckjg.value=s;} else {    document.all.fgfggfdgtyuuyyuuckjg.value=obj.value.toUpperCase();}} function chkLxstr(str) 
 {
 if (str!='') { var arr = str.split('');
for (var i = 1; i < arr.length-1; i++) {
   var firstIndex = arr[i-1].charCodeAt();
   var secondIndex = arr[i].charCodeAt();
   var thirdIndex = arr[i+1].charCodeAt();
   thirdIndex - secondIndex == 1;
    secondIndex - firstIndex==1;
   if(((thirdIndex - secondIndex == 1)&&(secondIndex - firstIndex==1) ) || (thirdIndex==secondIndex && secondIndex==firstIndex)){
      document.getElementById('txt_mm_lxpd').value='1'; 
   }
 }
 }
}
