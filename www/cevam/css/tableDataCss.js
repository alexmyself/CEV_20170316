require(["dojo/dom-style", "dojo/query", "dojo/dom-geometry", "dojo/dom", "dojo/NodeList-dom", "dojo/NodeList-traverse", "dojo/NodeList-manipulate", "dojo/domReady!"], function(style, query, domGeom, dom){
	query('.tableData').style({
		'width':'100%',
		'border':'2px solid blue',
		'borderCollapse':'collapse',
		'marginBottom':'2em'
	});
	query('.tableData td, .tableData th').style({
			'border':'1px solid grey',
			'paddingLeft':'0.5em',
			'paddingRight':'1.5em',
			'backgroundColor':'AliceBlue',
			'fontFamily':'monospace',
			'textAlign':'left',
			'verticalAlign':'middle'
	});
	query('.tableData tr').odd().forEach(function(node, index, nodelist){
			query(node).children('td:not(.label)').style('backgroundColor','white');
			});
	query('.tableData th').style({
			'border':'1px dashed blue',
			'borderTop':'2px solid black',
	});
	query('.tableData .label').style({
			'fontSize':'0.9em',
			'paddingLeft':'0.2em',
			'backgroundColor':'White',
			'fontFamily':'verdana'
	});
	query('.tableData .icon').style({
			'verticalAlign':'top',
			'paddingLeft':'4em',
			'paddingTop':'2em'
	});
	query('.tableData .title').style({
			'fontSize':'1.5em',
			'borderBottom':'1px solid white',
			'fontFamily':'verdana'
	});
});
