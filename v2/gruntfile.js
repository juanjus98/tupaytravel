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
					"assets/css/waadmin.css" : "build/less/AdminLTE/AdminLTE.less",
				}
			}
		},
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'assets/css',
					src: ['style.css','font-awesome.css','bootstrap.css','waadmin.css'],
					dest: 'assets/css',
					ext: '.min.css'
				}]
			}
		},
		jshint: {
			all:['build/js/waadmin/*.js', 'build/js/website/*.js']
		},
		concat: {
			basic_and_extras: {
				files: {
					'assets/js/waadmin.js': ['build/js/waadmin/variables.js','build/js/waadmin/functions.js','build/js/waadmin/main.js'],
					'assets/js/website.js': ['build/js/website/variables.js','build/js/website/functions.js','build/js/website/main.js'],
				},
			},
		},
		uglify: {
			my_target: {
				files: {
					'assets/js/waadmin.min.js': ['assets/js/waadmin.js'],
					'assets/js/website.min.js': ['assets/js/website.js']
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