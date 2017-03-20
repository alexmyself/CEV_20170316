var profile = (function(){
	return {
		basePath: '.',
		releaseDir: '..\\build',
		action: "release",
		layerOptimize: 'closure',
		optimize: 'closure',
		selectorEngine: "acme",
		stripConsole: "warn",

		packages:[{name: "dojo", 		location: "dojo"},
			{name: "dojoobject", 		location: "01__jsToBuildAndIncludeWithDojo"}
		],

		layers : {
			'dojoBuild' : {
				include : [
					'dojoobject/lib/objDojo',
//					'dojoobject/lib/__4_geometry',
					'dojo/fx/Toggler'
				],
			boot : true
			}
		}
    };
})();