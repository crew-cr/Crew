function modalPopup(url, _width, _top){
	var width = _width || 920;
	var top = _top || 100;

	var containerid = "modal";
	var popupDiv = document.createElement('div');
	var blockDiv = document.createElement('div');
	
	popupDiv.setAttribute('id', 'modal');
	popupDiv.setAttribute('class', 'modal');
	
	blockDiv.setAttribute('id', 'modal-bg');
	blockDiv.setAttribute('class', 'modal-bg');
	blockDiv.setAttribute('onClick', 'closePopup()');
	
	document.body.appendChild(popupDiv);
	document.body.appendChild(blockDiv);
	
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ //test for MSIE x.x;
	 var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
	   if(ieversion>6) {
		 getScrollHeight(top);
	   }
	} else {
	  getScrollHeight(top);
	}
	
	document.getElementById('modal').style.width = width + 'px';

	document.getElementById('modal-bg').style.opacity = 0.4;
	document.getElementById('modal-bg').style.filter = 'alpha(Opacity=40)';
	document.getElementById('modal').style.marginLeft = (-1 * (width / 2)) + 'px';
	document.getElementById('modal').style.left = 50 + '%';

	blockPage();

	var page_request = false;
	if (window.XMLHttpRequest) {
		page_request = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		try {
			page_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				page_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) { }
		}
	} else {
		return false;
	}

	page_request.onreadystatechange=function(){
		if((url.search(/.jpg/i)==-1) && (url.search(/.jpeg/i)==-1) && (url.search(/.gif/i)==-1) && (url.search(/.png/i)==-1) && (url.search(/.bmp/i)==-1)) {
			pageloader(page_request, containerid);
		} else {
			imageloader(url, containerid);
		}
	}

	page_request.open('GET', url, true);
	page_request.send(null);
}

function pageloader(page_request, containerid){
	if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)) {
		document.getElementById(containerid).innerHTML=page_request.responseText;
	}
}

function imageloader(url, containerid) {
	document.getElementById(containerid).innerHTML='<div align="center"><img src="' + url + '" border="0" /></div>';
}

function blockPage() {
	var blockdiv = document.getElementById('modal-bg');
	var height = screen.height;
	
	blockdiv.style.height = height + 'px';
	blockdiv.style.display = 'block';
}

function getScrollHeight(top) {
  var h = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop;
           
	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
		var ieversion=new Number(RegExp.$1);
		if(ieversion>6) {
			document.getElementById('modal').style.top = h + top + 'px';
		} else {
			document.getElementById('modal').style.top = top + 'px';
		}
	} else {
		document.getElementById('modal').style.top = h + top + 'px';
	}
}

function closePopup() {
	fade('modal', 200);
	document.getElementById('modal-bg').style.display='none';
}

function fade(id, fadeOutTime) {
	var el = document.getElementById(id);
	
	if(el == null) {
		return;
	}
	
	if(el.FadeState == null) {
		if(el.style.opacity == null || el.style.opacity == '' || el.style.opacity == '1') {
			el.FadeState = 2;
		} else {
			el.FadeState = -2;
		}
	}
	
	if(el.FadeState == 1 || el.FadeState == -1) {
		el.FadeState = el.FadeState == 1 ? -1 : 1;
		el.fadeTimeLeft = fadeOutTime - el.fadeTimeLeft;
	} else {
		el.FadeState = el.FadeState == 2 ? -1 : 1;
		el.fadeTimeLeft = fadeOutTime;
		setTimeout("animateFade(" + new Date().getTime() + ",'" + id + "','" + fadeOutTime + "')", 33);
	}  
}

function animateFade(lastTick, id, fadeOutTime) {
	var currentTick = new Date().getTime();
	var totalTicks = currentTick - lastTick;
	var el = document.getElementById(id);
	
	if(el.fadeTimeLeft <= totalTicks) {
		el.style.opacity = el.FadeState == 1 ? '1' : '0';
		el.style.filter = 'alpha(opacity = ' + (el.FadeState == 1 ? '100' : '0') + ')';
		el.FadeState = el.FadeState == 1 ? 2 : -2;
		document.body.removeChild(el.nextSibling);
		document.body.removeChild(el);
		return;
	}
	
	el.fadeTimeLeft -= totalTicks;
	var newOpVal = el.fadeTimeLeft / fadeOutTime;
	
	if(el.FadeState == 1) {
		newOpVal = 1 - newOpVal;
	}
	
	el.style.opacity = newOpVal;
	el.style.filter = 'alpha(opacity = ' + (newOpVal*100) + ')';
	
	setTimeout("animateFade(" + currentTick + ",'" + id + "','" + fadeOutTime + "')", 33);
}