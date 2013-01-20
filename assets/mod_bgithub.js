/**          Part of mod_BGitHub                        
 * Copyright (C) 2013 B Tasker
 * Released under GNU GPL V2
 * See License
 * 
 */

function switchtabs(active,cls,btnClass){
  
   var tabs = document.getElementsByClassName(cls),
   tabbuttons = document.getElementsByClassName(btnClass);
    
     for (var i=0; i<tabs.length; i++)
      {
	
	tabs[i].style.display = "none";
      }
  
    
  
     for (var i=0; i<tabbuttons.length; i++)
      {
	tabbuttons[i].className = 'BGHubTabSwitch';
      }
    
    document.getElementById(active+'Tab').style.display = 'block';
    document.getElementById(active+'But').className = 'BGHubActitab BGHubTabSwitch';
    
 
}