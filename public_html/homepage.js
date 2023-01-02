
function panelOpen(){
	document.getElementById("blur").style.marginLeft="20%";
	document.getElementById("myPanel").style.marginLeft="-25%";
	document.getElementById("myPanel").style.width="20%";
	document.getElementById("myPanel").style.display = "block";
	document.getElementById("panelButton").style.display="none";
	document.getElementById("header").style.width="80%";
	document.getElementById("rightColumnContainer").style.paddingLeft="13%";
	document.getElementById("rightColumnContainerAdmin").style.paddingLeft="13%";
	try{//homepage exclusive functions
		document.getElementById("bannerContent").style.left="50%";
		document.getElementById("tile2Content").style.left="6%";
		document.getElementById("tile2Content").style.top="43.5%";
		document.getElementById("tile5Container").style.width="54%";
		document.getElementById("tile5Content").style.marginLeft="27%";
		document.getElementById("tile6Content").style.marginLeft="25%";
	}catch(e){
	}
	try{//login exclusive functions
		document.getElementById("formBox").style.marginLeft="0%";
	}catch(e){
	}
	try{//portal exclusive functions
		document.getElementById("tableContainer").style.marginLeft="-20%";
		document.getElementById("adminControlBar").style.marginLeft= "-20%";
	}catch(e){
	}
}
function panelClose(){
	document.getElementById("blur").style.marginLeft="0%";
	document.getElementById("myPanel").style.display = "none";
	document.getElementById("panelButton").style.display="inline-block";	
	document.getElementById("header").style.width="100%";
	document.getElementById("rightColumnContainer").style.paddingLeft="17%";
	document.getElementById("rightColumnContainerAdmin").style.paddingLeft="10%";
	try{//homepage exclusive functions
		document.getElementById("bannerContent").style.left="50%";
		document.getElementById("tile2Content").style.left="15%";
		document.getElementById("tile2Content").style.top="46%";
		document.getElementById("tile5Container").style.width="67%";
		document.getElementById("tile5Content").style.marginLeft="30%";
		document.getElementById("tile6Content").style.marginLeft="29%";
	}catch(e){
	}
	try{//login exclusive functions
		document.getElementById("formBox").style.marginLeft="20%";
	}catch(e){
	}
	try{//portal exclusive functions
		document.getElementById("tableContainer").style.marginLeft="-5%";
		document.getElementById("adminControlBar").style.marginLeft= "-5%";
	}catch(e){
	}
}
function returnForm() {
    var userTypeVal = document.getElementById('user_Type').value;
    if (userTypeVal == "UserUndergradPartTime") {
        document.getElementById("UserUndergradPartTime").style.display = "block";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserUndergradFullTime") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "block";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserGraduatePartTime") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "block";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserGraduateFullTime") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "block";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserFacultyPartTime") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "block";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserFacultyFullTime") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "block";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserResearchStaff") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "block";
        document.getElementById("UserAdmin").style.display = "none";
    }
    if (userTypeVal == "UserAdmin") {
        document.getElementById("UserUndergradPartTime").style.display = "none";
        document.getElementById("UserUndergradFullTime").style.display = "none";
        document.getElementById("UserGraduatePartTime").style.display = "none";
        document.getElementById("UserGraduateFullTime").style.display = "none";
        document.getElementById("UserFacultyPartTime").style.display = "none";
        document.getElementById("UserFacultyFullTime").style.display = "none";
        document.getElementById("UserResearcher").style.display = "none";
        document.getElementById("UserAdmin").style.display = "block";
    }
}
