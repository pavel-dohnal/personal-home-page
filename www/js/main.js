require.config({
 
	paths: {
		'angular': 'libs/angular',
		'domReady': 'libs/domReady',
		'cs': 'libs/cs'
	},
	shim: {
		'angular': {
			exports: 'angular'
		}
	},
	deps: ['./bootstrap']
});