var ajaxku;
function ajaxkota(id){
ajaxku = buatajax();
var url="select_kota";
url=url+"?q="+id;
url=url+"&sid="+Math.random();
ajaxku.onreadystatechange=stateChanged;
ajaxku.open("GET",url,true);
ajaxku.send(null);
}

function ajaxkec(id){
ajaxku = buatajax();
var prop = document.getElementById('prop').value;
var url="select_kota";
url=url+"?kec="+id;
url=url+"&prop="+prop;
url=url+"&sid="+Math.random();
ajaxku.onreadystatechange=stateChangedKec;
ajaxku.open("GET",url,true);
ajaxku.send(null);
}

function ajaxkel(id){
ajaxku = buatajax();
var prop = document.getElementById('prop').value;
var kota = document.getElementById('kota').value;
var url="select_kota";
url=url+"?kel="+id;
url=url+"&prop="+prop;
url=url+"&kec="+kota;
url=url+"&sid="+Math.random();
ajaxku.onreadystatechange=stateChangedKel;
ajaxku.open("GET",url,true);
ajaxku.send(null);
}

function buatajax(){
if (window.XMLHttpRequest){
return new XMLHttpRequest();
}
if (window.ActiveXObject){
return new ActiveXObject("Microsoft.XMLHTTP");
}
return null;
}
function stateChanged(){
var data;
if (ajaxku.readyState==4){
data=ajaxku.responseText;
if(data.length>=0){
document.getElementById("kota").innerHTML = data
document.getElementById("kec").innerHTML = "";
document.getElementById("kel").innerHTML = "";
document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
}else{
document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";

}
}
}

function stateChangedKec(){
var data;
if (ajaxku.readyState==4){
data=ajaxku.responseText;
if(data.length>=0){
document.getElementById("kec").innerHTML = data
document.getElementById("kel").innerHTML = "";
document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
}else{
document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
}
}
}

function stateChangedKel(){
var data;
if (ajaxku.readyState==4){
data=ajaxku.responseText;
if(data.length>=0){
document.getElementById("kel").innerHTML = data
}else{
document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
}
}
}
