function $(v){
	return	document.getElementById(v);
}

function filter(){
	var r = $("results");
	var f = $("filter").value.toLowerCase();
	
	if(f == "filter" || f == "")
		return unfilter();
	
	var dark = true;
	for(var i = 1; i < r.rows.length; i++){
		cols = r.rows[i].cells;
		found = false;
		if(cols[0].textContent.toLowerCase().indexOf(f) > -1)
			found = true;
		if(cols[1].textContent.toLowerCase().indexOf(f) > -1)
			found = true;
		if(cols[2].textContent.toLowerCase().indexOf(f) > -1)
			found = true;
		if(cols[4].textContent.toLowerCase().indexOf(f) > -1)
			found = true;
		
		if(found){
			r.rows[i].style.display = "";
			if(dark){
				dark = false;
				r.rows[i].style.background = "#CCC";
			}else{
				dark = true;
				r.rows[i].style.background = "#FFF";
			}
		}else{
			r.rows[i].style.display = "none";	
		}
	}
}

function unfilter(){
	var r = $("results");
	for(var i = 1; i < r.rows.length; i++){
		if(i%2 == 1)
			r.rows[i].style.background = "#CCC";
		else
			r.rows[i].style.background = "#fff";
		r.rows[i].style.display = "";
	}
}

function filterFocus(){
	var f = $("filter");
	if(f.value == "Filter"){
		f.style.color = "#000";
		f.value = "";
	}
}

function filterBlur(){
	var f = $("filter");
	if(f.value == ""){
		f.style.color="#666";
		f.value="Filter";
	}
}
