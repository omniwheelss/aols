/*Start of Cricinfo Cookie detection code*/
function getCookieVal (offset) {
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1)
	endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen)
		{
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
		return getCookieVal (j);
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break;
		}
	return null;
}

function SetCookie (name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

//CI_CQ_country and Q_cricinfo_country cookies are getting the two digit Quova country value
//This setup is changed for Redesign website from 1st June 2009
var cqanswer = GetCookie("CI_CQ_country");
if (cqanswer == null){
	cqanswer = GetCookie("Q_cricinfo_country");
	if (cqanswer == null){
		cqanswer = '';
	}
	else if (cqanswer == 'unknown'){
		cqanswer = '99';
	}
	else if (cqanswer == 'gb'){
		cqanswer = 'uk';
	}
}
/*End of Cricinfo Cookie detection code*/

/* global nav feature dropdown submenu script start here  */
function subPopup1(mId) {
	$('#'+mId).css("visibility","visible");
}
function subPopup0(mId) {
	$('#'+mId).css("visibility","hidden");
}
/* global nav feature dropdown submenu script ends here  */

/* magazine menu script start here  */
var timeout         = 100;
var closetimer		= 0;
var ddmenuitem      = 0;
// open hidden layer
function mopen(id)
{
	// cancel close timer
	mcancelclosetime();
	// close old layer
	if(ddmenuitem) {
		ddmenuitem.css({"visibility":"hidden","display":"none"});
	}
	// get new layer and show it
	ddmenuitem = $('#'+id);
	ddmenuitem.css({"visibility":"visible","display":"block"});
}
// close showed layer
function mclose()
{
	if(ddmenuitem) {
		ddmenuitem.css({"visibility":"hidden","display":"none"});
	}
}
// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}
// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}
document.onclick = mclose;
/* magazine menu script ends here  */

/*This function used for popup the desktop scoreboard*/
function openE(URL, WindowName) {
	  window.open(URL, WindowName, 'left=0,top=0,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,titlebar=0,width=1021,height=720');
        if (openE.opener == null)
                openE.opener = window;
        openE.opener.name = "opener";
        }

function openWin(url, wname, width, height){
	window.open(url, wname, 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=' + width + ',height=' + height + ',left=0,top=0');
}
/*End*/

/* story page font increase decrease script start  */
function textSize(size) {
	if(size == 13) 
	{
		$("#13").css({"cursor" : "default","color" : "#AAAAAA"});
		$("#14").css({"cursor" : "pointer","color" : "#333333"});
					$(document).ready(function() {
  	 				$("#storyTxt > p, #storyTxt > p > a").css({"font-size" : "13px"});
					$("#storyTxt > table > caption, #storyTxt > table > tbody > tr > td, #rltdTxt > span , #rltdTxt > span > a, #rltdTxt > div , #rltdTxt > div > a, #authInfo > p,#authInfo > a,#authInfo > span").css({"font-size" : "11px"});
 					});
		$("td.stryPicCptn,li.liSideBarNoBlt,li.liSideBarNoBlt > a,li.liSideBar,li.liSideBar > a").css({"font-size" : "11px"}) 
		$("#rltdBlueHd,#pullquote,h4.sbHdr").css({"font-size" : "12px"});
		$("#storyTxt,#sdbrTop,#sdbrTopimg").css({"font-size" : "13px"});
		$("td.pullquotetext,span.txtHeader").css({"font-size" : "14px"});
	}
	if(size == 14) 
	{
		$("#13").css({"cursor" : "pointer","color" : "#333333"});
		$("#14").css({"cursor" : "default","color" : "#AAAAAA"});
					$(document).ready(function() {
   					$("#storyTxt > p, #storyTxt > p > a").css({"font-size" : "14px"});
					$("#storyTxt > table > caption, #storyTxt > table > tbody > tr > td, #rltdTxt > span , #rltdTxt > span > a, #rltdTxt > div , #rltdTxt > div > a, #authInfo > p,#authInfo > a,#authInfo > span").css({"font-size" : "12px"});
	 				});
		$("td.stryPicCptn,li.liSideBarNoBlt,li.liSideBarNoBlt > a,li.liSideBar,li.liSideBar > a").css({"font-size" : "12px"})
		$("#rltdBlueHd,#pullquote,h4.sbHdr").css({"font-size" : "13px"});
		$("#storyTxt,#sdbrTop,#sdbrTopimg").css({"font-size" : "14px"});
		$("td.pullquotetext,span.txtHeader").css({"font-size" : "15px"});
	}								  
}
/* story page font increase decrease script start  */

/* JS for Image Tool Tip BEGIN   */
function iframeReload(){
  var iFrameEf = $('#emailFriend');
  if(typeof(mail_url) != "undefined" && mail_url) {
    iFrameEf.attr("src","/ci/content/submit/other/friendmail.html" + "?url=" + encodeURI(mail_url));
  }
  else {
    iFrameEf.attr("src","/ci/content/submit/other/friendmail.html");
  }
}
function showTooltip(curobj, toolTip){
	var curobj = $(curobj);
	var offset=curobj.offset();
    if(toolTip == 'divLoginpopup') {
		$("#"+toolTip).css({left: (offset.left + (-3)) + 'px',top: (offset.top +(-1)) + 'px',"display":"block"}); 
    } 
	else if(toolTip == 'athrData') {
	  	$("#"+toolTip).css({left: (offset.left + (45)) + 'px',top: (offset.top +(10)) + 'px',"display":"block"});
    } 
	else if(toolTip == 'Friendmail') {
	   	$("#"+toolTip).css({left: (offset.left + (-370)) + 'px',top: (offset.top +(20)) + 'px',"display":"block"});
		iframeReload();
    } 
	else {
	  	$("#"+toolTip).css({left: (offset.left + (0)) + 'px',top: (offset.top +(0)) + 'px',"display":"block"});
    }
    return false;
  }

function hideTooltip(toolTip){
	if(toolTip == 'divLoginpopup') {
		$('#'+toolTip).css("display","none");
		$("#email").val("");
		$("#password").val("")
	} else {
		$('#'+toolTip).css("display","none");
	}
}
/* JS for Image Tool Tip END */

/* Search box text clear */
function searchClrTxt(txtObj){  
  if(txtObj=='cricinfoSearch' && $('#'+txtObj).val() == 'Search Cricinfo'){
	$('#'+txtObj).val("");
  }
  if(txtObj=='PlayerssearchTxtBox' && $('#'+txtObj).val() == 'Search for grounds'){
    $('#'+txtObj).val("");
  }
  if(txtObj=='PhotosearchTxtBox' && $('#'+txtObj).val() == 'Search for photos'){
    $('#'+txtObj).val("");
  }
  if(txtObj=='PhotosearchTxtBox' && $('#'+txtObj).val() == 'Search for galleries'){
    $('#'+txtObj).val("");
  }
  if(txtObj=='stryTxtBox' && $('#'+txtObj).val() == 'Search this section'){
    $('#'+txtObj).val("");
  }
  if(txtObj=='ProfilesearchTxtBox' && $('#'+txtObj).val() == 'Search for Profiles'){
    $('#'+txtObj).val("");
  }
  if(txtObj=='StatsgurusearchTxtBox' && $('#'+txtObj).val() == 'Search in Statsguru'){
    $('#'+txtObj).val("");
  }
}
/* Search box text clear */

/*  ESPN open/close and Breaking news button script start */
var on = 0;
function customize(){
  if(on == 0) {
    $('#espnExpCol').css("background-position" , "-3193px -6px");
    on = 1;
  }else{
    $('#espnExpCol').css("background-position" , "-3097px -6px");
    on = 0;
  }
  $("#ciEspnbtn").toggle("slow");
}
/*  ESPN open/close and Breaking news button script ends */

/* Ajax Call script start */
function ajaxFunction(id, url, from) {
  /* Poll Radio button validation script starts */
  if(from == "button") {
    var radio_choice = false;
    for (counter = 0; counter < document.ciHPPoll.Choice.length; counter++) {
      if (document.ciHPPoll.Choice[counter].checked) {
        radio_choice = true;
      }
    }
    if (!radio_choice) {
      alert("Please select any option.");
      return false;
    }
  }
  /* Poll Radio button validation script ends */
  var xmlHttp;
  try {// Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  } catch (e) {// Internet Explorer
    try {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
  xmlHttp.onreadystatechange = function() {

    if (xmlHttp.readyState == 4) {
      //Get the response from the server and extract the section that comes in the body section of the second html page avoid inserting the header part of the second page in your first page's element
      var respText = xmlHttp.responseText.split('<body>');
      elem.innerHTML = respText[0];//respText[1].split('</body>')[0];
    }
  }
  var elem = $("#"+id);
  if (!elem) {
    alert('The element with the passed ID doesn\'t exists in your page');
    return;
  }
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}
/* Ajax poll script ends  */

//create cookie
function createCookie( name, value, expires, path, domain, secure ) {

    var today = new Date();

    today.setTime( today.getTime() );
    if ( expires ) {
        expires = expires * 1000 * 60 * 60 * 24;
     }

     var expires_date = new Date( today.getTime() + (expires) );

     document.cookie = name+'='+escape( value ) +
                       ( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) +
                       ( ( path ) ? ';path=' + path : '' ) +
                       ( ( domain ) ? ';domain=' + domain : '' ) +
                       ( ( secure ) ? ';secure' : '' );
}
//check if cookie defined
function readCookie(name) {

    var start = document.cookie.indexOf( name + "=" );
    var len = start + name.length + 1;

    if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
       return null;
    }

    if ( start == -1 ) return null;
    var end = document.cookie.indexOf( ';', len );
    if ( end == -1 ) end = document.cookie.length;
    return unescape( document.cookie.substring( len, end ) );
}
//Remove cookie
function deleteCookie(  name, path, domain) {
    if ( readCookie( name ) )
        document.cookie = name + '=' + ( ( path ) ? ';path=' + path : '') + ( ( domain ) ? ';domain=' + domain : '' ) + ';expires=Thu, 01-Jan-1970 00:00:01 GMT';
}
//Get the domain name
function getDomainName () {
    var hostname = window.location.hostname.split('.');
    if ( hostname.length >= 2 ) {
        var len = hostname.length;
        var domainname = '.' +  hostname[len - 2] + '.' + hostname[len - 1];
    } else {
        var domainname = '.' + window.location.hostname;
    }
    return domainname;
}

/* Widget Bubble launch script */
function ciWidgetspopup(curobj, widgets_hiddenobj){
    var curobj = $(curobj);
	var offset=curobj.offset();
	if($.browser.msie){
		$("#"+widgets_hiddenobj).css({left: (offset.left + (-547)) + 'px',top: (offset.top +(-369)) + 'px',"display":"block"});
	}
	else{
		$("#"+widgets_hiddenobj).css({left: (offset.left + (-547)) + 'px',top: (offset.top +(-361)) + 'px',"display":"block"});
	}
    return false;
}

function ciWidgetspopupclose(widgets_hiddenobj){
  $("#"+widgets_hiddenobj).css("display","none");
}
/* Widget Bubble launch script */

/* Homepage News/Video panel script starts  */
function ciHomePanel(panel) {
  if(panel == "news") {
	$("#ciHomeNewsTab > a").css("color","#074377");
	$("#ciHomeVideoTab > a").css("color","#c2e1fe");
	$("#ciHomeTabNav").css("backgroundPosition","0px 0px");
	$("#ciNewsPnl").css("display","block");
	$("#ciVideoPnl").css("display","none");
	kyteplayer.player.stop(); // For IE bug, player playing in background after switching the tabs
  }
  if(panel == "video") {
	$("#ciHomeNewsTab > a").css("color","#c2e1fe");
	$("#ciHomeVideoTab > a").css("color","#074377");
	$("#ciHomeTabNav").css("backgroundPosition","-219px 0px");
	$("#ciNewsPnl").css("display","none");
	$("#ciVideoPnl").css("display","block");
	lnkTrackVals("vdo:video tab"); //Video Tab and Video headlines link tracking
  }
}
/* Homepage News/Video panel script ends  */

/* Show and hide div script */
function toggleBoxTab(prefix){
  var links = document.getElementsByTagName('li');
  for(i=0; i<links.length; i++){
    if(links[i].id.indexOf(prefix) == 0){
      if(links[i].id == prefix+c){
      }
      else{

      }
    }
  }
}

function showBoxDiv(prefix, vid){
  var divs = document.getElementsByTagName('div');

  for(i=0; i<divs.length; i++){
    if(divs[i].id.indexOf(prefix) == 0){
      if(divs[i].id == vid){
        if (1){ // DOM3 = IE5, NS6
          divs[i].style.display = 'block';
          divs[i].style.visibility = 'visible';
          divs[i].style.height = '';
        }
        else if (document.layers){  // Netscape 4
          document.layers[divs[i]].display = 'visible';
        }
        else{  // IE 4
          document.all.divs[i].visibility = 'visible';
        }
      }
      else if (1){
        divs[i].style.display = 'none';
        divs[i].style.visibility = 'hidden';
        divs[i].style.height = '0px';
      }
      else if (document.layers){
        document.divs[i].visibility = 'hidden';
      }
      else{  // IE 4
        document.all.divs[i].visibility = 'hidden';
      }
    }
  }
}
/* Show and hide div script ends */

/* ci HP Live score tabs swaping script start here  */
function swapTb(tab) {
	for(i=1; i<=3; i++){
		$('#lsTab'+i).attr("className","lsTbTxt");
		$('#tbCont'+i).css("display","none");
	}
	$("#"+tab).attr("className","lsTbTxt1");
	if(tab == 'lsTab1') {
		$('#lsTabBar').css("background-position","0px -30px");
		$('#tbCont1').css("display","block");
	}
	if(tab == 'lsTab2') {
		$('#lsTabBar').css("background-position","-314px -30px");
		$('#tbCont2').css("display","block");
	}
	if(tab == 'lsTab3') {
		$('#lsTabBar').css("background-position","-628px -30px");
		$('#tbCont3').css("display","block");
	}
}

function rsltswapTb(tab) {
	for(i=1; i<=2; i++){
		$('#rsTab'+i).attr("className","rsltTbTxt");
		$('#rstbCont'+i).css("display","none");
	}
	$("#"+tab).attr("className","rsltTbTxt1");;
	if(tab == 'rsTab1') {
		$('#rsltTabBar').css("background-position","-2320px -23px");
		$('#rstbCont1').css("display","block");
	}
	if(tab == 'rsTab2') {
		$('#rsltTabBar').css("background-position","-2635px -23px");
		$('#rstbCont2').css("display","block");
	}
}
/* ci HP Live score tabs swaping script ends here  */

/*  statistics records table data sorting script starts here  */
/* You can change these values */
var image_path = "http://i.imgci.com/espncricinfo/";
var image_up = "gryUpArw.gif";
var image_down = "menuBlckArow.gif";
var image_none = "gryUpArw.gif";
var europeandate = true;
var alternate_row_colors = true;

/* Don't change anything below this unless you know what you're doing */
addEvent(window, "load", sortables_init);

var SORT_COLUMN_INDEX;
var thead = false;

function sortables_init() {
	// Find all tables with class sortable and make them sortable
	if (!document.getElementsByTagName) return;
	tbls = document.getElementsByTagName("table");
	for (ti=0;ti<tbls.length;ti++) {
		thisTbl = tbls[ti];
		if (((' '+thisTbl.className+' ').indexOf("sortable") != -1) && (thisTbl.id)) {
			ts_makeSortable(thisTbl);
		}
	}
}

function ts_makeSortable(t) {
	if (t.rows && t.rows.length > 0) {
		if (t.tHead && t.tHead.rows.length > 0) {
			var firstRow = t.tHead.rows[t.tHead.rows.length-1];
			thead = true;
		} else {
			var firstRow = t.rows[0];
		}
	}
	if (!firstRow) return;

	// We have a first row: assume it's the header, and make its contents clickable links
	for (var i=0;i<firstRow.cells.length;i++) {
		var cell = firstRow.cells[i];
		var txt = ts_getInnerText(cell);
		if (cell.className != "unsortable" && cell.className.indexOf("unsortable") == -1) {
			cell.innerHTML = '<a href="#" class="head" onclick="ts_resortTable(this, '+i+');return false;">'+txt+'<span class="sortarrow">&nbsp;&nbsp;<img border="0" src="'+ image_path + image_none + '" alt="&darr;" align="absmiddle" hspace="5"/></span></a>';
		}
	}
	if (alternate_row_colors) {
		alternate(t);
	}
}

function ts_getInnerText(el) {
	if (typeof el == "string") return el;
	if (typeof el == "undefined") { return el };
	if (el.innerText) return el.innerText;	//Not needed but it is faster
	var str = "";

	var cs = el.childNodes;
	var l = cs.length;
	for (var i = 0; i < l; i++) {
		switch (cs[i].nodeType) {
			case 1: //ELEMENT_NODE
				str += ts_getInnerText(cs[i]);
				break;
			case 3:	//TEXT_NODE
				str += cs[i].nodeValue;
				break;
		}
	}
	return str;
}

function ts_resortTable(lnk, clid) {
	var span;
	for (var ci=0;ci<lnk.childNodes.length;ci++) {
		if (lnk.childNodes[ci].tagName && lnk.childNodes[ci].tagName.toLowerCase() == 'span') span = lnk.childNodes[ci];
	}
	var spantext = ts_getInnerText(span);
	var td = lnk.parentNode;
	var column = clid || td.cellIndex;
	var t = getParent(td,'TABLE');
	// Work out a type for the column
	if (t.rows.length <= 1) return;
	var itm = "";
	var i = 0;
	while (itm == "" && i < t.tBodies[0].rows.length) {
		var itm = ts_getInnerText(t.tBodies[0].rows[i].cells[column]);
		itm = trim(itm);
		if (itm.substr(0,4) == "<!--" || itm.length == 0) {
			itm = "";
		}
		i++;
	}
	if (itm == "") return;
	sortfn = ts_sort_caseinsensitive;
	if (itm.match(/^\d\d[\/\.-][a-zA-z][a-zA-Z][a-zA-Z][\/\.-]\d\d\d\d$/)) sortfn = ts_sort_date;
	if (itm.match(/^\d\d[\/\.-]\d\d[\/\.-]\d\d\d{2}?$/)) sortfn = ts_sort_date;
	if (itm.match(/^-?[£$€Û¢´]\d/)) sortfn = ts_sort_numeric;
	if (itm.match(/^-?(\d+[,\.]?)+(E[-+][\d]+)?%?$/)) sortfn = ts_sort_numeric;
	SORT_COLUMN_INDEX = column;
	var firstRow = new Array();
	var newRows = new Array();
	for (k=0;k<t.tBodies.length;k++) {
		for (i=0;i<t.tBodies[k].rows[0].length;i++) {
			firstRow[i] = t.tBodies[k].rows[0][i];
		}
	}
	for (k=0;k<t.tBodies.length;k++) {
		if (!thead) {
			// Skip the first row
			for (j=1;j<t.tBodies[k].rows.length;j++) {
				newRows[j-1] = t.tBodies[k].rows[j];
			}
		} else {
			// Do NOT skip the first row
			for (j=0;j<t.tBodies[k].rows.length;j++) {
				newRows[j] = t.tBodies[k].rows[j];
			}
		}
	}
	newRows.sort(sortfn);
	if (span.getAttribute("sortdir") == 'down') {
			ARROW = '&nbsp;&nbsp;<img border="0" src="'+ image_path + image_down + '" alt="&darr;" align="absmiddle" hspace="5"/>';
			newRows.reverse();
			span.setAttribute('sortdir','up');
	} else {
			ARROW = '&nbsp;&nbsp;<img border="0" src="'+ image_path + image_up + '" alt="&uarr;" align="absmiddle" hspace="5"/>';
			span.setAttribute('sortdir','down');
	}
    // We appendChild rows that already exist to the tbody, so it moves them rather than creating new ones
    // don't do sortbottom rows
    for (i=0; i<newRows.length; i++) {
		if (!newRows[i].className || (newRows[i].className && (newRows[i].className.indexOf('sortbottom') == -1))) {
			t.tBodies[0].appendChild(newRows[i]);
		}
	}
    // do sortbottom rows only
    for (i=0; i<newRows.length; i++) {
		if (newRows[i].className && (newRows[i].className.indexOf('sortbottom') != -1))
			t.tBodies[0].appendChild(newRows[i]);
	}
	// Delete any other arrows there may be showing
	var allspans = document.getElementsByTagName("span");
	for (var ci=0;ci<allspans.length;ci++) {
		if (allspans[ci].className == 'sortarrow') {
			if (getParent(allspans[ci],"table") == getParent(lnk,"table")) { // in the same table as us?
				allspans[ci].innerHTML = '&nbsp;&nbsp;<img border="0" src="'+ image_path + image_none + '" alt="&darr;" align="absmiddle" hspace="5"/>';
			}
		}
	}
	span.innerHTML = ARROW;
	alternate(t);
}

function getParent(el, pTagName) {
	if (el == null) {
		return null;
	} else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase()) {
		return el;
	} else {
		return getParent(el.parentNode, pTagName);
	}
}

function sort_date(date) {
	// y2k notes: two digit years less than 50 are treated as 20XX, greater than 50 are treated as 19XX
	dt = "00000000";
	if (date.length == 11) {
		mtstr = date.substr(3,3);
		mtstr = mtstr.toLowerCase();
		switch(mtstr) {
			case "jan": var mt = "01"; break;
			case "feb": var mt = "02"; break;
			case "mar": var mt = "03"; break;
			case "apr": var mt = "04"; break;
			case "may": var mt = "05"; break;
			case "jun": var mt = "06"; break;
			case "jul": var mt = "07"; break;
			case "aug": var mt = "08"; break;
			case "sep": var mt = "09"; break;
			case "oct": var mt = "10"; break;
			case "nov": var mt = "11"; break;
			case "dec": var mt = "12"; break;
			// default: var mt = "00";
		}
		dt = date.substr(7,4)+mt+date.substr(0,2);
		return dt;
	} else if (date.length == 10) {
		if (europeandate == false) {
			dt = date.substr(6,4)+date.substr(0,2)+date.substr(3,2);
			return dt;
		} else {
			dt = date.substr(6,4)+date.substr(3,2)+date.substr(0,2);
			return dt;
		}
	} else if (date.length == 8) {
		yr = date.substr(6,2);
		if (parseInt(yr) < 50) {
			yr = '20'+yr;
		} else {
			yr = '19'+yr;
		}
		if (europeandate == true) {
			dt = yr+date.substr(3,2)+date.substr(0,2);
			return dt;
		} else {
			dt = yr+date.substr(0,2)+date.substr(3,2);
			return dt;
		}
	}
	return dt;
}
function ts_sort_date(a,b) {
	dt1 = sort_date(ts_getInnerText(a.cells[SORT_COLUMN_INDEX]));
	dt2 = sort_date(ts_getInnerText(b.cells[SORT_COLUMN_INDEX]));
	if (dt1==dt2) {
		return 0;
	}
	if (dt1<dt2) {
		return -1;
	}
	return 1;
}
function ts_sort_numeric(a,b) {
	var aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
	aa = clean_num(aa);
	var bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
	bb = clean_num(bb);
	return compare_numeric(aa,bb);
}
function compare_numeric(a,b) {
	var a = parseFloat(a);
	a = (isNaN(a) ? 0 : a);
	var b = parseFloat(b);
	b = (isNaN(b) ? 0 : b);
	return a - b;
}
function ts_sort_caseinsensitive(a,b) {
	aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]).toLowerCase();
	bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]).toLowerCase();
	if (aa==bb) {
		return 0;
	}
	if (aa<bb) {
		return -1;
	}
	return 1;
}
function ts_sort_default(a,b) {
	aa = ts_getInnerText(a.cells[SORT_COLUMN_INDEX]);
	bb = ts_getInnerText(b.cells[SORT_COLUMN_INDEX]);
	if (aa==bb) {
		return 0;
	}
	if (aa<bb) {
		return -1;
	}
	return 1;
}
function addEvent(elm, evType, fn, useCapture)
// addEvent and removeEvent, cross-browser event handling for IE5+,	NS6 and Mozilla By Scott Andrew
{
	if (elm.addEventListener){
		elm.addEventListener(evType, fn, useCapture);
		return true;
	} else if (elm.attachEvent){
		var r = elm.attachEvent("on"+evType, fn);
		return r;
	} else {
		alert("Handler could not be removed");
	}
}
function clean_num(str) {
	str = str.replace(new RegExp(/[^-?0-9.]/g),"");
	return str;
}
function trim(s) {
	return s.replace(/^\s+|\s+$/g, "");
}
function alternate(table) {
	// Take object table and get all it's tbodies.
	var tableBodies = table.getElementsByTagName("tbody");
	// Loop through these tbodies
	for (var i = 0; i < tableBodies.length; i++) {
		// Take the tbody, and get all it's rows
		var tableRows = tableBodies[i].getElementsByTagName("tr");
		// Loop through these rows
		// Start at 1 because we want to leave the heading row untouched
		for (var j = 0; j < tableRows.length; j++) {
			// Check if j is even, and apply classes for both possible results
			if ( (j % 2) == 0  ) {
				if ( !(tableRows[j].className.indexOf('odd') == -1) ) {
					tableRows[j].className = tableRows[j].className.replace('odd', 'even');
				} else {
					if ( tableRows[j].className.indexOf('even') == -1 ) {
						tableRows[j].className += " even";
					}
				}
			} else {
				if ( !(tableRows[j].className.indexOf('even') == -1) ) {
					tableRows[j].className = tableRows[j].className.replace('even', 'odd');
				} else {
					if ( tableRows[j].className.indexOf('odd') == -1 ) {
						tableRows[j].className += " odd";
					}
				}
			}
		}
	}
}
/*  statistics records table data sorting script ends here  */

function ciFixtutetooltip(curobj, widgets_hiddenobj){
    $('.fixTooltip').hide();
	 var curobj = $(curobj);
	 var offset=curobj.offset();
		$("#"+widgets_hiddenobj).css({left: (offset.left + (25)) + 'px',top: (offset.top +(8)) + 'px',"display":"block"});
}

function ciFixtutetooltipclose(widgets_hiddenobj){
  $("#"+widgets_hiddenobj).css("display","none")
}

viewport = {
  getWinWidth: function () {
    this.width = 0;
    if (window.innerWidth) this.width = window.innerWidth - 18;
    else if (document.documentElement && document.documentElement.clientWidth)
  		this.width = document.documentElement.clientWidth;
    else if (document.body && document.body.clientWidth)
  		this.width = document.body.clientWidth;
  },

  getWinHeight: function () {
    this.height = 0;
    if (window.innerHeight) this.height = window.innerHeight - 18;
  	else if (document.documentElement && document.documentElement.clientHeight)
  		this.height = document.documentElement.clientHeight;
  	else if (document.body && document.body.clientHeight)
  		this.height = document.body.clientHeight;
  },

  getScrollX: function () {
    this.scrollX = 0;
  	if (typeof window.pageXOffset == "number") this.scrollX = window.pageXOffset;
  	else if (document.documentElement && document.documentElement.scrollLeft)
  		this.scrollX = document.documentElement.scrollLeft;
  	else if (document.body && document.body.scrollLeft)
  		this.scrollX = document.body.scrollLeft;
  	else if (window.scrollX) this.scrollX = window.scrollX;
  },

  getScrollY: function () {
    this.scrollY = 0;
    if (typeof window.pageYOffset == "number") this.scrollY = window.pageYOffset;
    else if (document.documentElement && document.documentElement.scrollTop)
  		this.scrollY = document.documentElement.scrollTop;
  	else if (document.body && document.body.scrollTop)
  		this.scrollY = document.body.scrollTop;
  	else if (window.scrollY) this.scrollY = window.scrollY;
  },

  getAll: function () {
    this.getWinWidth(); this.getWinHeight();
    this.getScrollX();  this.getScrollY();
  }

}

var menuLayers = {
  timer: null,
  activeMenuID: null,
  offX: 4,   // horizontal offset
  offY: 0,   // vertical offset
  show: function(id, e) {
    var mnu = document.getElementById? document.getElementById(id): null;
    if (!mnu) return;
    this.activeMenuID = id;
    if ( mnu.onmouseout == null ) mnu.onmouseout = this.mouseoutCheck;
    if ( mnu.onmouseover == null ) mnu.onmouseover = this.clearTimer;
    viewport.getAll();
    this.position(mnu,e);
  },

  hide: function() {
    this.clearTimer();
    if (this.activeMenuID && document.getElementById)
      this.timer = setTimeout("$('#'+'"+menuLayers.activeMenuID+"').css('visibility','hidden')", 200);
  },

  position: function(mnu, e) {
    var x = e.pageX? e.pageX: e.clientX + viewport.scrollX;
    var y = e.pageY? e.pageY: e.clientY + viewport.scrollY;

    if ( x + mnu.offsetWidth + this.offX > viewport.width + viewport.scrollX )
      x = x - mnu.offsetWidth - this.offX;
    else x = x + this.offX;

    if ( y + mnu.offsetHeight + this.offY > viewport.height + viewport.scrollY )
      y = ( y - mnu.offsetHeight - this.offY > viewport.scrollY )? y - mnu.offsetHeight - this.offY : viewport.height + viewport.scrollY - mnu.offsetHeight;
    else y = y + this.offY;

    mnu.style.left = x + "px"; mnu.style.top = y + "px";
    this.timer = setTimeout("$('#'+'" + menuLayers.activeMenuID + "').css('visibility','visible')", 200);
  },

  mouseoutCheck: function(e) {
    e = e? e: window.event;
    // is element moused into contained by menu? or is it menu (ul or li or a to menu div)?
    var mnu = $("#"+menuLayers.activeMenuID);
    var toEl = e.relatedTarget? e.relatedTarget: e.toElement;
    if ( mnu != toEl && !menuLayers.contained(toEl, mnu) ) menuLayers.hide();
  },

  // returns true of oNode is contained by oCont (container)
  contained: function(oNode, oCont) {
    if (!oNode) return; // in case alt-tab away while hovering (prevent error)
    while ( oNode = oNode.parentNode )
      if ( oNode == oCont ) return true;
    return false;
  },

  clearTimer: function() {
    if (menuLayers.timer) clearTimeout(menuLayers.timer);
  }

}

//Stats Guru JS Start

this.meetstsguru = function(){
	var expandTo = 1;
	var listClass = "meetstsguru"
	this.start = function(){
		var ul = document.getElementsByTagName("ul");
		for (var i=0;i<ul.length;i++){
			if(ul[i].className == listClass){
				create(ul[i]);
				buttons(ul[i])
			};
		};
	};
	this.create = function(list) {
		var items = list.getElementsByTagName("li");
		for(var i=0;i<items.length;i++){
			listItem(items[i]);
		};
	};

	this.listItem = function(li){
		if(li.getElementsByTagName("ul").length > 0){
			var ul = li.getElementsByTagName("ul")[0];
			ul.style.display = (depth(ul) <= expandTo) ? "block" : "none";
			li.className = (depth(ul) <= expandTo) ? "expanded" : "collapsed";
			li.over = true;
			ul.onmouseover = function(){li.over = false;}
			ul.onmouseout = function(){li.over = true;}
			li.onclick = function(){
				if(this.over){
					ul.style.display = (ul.style.display == "none") ? "block" : "none";
					this.className = (ul.style.display == "none") ? "collapsed" : "expanded";
				};
			};
		};
	};

	this.buttons = function(list){
		var parent = list.parentNode;
		//var p = document.createElement("p");
		//p.className = listClass;
		var span = document.createElement("span");
		span.innerHTML = expandText;
		span.onclick = function(){expand(list)};
		p.appendChild(span);
		var span = document.createElement("span");
		span.innerHTML = collapseText;
		span.onclick = function(){collapse(list)};
		p.appendChild(span);
		parent.insertBefore(p,list);
	};

	this.expand = function(list){
				var li = li[i].getElementsByTagName("li")[0];
				li.style.display = "block";
	};

	this.collapse = function(list){
				var li = li[i].getElementsByTagName("li")[0];
				li.style.display = "none";
	};
	this.depth = function(obj){
		var level = 1;
		while(obj.parentNode.className != listClass){
			if (obj.tagName == "UL") level++;
			obj = obj.parentNode;
		};
		return level;
	};
	//start();
};
window.onload = meetstsguru;

// StatsGuru View format Radio btns Js Start

function disableSelect(prefix, vid)
	{
	// vid gets enabled, anything beginning with prefix gets disabled
	var selects = document.getElementsByTagName('select');
	for(i=0; i<selects.length; i++)
		{
		if(selects[i].id.indexOf(prefix) == 0)
			{
			if(selects[i].id == vid)
				{
				selects[i].disabled = false;
				}
			else
				{
				selects[i].disabled = true;
				}
			}
		}
	}

function disableDivInputs(prefix, vid)
	{
	// all inputs within div=vid get enabled, anything within div beginning with prefix gets disabled
	var divs = document.getElementsByTagName('div');
	for(i=0; i<divs.length; i++)
		{
		if(divs[i].id.indexOf(prefix) == 0)
			{
			var inputs = divs[i].getElementsByTagName('input');

			for(j=0; j<inputs.length; j++)
				{
				if(divs[i].id == vid)
					{
					inputs[j].disabled = false;
					}
				else
					{
					inputs[j].disabled = true;
					}
				}
			}
		}
	}

function guruStart()
	{
	if (document.analysis)
		{
		if (typeof(analysisfocus) != 'undefined')
			{
			if (analysisfocus) // for putting the cursor in the analysis search form
				{
				document.analysis.search.focus();
				}
			}
		}

	guruViewChange();
	}
function guruViewChange()
	{
	if (document.gurumenu)
		{
		var divs = document.getElementsByTagName('div');

		typeval = document.gurumenu.type.value;
		if (typeof(typeval) == 'undefined')
			{
			for (i=0;i<document.gurumenu.type.length;i++)
				{
				if (document.gurumenu.type[i].checked)
					{
					typeval = document.gurumenu.type[i].value;
					}
				}
			}
		showBoxDiv('viewdiv_', 'viewdiv_'+typeval);
		disableDivInputs('viewdiv_', 'viewdiv_'+typeval);

		var viewval;
		// first find the value of view
		for (i=0;i<document.gurumenu.view.length;i++)
			{
			if (document.gurumenu.view[i].checked && !document.gurumenu.view.disabled)
				{
				viewval = document.gurumenu.view[i].value;
				}
			}
		// if not found (or disabled) then set it to default
		if (typeof(viewval) == 'undefined')
			{
			for (i=0;i<document.gurumenu.view.length;i++)
				{
				if (document.gurumenu.view[i].value == '')
					{
					document.gurumenu.view[i].checked = true;
					viewval = '';
					}
				}
			}
		// set it to 'default' if empty for the having/orderby divs
		if (viewval == '' || viewval == 'extras')
			{
			if (document.gurumenu.groupby)
				{
				document.gurumenu.groupby.disabled = false;
				}
			}
		else
			{
			if (document.gurumenu.groupby)
				{
				document.gurumenu.groupby.selectedIndex = 0;
				document.gurumenu.groupby.disabled = true;
				}
			}

		if (viewval == '')
			{
			viewval = 'default';
			}
		//alert('orderbydiv_'+typeval+'_'+viewval);
		showBoxDiv('havingdiv_', 'havingdiv_'+typeval+'_'+viewval);
		disableSelect('havingselect_', 'havingselect_'+typeval+'_'+viewval);

		showBoxDiv('orderbydiv_', 'orderbydiv_'+typeval+'_'+viewval);
		disableSelect('orderbyselect_', 'orderbyselect_'+typeval+'_'+viewval);
		}
	}

function page_validate(thisform, limit)
	{
	with (thisform)
		{
		with (page)
			{
			if (value == null || !value.match(/^\d+$/))
				{
				alert('illegal "Go to page" value');
				focus();
				return false;
				}
			else if (value < 1 || value > limit)
				{
				alert('"Go to page" value must be between 1 and ' + limit);
				focus();
				return false;
				}
			else
				{
				return true;
				}
			}
		}
	}

/* Stats JS end */

/*** Js Desktop Score card *****/
function openS(URL, WindowName) {
        window.open(URL, WindowName, 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,titlebar=0,width=540,height=490');
        if (openS.opener == null)
		openS.opener = window;
        openS.opener.name = "opener";
        }

function openDesktop(URL, WindowName)
	{
	window.open(URL, WindowName, 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=340,height=287,left=0,top=0');
        if (openDesktop.opener == null)
		openDesktop.opener = window;
        openDesktop.opener.name = "opener";
	}
/*** Js Desktop Score end *****/

/* Global photo module */
first = 1;
galfirst = 1;
walfirst = 1;
scrsvrfirst = 1;

last = 10;
gallast = 10;
wallast = 10;
scrsvrlast = 10;

current = 1;
galcurrent = 1;
walcurrent = 1;
scrsvrcurrent = 1;
function nextPicture(){
   object = $('#ptsGalslide' + current);
   object.css("display","none");
   if (current == last){
	   current = 1;
	   }
   else {
	   current++;
	   }
   object = $('#ptsGalslide' + current);
   object.css("display","block");
}
function previousPicture() {
   object = $('#ptsGalslide' + current);
   object.css("display","none");
   if (current == first) {
   current = last;
   }
   else {
   current--;
   }
   object = $('#ptsGalslide' + current);
   object.css("display","block");
}
// Wall Paper Galslide
function nextGalslide(){
   object = $('#Galslide' + galcurrent);
   object.css("display","none");
   if (galcurrent == gallast){
	   galcurrent = 1;
	   }
   else {
	   galcurrent++;
	   }
   object = $('#Galslide' + galcurrent);
   object.css("display","block");
}
function previousGalslide() {
   object = $('#Galslide' + galcurrent);
   object.css("display","none");
   if (galcurrent == galfirst) {
   galcurrent = gallast;
   }
   else {
   galcurrent--;
   }
   object = $('#Galslide' + galcurrent);
   object.css("display","block");
}
function nextWalpaper(){
   object = $('#walPaperslide' + walcurrent);
   object.css("display","none");
   if (walcurrent == wallast){
	   walcurrent = 1;
	   }
   else {
	   walcurrent++;
	   }
   object = $('#walPaperslide' + walcurrent);
   object.css("display","block");
}
function previousWalpaper() {
   object = $('#walPaperslide' + walcurrent);
   object.css("display","none");
   if (walcurrent == walfirst) {
   walcurrent = wallast;
   }
   else {
  walcurrent--;
   }
   object = $('#walPaperslide' + walcurrent);
   object.css("display","block");
}
function nextScreensvr(){
   scrobject = $('#screenSvrslide' + scrsvrcurrent);
   scrobject.css("display","none");
   if (scrsvrcurrent == scrsvrlast){
	   scrsvrcurrent = 1;
	   }
   else {
	   scrsvrcurrent++;
	   }
   scrobject = $('#screenSvrslide' + scrsvrcurrent);
   scrobject.css("display","block");
}
function previousScreensvr() {
   scrobject = $('#screenSvrslide' + scrsvrcurrent);
   scrobject.css("display","none");
   if (scrsvrcurrent == scrsvrfirst) {
   scrsvrcurrent = scrsvrlast;
   }
   else {
   scrsvrcurrent--;
   }
   scrobject = $('#screenSvrslide' + scrsvrcurrent);
   scrobject.css("display","block");
}
/* Global photo module ends */
