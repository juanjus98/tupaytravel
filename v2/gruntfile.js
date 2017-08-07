module.exports = function(grunt){
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		less: {
			development:{
				options:{
					paths:['less/']
				},
				files:{
					"css/bootstrap.css" : "less/bootstrap.less",
					"css/general.css" : "less/admin-lte.less", //Waadmin
					"css/style.css" : "less/website/website.less", //Website
					"css/font-awesome.css" : "less/font-awesome.less",
					"css/hover.css" : "less/hover/hover.less"
				}
			}
		},
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'css',
					src: ['bootstrap.css','general.css', 'style.css','font-awesome.css','hover.css'],
					dest: 'css',
					ext: '.min.css'
				}]
			}
		},
		jshint: {
			all:['js/scripts/*.js']
		},
		concat: {
			basic_and_extras: {
				files: {
					'js/general.js': ['js/scripts/variables.js','js/scripts/functions.js','js/scripts/main.js'],
					'js/wa-scripts.js': ['js/website/variables.js','js/website/functions.js','js/website/main.js'],
				},
			},
		},
		uglify: {
			my_target: {
				files: {
					'js/general.min.js': ['js/general.js'],
					'js/wa-scripts.min.js': ['js/wa-scripts.js']
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.loadNpmTasks('grunt-contrib-jshint'); //Valida javascript
	grunt.loadNpmTasks('grunt-contrib-concat'); //Une archivos javascript
	grunt.loadNpmTasks('grunt-contrib-uglify'); //Minifica archivos javascript

	grunt.registerTask('default',['less','cssmin','jshint','concat','uglify'])

}