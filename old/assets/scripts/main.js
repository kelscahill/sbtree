function isMobile() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return true;
    }
    return false;
}

if (isMobile()) {
	$('body').addClass('notouch');
}

$(function() {
  $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});


var is_ie/*@cc_on = {
  version : parseFloat(navigator.appVersion.match(/MSIE (.+?);/)[1])
}@*/;

if (is_ie && (is_ie.version < 7)) {
  document.write('<scr' + 'ipt id="__ie_ondomload" defer="true" src="//:"></script>');

  var el = document.getElementById("__ie_ondomload");
    el.onreadystatechange = function() {
      if ("complete" == this.readyState) {
        this.parentNode.removeChild(this);
        imitateParagraphSiblingCssRule();
      }
    };
    el=null;
}
else {
    document.write("<style>p { margin-top: 0; margin-bottom: 0; } p + p { margin-top: 1em; }</style>");
}

function imitateParagraphSiblingCssRule () {
  var ps = document.getElementsByTagName("p");
  for (i=0; i < ps.length ; ++i) {
    var p = ps[i];
    p.style.marginBottom="0";
    if (p.previousSibling && ("P" == p.previousSibling.tagName)) {
      p.style.marginTop="1em";
    }
    else {
      p.style.marginTop="0";
    }
  }
}

function wsp_printCoupon(elemId) {
  var iframeId = "iframe_" + elemId;

  function closeIFrame() {
    var coupon = document.getElementById(iframeId);
    if (coupon) {
      coupon.parentNode.removeChild(coupon);
    }
  }

  function setupContent(id, coupon) {
    var inst, doc, win;
    if (navigator.appName == "Microsoft Internet Explorer") {
      inst = window.frames[id];
      doc = inst.window.document;
      win = inst.window;
    }
    else {
      inst = document.getElementById(id);
      doc = inst.contentDocument;
      win = inst.contentWindow;
    }

    var head = doc.getElementsByTagName('head').item(0);
    // Wait for it to load
    if (!head || !doc.body || doc.title != "coupon_html") {
      doc.open("text/html");
      doc.write('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>');
      doc.writeln("<head xmlns=\"http://www.w3.org/1999/xhtml\">");
      doc.writeln("<title>coupon_html</title>");
      doc.writeln('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">');
      doc.writeln("<style>");
      doc.writeln("@media print { #table_border { border: 1px #000000 dashed; } }");
      doc.writeln("</style>");
      doc.writeln("</head>");
      doc.writeln("<body>");
      doc.writeln(coupon.innerHTML);
      doc.writeln("</body>");
      doc.writeln("</html>");
      doc.close();

      window.setTimeout(function(){setupContent(id);}, 100);
      return;
    }
    win.focus();

    if (win.attachEvent) {
      if (!win.attachEvent("onafterprint", closeIFrame)) {
        setTimeout(closeIFrame, 5000);
      }
      window.print();
    }
    else {
      win.print();
      setTimeout(closeIFrame, 5000);
    }
  }

  var coupon = document.getElementById(elemId);
  var iframe = document.createElement("iframe");
  iframe.setAttribute("id", iframeId);
  iframe.setAttribute("border", "0");
  iframe.setAttribute("frameBorder", "0");
  iframe.setAttribute("marginWidth", "0");
  iframe.setAttribute("marginHeight", "0");
  iframe.setAttribute("leftMargin", "0");
  iframe.setAttribute("topMargin", "0");
  iframe.setAttribute("scrolling", "no");
  iframe.setAttribute("width", 100);
  iframe.setAttribute("height", 100);
  document.body.appendChild(iframe);
  iframe.setAttribute("src", wsp_htmlref_blank);
  setupContent(iframeId, coupon);
}

/* Navigation Javascript Starts */
function imageSwap(img, src) {
  var objStr,obj;
  if(document.images){
    if (typeof(img) == 'string') {
      objStr = 'document.' + img;
      obj = eval(objStr);
      obj.src = src;
    } else if ((typeof(img) == 'object') && img && img.src) {
      img.src = src;
    }
  }
}
/* Navigation Javascript Ends */

/** function openpopup
* @description Open a popup window at specified positions with specified dimensions.
* @param Window hwndPopup is a global paramter that will refer the new popup window instance that
*        will be opened.
*
*   var popupWidth    = 300;
*   var popupHeight   = 300;
*   var popupTop      = 300;
*   var popupLeft     = 300;
*   var isFullScreen  = false;
*   var isAutoCenter  = false;
*   var popupTarget   = "popupwin";
*   var popupParams   = "toolbar=0, scrollbars=0, menubar=0, status=0, resizable=1";
*/

function openpopup(/*Window*/ hwndPopup, /*String*/ url, /*int*/ popupWidth, /*int*/ popupHeight, /*int*/popupTop,
                   /*int*/ popupLeft, /*boolean*/ isFullScreen, /*boolean*/ isAutoCenter,
                   /*String*/ popupTarget, /*String*/ popupParams) {

	if (typeof(popupWidth) == "string") {
		popupWidth = parseInt(window.screen.width * (parseInt(popupWidth)/100));
	}
	if (typeof(popupHeight) == "string") {
		popupHeight = parseInt(window.screen.height * (parseInt(popupHeight)/100));
	}
	if (typeof(popupLeft) == "string") {
		popupLeft = parseInt(window.screen.width * (parseInt(popupLeft)/100));
	}
	if (typeof(popupTop) == "string") {
		popupTop = parseInt(window.screen.height * (parseInt(popupTop)/100));
	}


  if (isFullScreen) {
		popupParams += ", fullscreen=1";
		popupTop = 0; popupLeft = 0;
		popupHeight = window.screen.height;
		popupWidth = window.screen.width;
  } else if (isAutoCenter) {
    popupTop  = parseInt((window.screen.height - popupHeight)/2);
    popupLeft = parseInt((window.screen.width - popupWidth)/2);
  }

  var ua = window.navigator.userAgent;
  var isOpera = (ua.indexOf("Opera") > -1);
  var operaVersion;
  var isMac = (ua.indexOf("Mac") > -1);

  if (isMac && url.indexOf("http") != 0) {
    url = location.href.substring(0,location.href.lastIndexOf('\/')) + "/" + url;
  }

  if (isOpera) {
    var i = ua.indexOf("Opera");
    operaVersion = parseFloat(ua.substring(i + 6, ua.indexOf(" ", i + 8)));
    if (operaVersion > 7.00) {
      var isAccessible = false;
      eval("try { isAccessible = ( (hwndPopup != null) && !hwndPopup.closed ); } catch(exc) { } ");
      if (!isAccessible) {
        hwndPopup = null;
      }
    }
  }

  if ( (hwndPopup == null) || hwndPopup.closed ) {
    if (isOpera && (operaVersion < 7)) {
      if (url.indexOf("http") != 0) {
        hwndPopup = window.open(url,popupTarget,popupParams + ((!isFullScreen && (popupWidth > 0 && popupHeight > 0)) ? ", width=" + popupWidth +", height=" + popupHeight : ""));
        if (!isFullScreen) {
          hwndPopup.moveTo(popupLeft, popupTop);
        }
        hwndPopup.focus();
        return;
      }
    }
    if (!(window.navigator.appName == "Netscape" && !document.getElementById)) {
      //not ns4
      popupParams += ((popupWidth > 0 && popupHeight > 0) ? (", width=" + popupWidth +", height=" + popupHeight) : "") + ", left=" + popupLeft + ", top=" + popupTop;
    } else {
      popupParams += ", left=" + popupLeft + ", top=" + popupTop;
    }
    //alert(popupParams);
    hwndPopup = window.open("",popupTarget,popupParams);
    if (!isFullScreen) {
      if (popupWidth > 0 && popupHeight > 0)
			hwndPopup.resizeTo(popupWidth, popupHeight);
      hwndPopup.moveTo(popupLeft, popupTop);
    }
    hwndPopup.focus();
    with (hwndPopup.document) {
      open();
      write("<ht"+"ml><he"+"ad></he"+"ad><bo"+"dy onLoad=\"window.location.href='" + url + "'\"></bo"+"dy></ht"+"ml>");
      close();
    }
  } else {
    if (isOpera && (operaVersion > 7.00)) {
      eval("try { hwndPopup.focus(); hwndPopup.location.href = url; } catch(exc) { hwndPopup = window.open(\""+ url +"\",\"" + popupTarget +"\",\""+ popupParams +
			((popupWidth > 0 && popupHeight > 0) ? (", width=" + popupWidth +", height=" + popupHeight) : "") +
			"\"); } ");
    } else {
      hwndPopup.focus();
      hwndPopup.location.href = url;
    }
  }
}// end function
