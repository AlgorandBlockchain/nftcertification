

function getHTTPObject() {
  var xmlhttp;
  if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  else if (window.ActiveXObject){
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
    if (!xmlhttp){
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
}
  return xmlhttp;
}
var http = getHTTPObject(); // We create the HTTP Object
/*
  Funtion Name=requestInfo
  Param = url >> Url to call : id = Passing div id for multiple use ~ as a seprator for eg. div1~div2 :
  redirectPage >> if you like to redirect to other page once the event success then
  the response text = 1 and the redirectPage not left empty
*/
    function requestInfo(url,id,redirectPage) {
    var temp=new Array();
      http.open("GET", url, true);
      http.onreadystatechange = function() {
        if (http.readyState == 4) {
          if(http.status==200) {
            var results=http.responseText;
          if(redirectPage=="" || results!="1") {
            var temp=id.split("~"); // To display on multiple div
            //alert(temp.length);
            var r=results.split("~"); // To display multiple data into the div
            //alert(temp.length);
            if(temp.length>1) {
              for(i=0;i<temp.length;i++) {
                //alert(temp[i]);
                document.getElementById(temp[i]).innerHTML=r[i];
              }
            } else {
              document.getElementById(id).innerHTML = results;
            }
          } else {
            //alert(results);
            window.location.href=redirectPage;
          }
          }
          }
      };
      http.send(null);
       }


function emptyValidation(fieldList) {



    var field=new Array();

    field=fieldList.split("~");

    var counter=0;

    for(i=0;i<field.length;i++) {

      if(document.getElementById(field[i]).value=="") {

        document.getElementById(field[i]).style.backgroundColor="#FF0000";

        counter++;

      } else {

        document.getElementById(field[i]).style.backgroundColor="#FFFFFF";

      }

    }

    if(counter>0) {

        alert("The Field mark as red could not left empty");

        return false;



    }  else {

      return true;

    }



}




  var x = 1;

  var xy = 1;




function buatajax(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}


var ajaxRequest;
function getAjax() //fungsi untuk mengecek AJAX pada browser
{
  try
  {
    ajaxRequest = new XMLHttpRequest();
  }
  catch (e)
  {
    try
    {
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
      try
      {
        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e)
      {
        alert("Your browser broke!");
        return false;
      }
    }

  }

}


function getStateY(country_id) //fungsi menangkap input search dan menampilkan hasil search
{

			getAjax();
      //document.getElementById("hasil-state").innerHTML = '';
      document.getElementById("hasil-city").innerHTML = '<select class="chosen-select form-control" name="kota" id="kota" data-placeholder="Choose a city..."><option value=""></option></select>';
      ajaxRequest.open("GET","gate_state?country_id="+country_id);
      ajaxRequest.onreadystatechange = function()
      {
        document.getElementById("hasil-state").innerHTML = ajaxRequest.responseText;
        //document.getElementById("provinsi").html(ajaxRequest.responseText);
      }
      ajaxRequest.send(null);

}

function getCityY(region_id) //fungsi menangkap input search dan menampilkan hasil search
{

			getAjax();
      country_id = document.getElementById("warga_negara").value;
      //document.getElementById("hasil-state").innerHTML = '';
      ajaxRequest.open("GET","gate_city?country_id="+country_id+"&region_id="+region_id);
      ajaxRequest.onreadystatechange = function()
      {
        document.getElementById("hasil-city").innerHTML = ajaxRequest.responseText;
        //document.getElementById("provinsi").html(ajaxRequest.responseText);
      }
      ajaxRequest.send(null);

}

function autokeahlian() //fungsi menangkap input search dan menampilkan hasil search
{
    getAjax();
    input = document.getElementById('skill').value;
    if (input == "")
    {
      document.getElementById("hasilx").innerHTML = "";
    }
    else
    {
      ajaxRequest.open("GET","searchskill?input="+input);
      ajaxRequest.onreadystatechange = function()
      {
        document.getElementById("hasilx").innerHTML = ajaxRequest.responseText;
      }
      ajaxRequest.send(null);
    }
}

function autoInsertSkill(skill)
{
  document.getElementById("hasilx").innerHTML = "";
  document.getElementById("skill").value = skill;
}
