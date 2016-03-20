var showed = false;
function showDpts(){
  //$('#dptsOverview').toggle('slow', function(){});
  if(showed){
    $("#dptsOverview").hide('slide', {direction: 'left'}, 200);
    showed = false;
  }
  else{
    $("#dptsOverview").show('slide', {direction: 'left'}, 200);
    showed = true;
    if(showedcont) showContact();
    if(showedab) showAbout();
  }
}

var showedab = false;
function showAbout(){
  //$('#aboutOverview').toggle('slow', function(){});
  if(showedab){
    $("#aboutOverview").hide('slide', {direction: 'left'}, 200);
    showedab = false;
  }
  else{
    $("#aboutOverview").show('slide', {direction: 'left'}, 200);
    showedab = true;
    if(showedcont) showContact();
    if(showed) showDpts();
  }
}

var showedcont = false;
function showContact(){
  //$('#aboutOverview').toggle('slow', function(){});
  if(showedcont){
    $("#contactOverview").hide('slide', {direction: 'left'}, 200);
    showedcont = false;
  }
  else{
    $("#contactOverview").show('slide', {direction: 'left'}, 200);
    showedcont = true;
    if(showed) showDpts();
    if(showedab) showAbout();
  }
}
