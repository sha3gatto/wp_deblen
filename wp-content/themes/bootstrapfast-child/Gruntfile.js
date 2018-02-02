module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build: {
				src: 'src/<%= pkg.name %>.js',
				dest: 'build/<%= pkg.name %>.min.js'
			}
		},
		compass: {
			dist: {
				options: {
					sassDir: 'sass/',
					cssDir: 'css/',
					environment: 'production'
				}
			},
			dev: {
				options: {
					sassDir: 'sass/',
					cssDir: 'css/'
				}
			}
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-compass');

	// Default task(s).
	grunt.registerTask('default', ['uglify']);
	grunt.registerTask('default', ['jshint', 'compass']);
};
