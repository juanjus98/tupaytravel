module.exports = function(grunt){
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		less: {
			development:{
				options:{
					paths:['build/less/']
				},
				files:{
					"assets/css/bootstrap.css" : "node_modules/bootstrap/less/bootstrap.less",
					"assets/css/font-awesome.css" : "build/less/font-awesome/less/font-awesome.less",
					"assets/css/style.css" : "build/less/website/website.less",
				}
			}
		},
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'assets/css',
					src: ['style.css','font-awesome.css','bootstrap.css'],
					dest: 'assets/css',
					ext: '.min.css'
				}]
			}
		},
		jshint: {
			all:['build/js/*.js']
		},
		concat: {
			dist:{
				src: ['build/js/variables.js','build/js/functions.js','build/js/app.js'],
				dest: 'assets/js/app.js' 
			}
		},
		uglify: {
			my_target: {
				files: {
					'assets/js/app.min.js': ['assets/js/app.js']
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.loadNpmTasks('grunt-contrib-jshint'); //Valida javascript
	grunt.loadNpmTasks('grunt-contrib-concat'); //Une archivos javascript
	grunt.loadNpmTasks('grunt-contrib-uglify'); //Minifica archivos javascript

	grunt.registerTask('default',['less','cssmin','jshint','concat','uglify']);

}