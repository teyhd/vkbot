"use strict"
var timerId;

function clockStart() { // запустить часы
  timerId = setInterval(update, 1000);
  update(); // (*)
}

function update() {
  var clock = document.getElementById('clock');
  var date = new Date(); // (*)
  var minutes = date.getMinutes();
  var hours = date.getHours();
  var seconds = date.getSeconds();	
  move(seconds,minutes,hours);
  backgrd(hours, minutes);	
  if((hours>=1) && (hours<7)){
	  shad(3);
  }	
	else {
	  shad(2);	
	}
  if (minutes === 30){
	  weatup();
  }	 
  if (hours < 10) {hours = '0' + hours;}
  clock.children[0].innerHTML = hours;

  
  if (minutes < 10) {minutes = '0' + minutes;}
  clock.children[1].innerHTML = minutes;

  if (seconds < 10) {seconds = '0' + seconds;}
  clock.children[2].innerHTML = seconds;
	
  var dates = document.getElementById('dates');	
  var numb = date.getDate();
  var month = date.getMonth() + 1;
  switch (month) {
	  case 1:
		month = 'Янв';
		break;
	  case 2:
		month = 'Фев';
		break;
	  case 3:
		month = 'Март';
		break;
	  case 4:
		month = 'Апр';
		break;
	  case 5:
		month = 'Май';
		break;
	  case 6:
		month = 'Июнь';
		break;		  
	  case 7:
		month = 'Июль';
		break;
	  case 8:
		month = 'Авг';
		break;
	  case 9:
		month = 'Сент';
		break;
	  case 10:
		month = 'Окт';
		break;
	  case 11:
		month = 'Ноябрь';
		break;
	  case 12:
		month = 'Дек';
		break;			  
	  default:
		alert( 'Я таких значений не знаю' );	  
    	}
 	dates.innerHTML = numb + ' ' + month;
    var weekd = document.getElementById('week');	
	var weks = date.getDay();	
	  switch (weks) {
	  case 1:
		weks = 'ПН';
		break;
	  case 2:
		weks = 'ВТ';
		break;
	  case 3:
		weks = 'СР';
		break;
	  case 4:
		weks = 'ЧТ';
		break;
	  case 5:
		weks = 'ПТ';
		break;
	  case 6:
		weks = 'СБ';
		break;		  
	  case 0:
		weks = 'ВС';
		break;		  
	  default:
		alert( 'Я таких значений не знаю' );	  
    	}
    weekd.innerHTML = weks;
		
}

setTimeout(clockStart, 1500);

function backgrd(hour, min){
	switch (hour) {
	  case 0:
		document.body.style.background = 'url(img/smind4.png)';
		break;
	  case 1:
		document.body.style.background = 'url(img/smind3.png)';
		break;
	  case 2:
		document.body.style.background = 'url(img/smind2.png)';
		break;			
	  case 3:
		document.body.style.background = 'url(img/smind5.png)';
		break;
	  case 4:
		document.body.style.background = 'url(img/smind13.png)';
		break;
	  case 7:
		document.body.style.background = 'url(img/smind9.png)';
		break;
	  case 8:
		document.body.style.background = 'url(img/smind15.png)';
		break;
	  case 9:
		document.body.style.background = 'url(img/smind6.png)';
		break;
	  case 10:
		document.body.style.background = 'url(img/smind12.png)';
		break;
	  case 11:
		document.body.style.background = 'url(img/smind7.png)';
		break;
	  case 12:
		document.body.style.background = 'url(img/smind.png)';
		break;
	  case 13:
		document.body.style.background = 'url(img/smind4.png)';
		break;
	  case 14:
		document.body.style.background = 'url(img/smind5.png)';
		break;
	  case 15:
		document.body.style.background = 'url(img/smind11.png)';
		break;
	  case 16:
		document.body.style.background = 'url(img/smind7.png)';
		break;
	  case 17:
		document.body.style.background = 'url(img/smind15.png)';
		break;
	  case 18:
		document.body.style.background = 'url(img/smind.png)';
		break;
	  case 19:
		document.body.style.background = 'url(img/smind12.png)';
		break;
	  case 20:
		document.body.style.background = 'url(img/smind9.png)';
		break;
	  case 21:
		document.body.style.background = 'url(img/smind7.png)';
		break;
	  case 22:
		document.body.style.background = 'url(img/smind6.png)';
		break;
	  case 23:
		document.body.style.background = 'url(img/smind5.png)';
		break;
	  default:
		document.body.style.background = 'url(img/smind.png)';	
		break;
    	}
	 if (min===30){
		document.body.style.background = 'url(img/smind.png)';	
	 }
}

var width = 0;
var WKillMin = 0;
var KillDay = 0;
function move(sec,min,hour) {
    var elem = document.getElementById("myBar"); 
	var hpmin = document.getElementById("mins");
	var hpsec = document.getElementById("secs");
      width=sec*10.5+10.5; 
      elem.style.width = width + 'px'; 
      hpsec.innerHTML = 60-sec + ' HP';
  var killmin = document.getElementById("Bar");	
	  WKillMin=min*10.5+10.5; 
      killmin.style.width = WKillMin + 'px'; 
      hpmin.innerHTML = 60-min + ' HP';
	
	var hpdayK = document.getElementById("Hourday");
	var KillD = document.getElementById("DayBar");	
	KillDay = 33 * hour;
	KillD.style.height = KillDay + 'px';
	hpdayK.innerHTML = 24 - hour+ ' HP';
}

function shad(fl) {
	var ShadElem = document.getElementById("shad");	
	if (SelShad === 0){
	if(fl===2){
		ShadElem.style.opacity = '0.55';
		ShadElem.style.visibility = 'hidden'; //Светло 
	}
	
	if(fl===3){
		ShadElem.style.opacity = '0.55';
		ShadElem.style.visibility = 'visible'; //Темно
	}
  }
}
var SelShad = 0;

function light(v) {
	if (v===5) {
		
var ShadElem = document.getElementById("shad");	
var Ligh = document.getElementById("select");	
switch (Ligh.value) {
	  case '0':
		SelShad = 0;
		break;		
	  case '1':
		ShadElem.style.visibility = 'hidden';
		SelShad = 1;
		break;
	  case '2':
		ShadElem.style.visibility = 'visible'; 
		ShadElem.style.opacity = '0.55';
		SelShad = 1;
		break;
	  case '3':
		ShadElem.style.visibility = 'visible';
		ShadElem.style.opacity = '0.7';
		SelShad = 1;
		break;
	  case '4':
		ShadElem.style.visibility = 'visible'; 
		ShadElem.style.opacity = '0.8';
		SelShad = 1;
		break;
	  default:
		alert( 'Я таких значений не знаю' );	  
		break;
    	}
	}
}
light(1);

function weatup(){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
               console.log(this.responseText); 
            }
        };
        xmlhttp.open("GET", "index.php?q=weather", true);
        xmlhttp.send();
}
weatup();