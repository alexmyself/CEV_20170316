uid=0;

onDomReady 		= new objWQueue();
onWindowResize 	= new objWQueue();
displaySwitch 	= new objWQueue(); // provide switch on/off display methods and list of registered object to hide when needed.
geoHelper 		= new classGeoHelper();
geometry 		= new objWQueue();
//geometry.stack(function(){ dojo.query('body > *').style('display', 'none');});
//geometry.stack(function(){ alert('geometry run'); });
imageReady 		= new objWQueue();
gallery			= new objWQueue();
surfaces 		= new objWQueue();