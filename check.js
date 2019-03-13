function showvc() {
	$("#imgCode").style.display = "";
}

window.onload = function() {

	try {
		$('txt_asmcdefsddsd').focus();
	} catch (err) {}
	try {
		$('typeName').value = $N('Sel_Type')[0].options[$N('Sel_Type')[0].selectedIndex].text;
	} catch (err) {}
}


function changeValidateCode(Obj) {
	var dt = new Date();
	Obj.src = "./getValidate.php?t=" + dt.getMilliseconds();
}

function chkpwd(obj) {
	if (obj.value != '') {
		var s = md5(document.all.txt_asmcdefsddsd.value + md5(obj.value).substring(0, 30).toUpperCase() + '12810').substring(0, 30).toUpperCase();
		document.all.dsdsdsdsdxcxdfgfg.value = s;
	} else {
		document.all.dsdsdsdsdxcxdfgfg.value = obj.value;
	}
}

function chkyzm(obj) {
	if (obj.value != '') {
		var s = md5(md5(obj.value.toUpperCase()).substring(0, 30).toUpperCase() + '12810').substring(0, 30).toUpperCase();
		document.all.fgfggfdgtyuuyyuuckjg.value = s;
	} else {
		document.all.fgfggfdgtyuuyyuuckjg.value = obj.value.toUpperCase();
	}
}