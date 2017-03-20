

dojo={};
require(['dojo/dom-style', 'dojo/query', 'dojo/dom-geometry', 'dojo/dom', 'dojo/_base/array', 'dojo/window', 'dojo/on', 'dojo/dom-construct', 'dojo/_base/window', 'dojo/dom-attr', 'dojo/fx', 'dojo/_base/fx',
	 'dojo/_base/lang', 'dojo/dom-class', 'dojo/has', 'dojo/NodeList-dom', 'dojo/NodeList-traverse', 'dojo/NodeList-manipulate', 'dojo/sniff'],
	function(style, query, domGeom, dom, array, win, on, construct, baseWin, attribute, fx, baseFx, lang, domClass, has){
		dojo.style=style;
		dojo.query=query;
		dojo.geo=domGeom;
		dojo.dom=dom;
		dojo.array=array;
		dojo.win=win;
		dojo.on=on;
		dojo.construct=construct;
		dojo.baseWin=baseWin;
		dojo.attr=attribute;
		dojo.fx=fx;
		dojo.baseFx=baseFx;
		dojo.lang=lang;
		dojo.domClass=domClass;
		dojo.has=has;
});

