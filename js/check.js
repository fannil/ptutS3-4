function check(){
	document.getElementById("ajouter").disabled = true;

	if(document.getElementById("nomDept").value.length > 0 
		&& document.getElementById("desc").value.length > 0 
		&& document.getElementById("lat").value.length > 0 
		&& document.getElementById("lng").value.length > 0){
		document.getElementById("ajouter").disabled = false;
	}

	var timeoutID = window.setTimeout(check, 250);
}