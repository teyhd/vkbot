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
  backgrd(hours,minutes);	
  sleep(hours,seconds,minutes);	
  if((hours>=1) && (hours<7)){
	  shad(3);
  }	
	else {
	  shad(2);	
	}
  if (minutes === 30){
	  if (seconds === 0){
		 weatup();  
	  }
  }	
  if (minutes === 0){
	  if (seconds === 0){
		 weatup();  
	  }
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
	if(screen.width>1000){
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
	} else {document.body.style.background = 'url(img/smindphine.png)';	}
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

var DreamKiller = 0;
function sleep(hour,sec,min) {
	var timectrl =  document.getElementById("killdream"); 
    var slepbar = document.getElementById("dreamBar"); 
	var hpdream = document.getElementById("dreams");
	if (hour===23){
		DreamKiller = min;
		timectrl.style.visibility = 'visible'; 
	}
	if (DreamKiller >= 480){
		timectrl.style.visibility = 'hidden'; 
	}
	if ((hour>=0)  && (hour<=7)  && (sec===0)) {
		DreamKiller= min + (hour+1) * 60;
		timectrl.style.visibility = 'visible'; 
	}
      slepbar.style.width = DreamKiller + 'px'; 
      hpdream.innerHTML = 420 - DreamKiller + ' HP';
}


function shad(fl) {
	var ShadElem = document.getElementById("shad");	
	if (SelShad === 0){
	if(fl===2){
		ShadElem.style.opacity = '0.55';
		ShadElem.style.visibility = 'hidden'; //Светло 
	}
	
	if(fl===3){
		ShadElem.style.opacity = '0.9';
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
		ShadElem.style.opacity = '0.95';
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
	var tempret = document.getElementById("twer");	
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
				var text = this.responseText + '&deg';
			   tempret.innerHTML = text;
			   console.log(text);
            }
        };
        xmlhttp.open("GET", "weather.php?q=weather", true);
        xmlhttp.send();
}
setTimeout(weatup, 1500);
var EventFlag=0;
function botmessage(){
	if (EventFlag!==1){
	var Ligh = document.getElementById("select");	
	var msgplace = document.getElementById("botmsg");	
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
				var text = this.responseText;
				if (text[0]!=='*'){
					msgplace.style.visibility = 'visible'; 
					text = text.replace(/_/g,"&nbsp;");
                    text = text[0].toUpperCase() + text.slice(1);
					msgplace.innerHTML ='&nbsp;'+ text +'&nbsp;';
					var arr = text.split('&nbsp;');
					if (arr[0]==="Music"){
							msgplace.style.visibility = 'hidden';
						    play(arr[1]);
						 console.log(text);
						}	
					if (arr[0]==="Радио"){
							msgplace.style.visibility = 'hidden';
						    radio(arr[1]);
						 console.log(text);
						}
					if (arr[0]==="Тишина"){
							msgplace.style.visibility = 'hidden';
						    play(arr[1]);
						     console.log(text);
						}						
					if (arr[0]==="Обнови"){
							window.location.reload();
						    console.log(text);
						}
					if (arr[0]==="Обновил"){
						    msgplace.style.visibility = 'hidden';
						}					
					if (arr[0]==="Светофильтр"){
                        Ligh.value = arr[1];
						light(5);
						msgplace.style.visibility = 'hidden'; 
						 console.log(text);
					}
				} else {
					msgplace.style.visibility = 'hidden';  
				}				
            }
        };
        xmlhttp.open("GET", "msg.php?q=readmsg", true);
        xmlhttp.send();	
}
}
setInterval(botmessage,1000);

function event(){
	var msgplace = document.getElementById("botmsg");	
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
				var text = this.responseText;
				if (text[0]!=='*'){
					EventFlag = 1;
					msgplace.style.visibility = 'visible'; 
					msgplace.innerHTML ='&nbsp;'+ text +'&nbsp;';
					console.log(text);
				    } else {
					 EventFlag = 0;  
				    }				
            }
        };
        xmlhttp.open("GET", "event.php?q=event", true);
        xmlhttp.send();	
}
setInterval(event,1000);
function radio(type){
	var player = document.getElementById("music");	
	if ((type === "1") || (type === "новое")) {
		player.src = 'http://icecast.newradio.cdnvideo.ru/newradio3'; //новое радио
	}
	if ((type === "2") || (type === "европа"))   {
		player.src = 'http://ep256.hostingradio.ru:8052/europaplus256.mp3'; //европа +
	}
	if ((type === "2") || (type === "шансон")) {
		player.src = 'http://chanson.hostingradio.ru:8041/chanson128.mp3?md5=p0afQG1ScHiDIO00uwM6qA&e=1552217766'; //Шансон
	}
	if ((type === "4") || (type === "релакс")) {
		player.src = 'http://ic3.101.ru:8000/c19_2?userid=0&setst=m8uheoaorqeoa7s60i2ltj1abo&tok=10750927c2ROK1RQZEVzSjZBM3gwRUxDQTlpRGU5Zy84WE9uZE54MmdnQWxOMEU4UXNCMHZmZXZDZ3E1aHIxR3lRdHpiTw%3D%3D1'; //релакс
	}
	if ((type === "5") || (type === "юмор")) {
		player.src = 'http://ic3.101.ru:8000/v5_1?userid=0&setst=cpu9te3o74o3dicgp9r3aldaoa'; //Юмор
	}
}
function play(link){
	var player = document.getElementById("music");	
	player.src = 'https://teyhd.ru/vkbot/bot/music/' + link;
    if (link === "Тишина") {
		player.stop();
	}
}


