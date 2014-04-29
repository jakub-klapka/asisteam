module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		sass: {
			options: {
				style: 'expanded',
				precision: 7
			},
			all_files: {
				files: [{
					expand: true,
					cwd: 'css',
					src: '*.scss',
					dest: 'build/css',
					ext: '.css'
				}]
			},
			one_file: {
				src: 'css/' + grunt.option('filename') + '.scss',
				dest: 'build/css/' + grunt.option('filename') + '.css'
			}
		},
		autoprefixer: {
			all_files: {
				files: [{
					expand: true,
					cwd: 'build/css',
					src: '*.css',
					dest: 'build/css'
				}]
			},
			one_file: {
				src: 'build/css/' + grunt.option('filename') + '.css',
				dest: 'build/css/' + grunt.option('filename') + '.css'
			}
		},
		imagemin: {
			all_files: {
				files: [{
					expand: true,
					cwd: 'images',
					src: '**/*.{jpg,jpeg,gif,png}',
					dest: 'build/images'
				}]
			}
		},
		copy: {
			all_notsupported_images: {
				files: [{
					expand: true,
					cwd: 'images',
					src: ['**','!**/*.{jpg,jpeg,gif,png}'],
					dest: 'build/images'
				}]
			},
			icon_layout: {
				src: 'temp/icons.data.svg.css',
				dest: 'css/icons/_icons-layout.scss'
			}
		},
		concat: {
			options: {
				separator: ';'
			},
			layout: {
				src: ['js/layout/*.js'],
				dest: 'build/js/layout.js'
			}

		},
		closureCompiler: {
			options: {
				compilerFile: 'c:\\Program Files (x86)\\Google Closure compiler\\compiler.jar'
			},
			layout: {
				src: 'build/js/layout.js',
				dest: 'build/js/layout.js'
			},
			root_files: {
				files: [{
					expand: true,
					cwd: 'js',
					src: '*.js',
					dest: 'build/js'
				}]
			}
		},
		grunticon: {
			options: {
			},
			prepared_from_svgmin: {
				files: [{
					expand: true,
					cwd: 'temp/to_process',
					src: ['*.svg'],
					dest: 'temp'
				}]
			}
		},
		svgmin: {
			layout_icons: {
				files: [{
					expand: true,
					cwd: 'icons/layout',
					src: ['*.svg'],
					dest: 'temp/to_process'
				}]
			}
		},
		clean: {
			temp: {
				src: 'temp/'
			}
		},
		watch: {
			css: {
				files: ['css/*.scss'],
				tasks: ['css_all_files']
			},
			livereload: {
				options: {
					livereload: true
				},
				files: ['build/**/*.{css,js,jpg,jpeg,png,gif}']
			},
			images: {
				files: ['images/*.*'],
				tasks: ['all_images']
			},
			icons_layout: {
				files: ['icons/layout/*.*'],
				tasks: ['icon_layout']
			}
		},
		concurrent: {
			options: {
				//logConcurrentOutput: true
			},
			dev: ['watch:css', 'watch:livereload', 'watch:images', 'watch:icons_layout']
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-closure-tools');
	grunt.loadNpmTasks('grunt-grunticon');
	grunt.loadNpmTasks('grunt-svgmin');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-concurrent');

	//helpers
	grunt.registerTask('css_all_files', ['sass:all_files', 'autoprefixer:all_files']);
	grunt.registerTask('css', ['sass:one_file', 'autoprefixer:one_file']);
	grunt.registerTask('all_images', ['imagemin:all_files', 'copy:all_notsupported_images']);
	grunt.registerTask('js_layout', ['concat:layout', 'closureCompiler:layout']);
	grunt.registerTask('js_root_files', ['closureCompiler:root_files']);
	grunt.registerTask('icon_layout', ['svgmin:layout_icons', 'grunticon:prepared_from_svgmin', 'copy:icon_layout', 'clean:temp']);


	// Default task(s).
	grunt.registerTask('default', [
		'icon_layout', //have to run before css, as it will be included in css
		'css_all_files',
		'all_images',
		'js_root_files',
		'js_layout',
	]);
	grunt.registerTask('dev', ['concurrent:dev']);

};