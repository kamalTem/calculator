<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">
<head>
<meta name="robots" content="all" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Калькулятор" />
<meta name="keywords" content="Калькулятор" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<!--<script src="aerostoneСalculator.js"></script>-->
<script src="validation.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<script>
$(document).ready(function() {   
   $("table.calc1").on("keyup", "input", function(){
      console.log($(this).val().slice(-1));
      if($(this).val().slice(-1) == ','){
        var text = $(this).val(); 
        text = text.slice(0, text.length - 1);
        $(this).val(text + '.');
      }  
   })
});

// JavaScript Document
minpal=1;
mpal=1.8;
time=1000;

canorder = false;

/*function kH(e) {  
  var pK = e ? e.which : window.event.keyCode;  
  return pK != 13;  
}

document.onk eypress = kH;  
if (document.layers) document.captureEvents(Event.KEYPRESS);  
*/
 
function number_format(_number, _cfg){
  function obj_merge(obj_first, obj_second){
    var obj_return = {};
    for (key in obj_first){
      if (typeof obj_second[key] !== 'undefined') obj_return[key] = obj_second[key];
      else obj_return[key] = obj_first[key];
    }
    return obj_return;
  }
  
  function thousands_sep(_num, _sep){
    if (_num.length <= 3) return _num;
    var _count = _num.length;
    var _num_parser = '';
    var _count_digits = 0;
    for (var _p = (_count - 1); _p >= 0; _p--){
      var _num_digit = _num.substr(_p, 1);
      if (_count_digits % 3 == 0 && _count_digits != 0 && !isNaN(parseFloat(_num_digit))) _num_parser = _sep + _num_parser;
      _num_parser = _num_digit + _num_parser;
      _count_digits++;
    }
    return _num_parser;
  }
  
  if (typeof _number !== 'number'){
    _number = parseFloat(_number);
    if (isNaN(_number)) return "";
  }
  var _cfg_default = {before: '', after: '', decimals: 2, dec_point: '.', thousands_sep: ','};
  if (_cfg && typeof _cfg === 'object'){
    _cfg = obj_merge(_cfg_default, _cfg);
  }
  else _cfg = _cfg_default;
  _number = _number.toFixed(_cfg.decimals);
  if(_number.indexOf('.') != -1){
    var _number_arr = _number.split('.');
    var _number = thousands_sep(_number_arr[0], _cfg.thousands_sep) + _cfg.dec_point + _number_arr[1];
  }
  else var _number = thousands_sep(_number, _cfg.thousands_sep);
  return _cfg.before + _number + _cfg.after;
}


function checkNum(val)
{
  var n;
  n = parseInt(val/10);
  if ((isNaN(n)) || (val <= 0) || (val=="")) return false;
  else return true;
}

function bask_refresh(id) {
$('#refr'+id).fadeIn();

}

function ChangeQual(price,id,pal1,inpal) {
  $("#quant"+id).everyTime(time, 'timer2', function(i) {
    newQ=document.getElementById("quant"+id).value;
  if (checkNum(newQ)) {
        newP=Math.ceil(newQ/pal1);
        newV=newP*inpal;
  newQ=newP*pal1;
  newPrice=newV*price;
  }
  else {
    newV="-";
    newP="-";
    newPrice="-";
  }
    bask_refresh(id);
  document.getElementById("quant"+id).value=number_format(newQ, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("vol"+id).value=number_format(newV, {thousands_sep: "", dec_point: ".", decimals: 3});
        document.getElementById("pal"+id).value=number_format(newP, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});



}, 1);

}

function TimerPause(id) {
  $("#quant"+id).stopTime('timer2');
}

function ChangeQual1(price,id) {

  $("#mixq"+id).everyTime(time, 'timer2', function(i) {
  newQ=document.getElementById("mixq"+id).value;
  if (checkNum(newQ)) {
      newQ=Math.ceil(newQ);
      newPrice=newQ*price;
  }
  else {
      newPrice="-";
  }
bask_refresh(id); 
document.getElementById("mixq"+id).value=number_format(newQ, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});
        
  }, 1);  
}

function ChangeVol(price,id,pal1,inpal) {
  
  $("#vol"+id).everyTime(time, 'timer2', function(i) {
  newV=document.getElementById("vol"+id).value;
  if (checkNum(newV)) {
    newP=Math.ceil(newV/inpal);
    newV=newP*inpal;
    newQ=newP*pal1;
    newPrice=newV*price;
  }
  else {
    newQ="-";
    newP="-";
    newPrice="-";
  }
  bask_refresh(id);
  document.getElementById("quant"+id).value=number_format(newQ, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("vol"+id).value=number_format(newV, {thousands_sep: "", dec_point: ".", decimals: 3});
    document.getElementById("pal"+id).value=number_format(newP, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});

  }, 1);
}

function ChangePal(price,id,pal1,inpal) {
  $("#pal"+id).everyTime(time, 'timer2', function(i) {
  newP=document.getElementById("pal"+id).value;
  if (checkNum(newP)) {
    newP=Math.ceil(newP);
    newV=newP*inpal;
    newQ=newP*pal1;
    newPrice=newV*price;
  }
  else {
    newV="-";
    newQ="-";
    newPrice="-";
  }
  bask_refresh(id);
  document.getElementById("quant"+id).value=number_format(newQ, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("vol"+id).value=number_format(newV, {thousands_sep: "", dec_point: ".", decimals: 3});
        document.getElementById("pal"+id).value=number_format(newP, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});


  }, 1);
}


function ChangeVol2(price,id) {
  
  $("#vol"+id).everyTime(time, 'timer2', function(i) {
  newV=document.getElementById("vol"+id).value;
  if (checkNum(newV)) {
    newP=Math.ceil(newV/mpal);
    newV=newP*mpal;
    newPrice=newV*price;
  }
  else {
    newP="-";
    newPrice="-";
  }
  bask_refresh(id);
  document.getElementById("vol"+id).value=number_format(newV, {thousands_sep: "", dec_point: "."});
        document.getElementById("pal"+id).value=number_format(newP, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});

  }, 1);
}

function ChangePal2(price,id) {
  $("#pal"+id).everyTime(time, 'timer2', function(i) {
  newP=document.getElementById("pal"+id).value;
  if (checkNum(newP)) {
    newP=Math.ceil(newP);
    newV=newP*mpal;
    newPrice=newV*price;
  }
  else {
    newV="-";
    newPrice="-";
  }
  bask_refresh(id);
  document.getElementById("vol"+id).value=number_format(newV, {thousands_sep: "", dec_point: "."});
        document.getElementById("pal"+id).value=number_format(newP, {thousands_sep: "", dec_point: ".", decimals: 0});
  document.getElementById("price"+id).innerHTML=number_format(newPrice, {thousands_sep: " ", dec_point: "."});

  }, 1);
}



$(document).ready(function(){

$("#calcstart").click(function(){
   if(!jQuery.browser.msie) {
     jQuery("body").append("<div id='overcalc'></div>");
     $('#overcalc').fadeIn();
     $('#calc').fadeIn(); }
    else {
      jQuery("body").append("<div id='overcalc' st yle='display:block;'></div>");
      $('#calc').fadeIn(); } 
   });

$(".calcstart").click(function(){
   if(!jQuery.browser.msie) {
     jQuery("body").append("<div id='overcalc'></div>");
     $('#overcalc').fadeIn();
     $('#calc').fadeIn(); }
    else {
      jQuery("body").append("<div id='overcalc' st yle='display:block;'></div>");
      $('#calc').fadeIn(); } 
   });

$("#calcstop").click(function(){
   $("table#result_info").css('display','table');
   $("table#client_info").css('display','none');
   if(!jQuery.browser.msie) {
     $('#overcalc').fadeOut();
     $('#calc').fadeOut(); }
   else {
     $('#calc').fadeOut();
     $("#overcalc").remove();
   }
   });

$("#calc_order").click(function(){
 if(!canorder) {
   alert("Заполните поля для расчёта.");
   return;
 }
 $("table#result_info").css('display','none');
 $("table#client_info").css('display','table');
});

$("#send_order").click(function(){

  post_object = {};
  $('div#calc input').each(function(k,v){
    post_object[$(this).attr('name')] = $(this).val();
  });

 if(post_object['f_name'].length == 0 || post_object['f_phone'].length == 0 || post_object['f_adres'].length == 0) {
  alert('Поля отмеченые "*" обязательны для заполнения.');
  return;
 }

 post_object['dim'] = $('select#dim option:selected').text();
 post_object['f_additional'] = $('textarea[name=f_additional]').val();
 $.post("/mail.php", {'result' : JSON.stringify(post_object) }).done(function(data) {
  alert("Спасибо! Ваша заявка принята. В ближайшее время для уточнения деталей с Вами свяжется менеджер AeroStone.");
 });
        $("table#result_info").css('display','block');
        $("table#client_info").css('display','none');
 
});
               
$("#count").click(function(){
  canorder = true;

        $("table#result_info").css('display','block');
        $("table#client_info").css('display','none');
  $("#calc_order").css('border-color','#ff5d00');

  var blocks=new Array();
  blocks[1]=new Array();  blocks[1]["l"]=600; blocks[1]["h"]=250; blocks[1]["d"]=500; 
  blocks[2]=new Array();  blocks[2]["l"]=600; blocks[2]["h"]=250; blocks[2]["d"]=375; 
  blocks[3]=new Array();  blocks[3]["l"]=600; blocks[3]["h"]=250; blocks[3]["d"]=300; 
  blocks[4]=new Array();  blocks[4]["l"]=600; blocks[4]["h"]=250; blocks[4]["d"]=250; 
  blocks[5]=new Array();  blocks[5]["l"]=600; blocks[5]["h"]=200; blocks[5]["d"]=500; 
  blocks[6]=new Array();  blocks[6]["l"]=600; blocks[6]["h"]=200; blocks[6]["d"]=375; 
  blocks[7]=new Array();  blocks[7]["l"]=600; blocks[7]["h"]=200; blocks[7]["d"]=300; 
  blocks[8]=new Array();  blocks[8]["l"]=600; blocks[8]["h"]=200; blocks[8]["d"]=250; 
  blocks[9]=new Array();  blocks[9]["l"]=600; blocks[9]["h"]=200; blocks[9]["d"]=150; 
  blocks[10]=new Array(); blocks[10]["l"]=600;  blocks[10]["h"]=250;  blocks[10]["d"]=100; 
  //blocks[11]=new Array(); blocks[11]["l"]=600;  blocks[11]["h"]=250;  blocks[11]["d"]=75; 
  blocks[12]=new Array(); blocks[12]["l"]=600;  blocks[12]["h"]=250;  blocks[12]["d"]=150; 
  blocks[13]=new Array(); blocks[13]["l"]=600;  blocks[13]["h"]=200;  blocks[13]["d"]=100; 
  //blocks[14]=new Array(); blocks[14]["l"]=600;  blocks[14]["h"]=200;  blocks[14]["d"]=75; 

  blocks[15]=new Array(); blocks[15]["l"]=625;  blocks[15]["h"]=250;  blocks[15]["d"]=500; 
  blocks[16]=new Array(); blocks[16]["l"]=625;  blocks[16]["h"]=250;  blocks[16]["d"]=375; 
  blocks[17]=new Array(); blocks[17]["l"]=625;  blocks[17]["h"]=250;  blocks[17]["d"]=300; 
  blocks[18]=new Array(); blocks[18]["l"]=625;  blocks[18]["h"]=250;  blocks[18]["d"]=250; 
  blocks[19]=new Array(); blocks[19]["l"]=625;  blocks[19]["h"]=200;  blocks[19]["d"]=500; 
  blocks[20]=new Array(); blocks[20]["l"]=625;  blocks[20]["h"]=200;  blocks[20]["d"]=375; 
  blocks[21]=new Array(); blocks[21]["l"]=625;  blocks[21]["h"]=200;  blocks[21]["d"]=300; 
  blocks[22]=new Array(); blocks[22]["l"]=625;  blocks[22]["h"]=200;  blocks[22]["d"]=250; 
  blocks[23]=new Array(); blocks[23]["l"]=625;  blocks[23]["h"]=250;  blocks[23]["d"]=150; 
  blocks[24]=new Array(); blocks[24]["l"]=625;  blocks[24]["h"]=250;  blocks[24]["d"]=100; 
  //blocks[25]=new Array(); blocks[25]["l"]=625;  blocks[25]["h"]=250;  blocks[25]["d"]=75; 
  blocks[26]=new Array(); blocks[26]["l"]=625;  blocks[26]["h"]=200;  blocks[26]["d"]=150; 
  blocks[27]=new Array(); blocks[27]["l"]=625;  blocks[27]["h"]=200;  blocks[27]["d"]=100; 
  //blocks[28]=new Array(); blocks[28]["l"]=625;  blocks[28]["h"]=200;  blocks[28]["d"]=75; 
  blocks[29]=new Array(); blocks[29]["l"]=625;  blocks[29]["h"]=250;  blocks[29]["d"]=400; 
  blocks[30]=new Array(); blocks[30]["l"]=625;  blocks[30]["h"]=200;  blocks[30]["d"]=400; 


  var L=$("#len").val();
  var H=$("#height").val();
  var Spr=$("#square").val();
  var Nbl=$("#dim option:selected").val();
      
  var block=new Array(); block=blocks[Nbl];
    var V1=block["l"]*block["h"]*block["d"]/1000000000;
  var V=(L*H-Spr)*1.05*block["d"]/1000;
  
  $("#q_m").val(number_format(V, {thousands_sep: " ", dec_point: ".", decimals: 2}));
    $("#q_s").val(number_format(V/V1, {thousands_sep: " ", dec_point: ".", decimals: 0}));

  //if (block["l"]==600) {
    var pal=Math.ceil(V/1.875);
    var Vk=pal*1.875; 
        /*} // 4.12.13 
       else { 
          var pal=Math.ceil(V/1.875);
          var Vk=pal*1.875;  
          if (block["d"]==400) {
            pal=Math.ceil(V/2);
            Vk=pal*2; 
          }
        }*/
  
  $("#qk_m").val(number_format(Vk, {thousands_sep: " ", dec_point: ".", decimals: 2}));
    $("#qk_s").val(number_format(Vk/V1, {thousands_sep: " ", dec_point: ".", decimals: 0}));
  
  $("#pal").val(pal);
  $("#qpal").val(number_format(1.875/V1, {thousands_sep: " ", dec_point: ".", decimals: 0}));
  
  
     });

});
</script>
<?php 
function show_form() 
{ 
?> 
<form id="register" action="" method=post> 
<div > 


               <!--<table id="calc_table" data-breackbrick="1200">-->
        <table class="calc1">
        <tbody> 
  <tr>
    <td>Выберите размер блока, LxHxD</td>
    <td>
        <select name="dim" id="dim">
    <option value="1">600x250x500</option>
    <option value="2">600x250x375</option>
    <option value="3">600x250x300</option>
    <option value="4">600x250x250</option>
    <option value="5">600x200x500</option>
    <option value="6">600x200x375</option>
    <option value="7">600x200x300</option>
    <option value="8">600x200x250</option>       
    <option value="9">600x200x150</option>
    <option value="10">600x250x100</option>
        <option value="12">600x250x150</option>
    <option value="13">600x200x100</option>
        <option value="15">625x250x500</option>
    <option value="16">625x250x375</option>
    <option value="17">625x250x300</option>
    <option value="18">625x250x250</option>
    <option value="19">625x200x500</option>
    <option value="20">625x200x375</option>
    <option value="21">625x200x300</option>
    <option value="22">625x200x250</option>       
    <option value="23">625x200x150</option>
    <option value="24">625x250x100</option>
    <!-- <option value="25">625x250x75</option>        -->
    <option value="26">625x250x150</option>
    <option value="27">625x200x100</option>
    <!-- <option value="28">625x200x75</option>      -->
    <option value="29">625x200x400</option>
    <option value="30">625x250x400</option>       
</select>  
    </td>
  </tr>
  <tr><td>Введите общую длину стен, м</td><td><input name="len" id="len" type="text" /></td></tr>
  <tr><td>Введите среднюю высоту стен, м</td><td><input name="height" id="height" type="text" /></td></tr>
  <tr><td>Введите общую площадь оконных и дверных проемов, м2</td><td><input name="square" id="square" type="text" /></td></tr>
  <tr><td colspan="2" align="center">

  
 
</table>

<table class="calc2" id="result_info">
  <tr>
    <td>Количество блоков:</td><td class="inp">м<sup>3</sup>&nbsp;<input name="q_m" id="q_m" type="text" /></td><td class="inp">шт.&nbsp;<input name="q_s" id="q_s" type="text" /></td>
  </tr>
  <tr>
    <td>Количество блоков кратное паллете:</td><td class="inp">м<sup>3</sup>&nbsp;<input name="qk_m" id="qk_m" type="text" /></td><td class="inp">шт.&nbsp;<input name="qk_s" id="qk_s" type="text" /></td>
  </tr>
  <tr><td colspan="2">Количество блоков на паллете:</td><td class="inp"><input name="qpal" id="qpal" type="text" /></td></tr>
  <tr><td colspan="2">Количество паллет:</td><td class="inp"><input name="pal" id="pal" type="text" /></td></tr>

</table>
<div id="pole">
  <br />Имя*<br /> 
              <input type="text" id="login" name="name"  value="<?=@$uname;?>"> 
              <span class="error"><?=@$e1;?></span>
              <br />Контактный телефон*<br /> 
              <input id="nub" type="text" name="tel" > 
              <br />Контактный email<br /> 
              <input  type="text" id="umail" name="email" value="<?=@$umail;?>"> 
              <span class="error"><?=@$e3;?></span>
              <br />Адрес доставки<br /> 
              <input id="adress" type="text" name="title" > 
              <br />Дополнительная информация<br /> 
              <textarea id="text_area" name="mess"></textarea><br/> 
              </tr>
              </tbody>
             </div>
            
              



             <!-- <br />width*<br /> 
              <input name="fieldWidth" type="text" claas="shop2-input-float" id="fieldWidth" value="0" /></td>-->
        
              
        
        </table>
          
     <!-- <button type="submit" name="button" id="send">Отправить</button>-->
    <input  id="count" name="count" type="button" value="Рассчитать"><br/>
    <br /><input  id="but" type="submit" value="Отправить" name="submit"> 
</div> 
</form> 
<div class="calc">
   
     

    </div>
* Помечены поля, которые необходимо заполнить 
<?php 
} 
 
function complete_mail() { 
        $_POST['title'] =  substr(htmlspecialchars(trim($_POST['title'])), 0, 1000); 
        $_POST['mess'] =  substr(htmlspecialchars(trim($_POST['mess'])), 0, 1000000); 
        $_POST['name'] =  substr(htmlspecialchars(trim($_POST['name'])), 0, 30); 
        $_POST['tel'] =  substr(htmlspecialchars(trim($_POST['tel'])), 0, 30); 
        $_POST['email'] =  substr(htmlspecialchars(trim($_POST['email'])), 0, 50); 
        $_POST['len'] =  substr(htmlspecialchars(trim($_POST['len'])), 0, 1000000); 
        $_POST['height'] =  substr(htmlspecialchars(trim($_POST['height'])), 0, 1000000); 
        $_POST['square'] =  substr(htmlspecialchars(trim($_POST['square'])), 0, 1000000); 
        $_POST['q_m'] =  substr(htmlspecialchars(trim($_POST['q_m'])), 0, 1000000);
        $_POST['q_s'] =  substr(htmlspecialchars(trim($_POST['q_s'])), 0, 1000000); 
        $_POST['qk_m'] =  substr(htmlspecialchars(trim($_POST['qk_m'])), 0, 1000000); 
        $_POST['qk_s'] =  substr(htmlspecialchars(trim($_POST['qk_s'])), 0, 1000000); 
        $_POST['qpal'] =  substr(htmlspecialchars(trim($_POST['qpal'])), 0, 1000000); 
        $_POST['pal'] =  substr(htmlspecialchars(trim($_POST['pal'])), 0, 1000000);
        $_POST['dim'] =  substr(htmlspecialchars(trim($_POST['dim'])), 0, 1000000);
               // если не заполнено поле "Имя" - показываем ошибку 0 
        if (empty($_POST['name'])) 
             output_err(0); 
        // если неправильно заполнено поле email - показываем ошибку 1 
        if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['email'])) 
             output_err(1); 
        // если не заполнено поле "Сообщение" - показываем ошибку 2 
        if(empty($_POST['mess'])) 
             output_err(2); 
        // создаем наше сообщение 
        $mess = ' 
        Имя отправителя:'.$_POST['name'].'
        Контактный телефон:'.$_POST['tel'].' 
        Контактный email:'.$_POST['email'].' 
        Адрес доставки:'.$_POST['title'].' 
        Введите общую длину стен, м:'.$_POST['len'].' 
        Введите среднюю высоту стен, м:'.$_POST['height'].' 
        Введите общую площадь оконных и дверных проемов, м2:'.$_POST['square'].'
        Количество блоков:'.$_POST['q_m'].' шт '.$_POST['q_s'].'
        Количество блоков кратное паллете:'.$_POST['qk_m'].' шт '.$_POST['qk_s'].'
        Количество блоков на паллете:'.$_POST['qpal'].'
        Количество блоков на паллете:'.$_POST['pal'].'
        Выбранный размер блока, LxHxD:'.$_POST['dim'].'
        '.$_POST['mess']; 
        // $to - кому отправляем 
        $to = 'test@test.ru'; 
        // $from - от кого 
        $from='test@test.ru'; 
        mail($to, $_POST['title'], $mess, "From:".$from); 
        echo 'Спасибо! Ваше письмо отправлено.'; 
} 
 
function output_err($num) 
{ 
    $err[0] = 'ОШИБКА! Не введено имя.'; 
    $err[1] = 'ОШИБКА! Неверно введен e-mail.'; 
    $err[2] = 'ОШИБКА! Не введено сообщение.'; 
    echo '<p>'.$err[$num].'</p>'; 
    show_form(); 
    exit(); 
} 
 
if (!empty($_POST['submit'])) complete_mail(); 
else show_form(); 
?>
</body>
</html>