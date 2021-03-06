module.exports = function(grunt) {

	var assembly_data = grunt.file.readYAML('data.yml');
	// Project configuration.
	grunt.initConfig({
		sass: {
			options: {
				style: 'compressed',
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
			},
			icon_reference: {
				src: 'temp/icons.data.svg.css',
				dest: 'css/icons/_icons-reference.scss'
			},
			icon_home: {
				src: 'temp/icons.data.svg.css',
				dest: 'css/icons/_icons-home.scss'
			},


			includes: {
				files: [{
					expand: true,
					cwd: 'includes',
					src: '**/*.*',
					dest: 'build',
					dot: true
				}]
			}
		},
		concat: {
			options: {
				separator: ';'
			},
			layout: {
				src: ['js/layout/*.js'],
				dest: 'build/js/layout.js'
			},
			home: {
				src: ['js/home/*.js'],
				dest: 'build/js/home.js'
			},
			email_decode: {
				src: ['js/email_decode/*.js'],
				dest: 'build/js/email_decode.js'
			},

		},
		closureCompiler: {
			options: {
				compilerFile: 'c:\\Program Files (x86)\\Google Closure compiler\\compiler.jar'
			},
			layout: {
				src: 'build/js/layout.js',
				dest: 'build/js/layout.js'
			},
			home: {
				src: 'build/js/home.js',
				dest: 'build/js/home.js'
			},
			email_decode: {
				src: 'build/js/email_decode.js',
				dest: 'build/js/email_decode.js'
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
			},
			reference_icons: {
				files: [{
					expand: true,
					cwd: 'icons/reference',
					src: ['*.svg'],
					dest: 'temp/to_process'
				}]
			},
			home_icons: {
				files: [{
					expand: true,
					cwd: 'icons/home',
					src: ['*.svg'],
					dest: 'temp/to_process'
				}]
			},

		},
		clean: {
			temp: {
				src: 'temp/'
			}
		},
		watch: {
			options: {
				interrupt: true
			},
			css: {
				files: ['css/*.scss'],
				tasks: ['css_livereload']
			},
			assemble: {
				files: ['layouts/*.*', 'pages/*.*', 'partials/*.*', 'php_pages/*.*', 'sitemap.hbs'],
				tasks: 'newer:assemble'
			},
			includes: {
				options: {
					dot: true
				},
				files: ['includes/**/*.*'],
				tasks: 'newer:copy:includes'
			},
			form: {
				files: ['form.php'],
				tasks: 'replace'
			},
			sitemap: {
				files: ['sitemap.php'],
				tasks: 'shell:sitemap'
			},
			featured_nav: {
				files: ['featured_nav.php'],
				tasks: 'shell:featured_nav'
			},

			livereload: {
				options: {
					livereload: true
				},
				files: ['build/**/*.{css,js,jpg,jpeg,png,gif,html,php}', '*.html', 'js/*.js']
			}
		},
		concurrent: {
			options: {
				logConcurrentOutput: true,
				limit: 10
			},
			dev: ['watch:css', 'watch:livereload', 'watch:assemble', 'watch:includes', 'watch:form', 'watch:sitemap', 'watch:featured_nav',]
		},
		assemble: {
			dist: {
				options: {
					layout: "default.hbs",
					layoutdir: 'layouts',
					partials: 'partials/*.{hbs,md}',
					data: [
						'data.yml',
						'featured_nav.yml']
				},
				files: [{
					expand: true,
					cwd: 'pages',
					src: '**/*.{md,hbs}',
					dest: 'build'
				}]
			},
			browserconfig: {
				options: {
					data: 'data.yml',
					ext: '.xml',
				},
				src: ['browserconfig.hbs'],
				dest: 'build'
			},

		},
		replace: {
			options: {
				patterns: [
					{
						match: 'abspath',
						replacement: assembly_data.abspath
					},


				]
			},
			dist: {
				src: 'form.php',
				dest: 'build/form.php'
			}
		},
		shell: {
			sitemap: {
				command: 'php -f sitemap.php'
			},
			featured_nav: {
				command: 'php -f featured_nav.php'
			},

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
	grunt.loadNpmTasks('assemble' );
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-replace');
	grunt.loadNpmTasks('grunt-shell');

	//helpers
	grunt.registerTask('css_all_files', ['sass:all_files', 'autoprefixer:all_files']);
	grunt.registerTask('css_livereload', ['newer:sass:all_files', 'newer:autoprefixer:all_files']);
	grunt.registerTask('all_images', ['imagemin:all_files', 'copy:all_notsupported_images']);
	grunt.registerTask('js_layout', ['concat:layout', 'closureCompiler:layout']);
	grunt.registerTask('js_home', ['concat:home', 'closureCompiler:home']);
	grunt.registerTask('js_email_decode', ['concat:email_decode', 'closureCompiler:email_decode']);
	grunt.registerTask('js_root_files', ['closureCompiler:root_files']);
	grunt.registerTask('icon_layout', ['svgmin:layout_icons', 'grunticon:prepared_from_svgmin', 'copy:icon_layout', 'clean:temp']);
	grunt.registerTask('icon_reference', ['svgmin:reference_icons', 'grunticon:prepared_from_svgmin', 'copy:icon_reference', 'clean:temp']);
	grunt.registerTask('icon_home', ['svgmin:home_icons', 'grunticon:prepared_from_svgmin', 'copy:icon_home', 'clean:temp']);


	// Default task(s).
	grunt.registerTask('default', [
		'icon_layout', //have to run before css, as it will be included in css
		'icon_reference', //have to run before css, as it will be included in css
		'icon_home', //have to run before css, as it will be included in css
		'css_all_files',
		'all_images',
		'js_root_files',
		'js_layout',
		'js_home',
		'js_email_decode',
		'assemble',
		'replace',
		'copy:includes',
		'shell:sitemap',
		'shell:featured_nav'
	]);
	grunt.registerTask('dev', ['concurrent:dev']);

};

module.exports.register = function (Handlebars, options)  {
	Handlebars.registerHelper("debug", function(optionalValue) {
		console.log("Current Context");
		console.log("====================");
		console.log(this);

		if (optionalValue) {
			console.log("Value");
			console.log("====================");
			console.log(optionalValue);
		}
	});
};

