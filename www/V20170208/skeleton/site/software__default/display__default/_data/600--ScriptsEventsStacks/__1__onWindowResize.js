// Event
onWindowResize.stack(function(){surfaces.play({parent:this});});
//onWindowResize.stack(function(){displaySwitch.play({'funcs':['off']});});
//onWindowResize.stack(function(){ alert('600 windowResize: '+surfaces.screen.w)});
onWindowResize.stack(function(){geometry.play();});
//onWindowResize.stack(function(){displaySwitch.play({'funcs':['on']});});
onWindowResize.stack(function(){imageReady.play();});