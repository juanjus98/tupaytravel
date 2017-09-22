module.exports = function(grunt){
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		less: {
			development:{
				options:{
					paths:['build/less/']
				},
				files:{
					/*"assets/css/bootstrap.css" : "node_modules/bootstrap/less/bootstrap.less",*/
					"assets/css/bootstrap.css" : "build/less/website/bootstrap.less",
					"assets/css/font-awesome.css" : "build/less/font-awesome/less/font-awesome.less",
					"assets/css/style.css" : "build/less/website/website.less",
					"assets/css/waadmin.css" : "build/less/AdminLTE/AdminLTE.less",
				}
			}
		},
		copy: {
			main: {
				files: [
		      /*{expand: true, cwd: 'node_modules/animate\.css/', src: ['animate.min.css'], dest: 'assets/css/'},
		      {expand: true, cwd: 'node_modules/wowjs/dist/', src: ['wow.min.js'], dest: 'assets/js/'},*/
		      {expand: true, cwd: 'node_modules/bootstrap-validator/dist/', src: ['*'], dest: 'assets/plugins/bootstrap-validator/'},
		      {expand: true, cwd: 'node_modules/lozad/dist/', src: ['*'], dest: 'assets/plugins/lozad/'},
		      ],
		  },
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
					'assets/js/website.js': ['build/js/website/variables.js','build/js/website/functions.js','build/js/website/app.js'],
					'assets/js/home.js': ['build/js/website/variables.js','build/js/website/functions.js','build/js/website/home.js'],
					'assets/js/main.js': ['build/js/website/variables.js','build/js/website/functions.js','build/js/website/main.js'],
					'assets/js/global.js': ['assets/plugins/jquery-ui/jquery-ui.js','assets/plugins/lightslider/js/lightslider.js','assets/plugins/fancybox/dist/jquery.fancybox.js','assets/plugins/sticky/jquery.sticky.js','assets/plugins/slimscroll/jquery.slimscroll.js','assets/plugins/emoji/emoji.js','assets/js/app.js'],
				},
			},
		},
		uglify: {
			my_target: {
				files: {
					'assets/js/waadmin.min.js': ['assets/js/waadmin.js'],
					'assets/js/website.min.js': ['assets/js/website.js'],
					'assets/js/home.min.js': ['assets/js/home.js'],
					'assets/js/main.min.js': ['assets/js/main.js'],
					'assets/plugins/sticky/jquery.sticky.min.js': ['assets/plugins/sticky/jquery.sticky.js'],
					'assets/plugins/emoji/emoji.min.js': ['assets/plugins/emoji/emoji.js'],
					'assets/js/global.min.js': ['assets/js/global.js']
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.loadNpmTasks('grunt-contrib-jshint'); //Valida javascript
	grunt.loadNpmTasks('grunt-contrib-concat'); //Une archivos javascript
	grunt.loadNpmTasks('grunt-contrib-uglify'); //Minifica archivos javascript

	grunt.loadNpmTasks('grunt-contrib-copy'); //Copiar archivos

	grunt.registerTask('default',['less','cssmin','jshint','concat','uglify', 'copy']);

}