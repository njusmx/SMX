function changeButtonStatusAndInputValue(obj1,message){//button,input
	// alert("csjcdscnsnkl");
	// alert(obj2);
	if(obj1.className=="upbutton"){
		obj1.className = "pushedbutton";
	}else{
		obj1.className ="upbutton";
	}
	// alert(message);
	var tmp = document.getElementById(message);
	if(tmp.value ==0){
		tmp.value = 1;
	}else{
		tmp.value = 0;
	}
} 

function changeButtonStatus(obj){//button,input
	if(obj.className=="btn btn-warning"){
		obj.className = "btn btn-default";
	}else{
		obj.className ="btn btn-warning";
	}
	if(obj.innerHTML=="<i class="+"\""+"icon-user-follow"+"\""+"></i>关注"){
		obj.innerHTML="<i class="+"\""+"icon-user-follow"+"\""+"></i>已关注";
	}else{
		obj.innerHTML="<i class="+"\""+"icon-user-follow"+"\""+"></i>关注";
	}
} 