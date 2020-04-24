//##################################################
//The main goal is to always give the user the latest version of js/css/image/fonts after the change is made to the server.

/*This is the most flexible option.This option allows you to use the following keys:
--source - required key, allows you to assemble the required part of the project
Takes the values [js, css, front, tpl]
   js - collects only JS for the front part
   css - collects only CSS for the front part
   front - collects the all frontend part
   tpl - collects the required theme only (requires additionally the --theme key)

   example: grunt repack --source=front

--new-ver - optional key, allows you to create a new collect folder
It is used by default when assembling a theme from color-tool and in the deploy.sh script.
if you do not use this key, then the executed command will update the files in the folder of the last build.

example: grunt repack --source=front --new-ver (collects a new version of the front part of the part)
                grunt repack --source=tpl --theme=Sky --new-ver (collects a new version of the Sky template)*/
				
//##################################################				

var extend = require('node.extend'); // jQuery.extend clone for nodejs

module.exports = function(grunt) {
	
	require('load-grunt-tasks')(grunt);
	
	var uglifyOpts = {
        banner: '/*! <%= pkg.name %>, <%= pkg.version %>, <%= grunt.template.today("yyyy-mm-dd") %> */\n',
        beautify: false,
        report: 'min', // gzip - too match time
        sourceMap: false,
        compress: {
            sequences: true, // join consecutive statemets with the “comma operator”
            properties: true, // optimize property access: a["foo"] → a.foo
            dead_code: true, // discard unreachable code
            drop_debugger: true, // discard “debugger” statements
            drop_console: true, // Discard console.* functions
            unsafe: false, // some unsafe optimizations (see below)
            conditionals: true, // optimize if-s and conditional expressions
            comparisons: true, // optimize comparisons
            evaluate: true, // evaluate constant expressions
            booleans: true, // optimize boolean expressions
            loops: true, // optimize loops
            unused: true, // drop unused variables/functions
            hoist_funs: true, // hoist function declarations
            hoist_vars: false, // hoist variable declarations
            if_return: true, // optimize if-s followed by return/continue
            join_vars: true, // join var declarations
            cascade: true, // try to cascade `right` into `left` in sequences
            side_effects: true, // drop side-effect-free statements
            warnings: true, // warn about potentially dangerous optimizations/code
            global_defs: {
                DEBUG: false,
                DEBUG_LOCAL: false
            }
        }
    };


    if (grunt.option('disable-js-compress')) {
        grunt.log.subhead('[*] Disabling js compress'.white.bold);
        uglifyOpts.compress = false;
        uglifyOpts.report = false;
    }

    // 1. Вся настройка находится здесь
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		
		/** ********************************************************************************************** */
        // version management
        bump: {
            options: {
                files: ['package.json'],
                updateConfigs: ['pkg'],
                commit: false,
                createTag: false,
                push: false,
                prereleaseName: false,
                regExp: false
            }
        },
		
		/** ********************************************************************************************** */
		//copy dependencies files to a specific folders
		copydeps: {            
			js_css: {            
			  options: {  
				minified: true,
				unminified: true,
				css: true,
				
				include: {
					/**
					   * Object syntax resembles { <src>: <dest> }, 
					   * where <dest> refers to a path relative to 
					   * your `dest/` directory. You can use
					   * '.' if no subfolder is desired. All <src>
					   * file paths are relative to the `node_modules/`
					   * directory.
					*/
					js: {
						'jquery-placeholder/jquery.placeholder.js': '.',
						'bootstrap/dist/js/bootstrap.bundle.min.js': '.',
						'pc-bootstrap4-datetimepicker/build/js/bootstrap-datetimepicker.min.js': '.',
						'moment/min/moment.min.js': '.'
					},
					
					css: {
						'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.min.css': '.'
					}
				}
			  },
			  pkg: 'package.json',

			  dest: {
				js:  'public/assets/js/dependencies/',
				css: 'public/assets/css/dependencies/'
			  }
			},
		},
		
		/** ********************************************************************************************** */
		clean: extend({}, {
            options: {
                //'no-write': true
            }
        }, grunt.file.readJSON('grunt/clean.json')),
		
		/** ********************************************************************************************** */
		concat: {
			
			css: {
				options: {

                },
                files: {
                    'public/assets/css/concatenated/style.css': [
                        'public/assets/css/dependencies/**/*.css',
						'public/assets/css/style.css',
                    ]
                }
			}
		},
		
		/** ********************************************************************************************** */
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'public/assets/css/concatenated/',
					src: ['style.css'],
					dest: 'public/assets/css/concatenated/',
					ext: '.css'
				}]
			}
		},
		
		/** ********************************************************************************************** */
        compass: {
            prod_prepare: {
                options: extend({}, grunt.file.readJSON('grunt/compass.prod.json'), {
                    clean: true
                })
            },
            prod: {
                options: extend({}, grunt.file.readJSON('grunt/compass.prod.json'), {})
            },
            dev_prepare: {
                options: extend({}, grunt.file.readJSON('grunt/compass.dev.json'), {
                    clean: true
                })
            },
            dev: {
                options: extend({}, grunt.file.readJSON('grunt/compass.dev.json'), {})
            }
        },

    });
	
	// ================================Custom Grunt TASKS================================ \\

	 /**
     * building frontend
     */
    grunt.registerTask('repack', function(dev) {
        var fs = require("fs");
        var repackConf = grunt.file.readJSON('grunt/repack.json');
        var newJSON = '{"from":"' + repackConf.from + '", "to":"' + repackConf.to + '", "prefix":' + (repackConf.prefix + 1) + '}';
        repackConf.src = '**';

        if (grunt.option('new-ver')) {
            fs.writeFileSync("grunt/repack.json", newJSON, "ascii");
            repackConf.prefix += 1;
        }

        if (grunt.option('source')) {
			if (grunt.option('source') == 'front') {
                repackConf.to += repackConf.prefix;
                repackConf.src  = ['css/concatenated/**', 'js/concatenated/**', 'images/**', 'fonts/**'];
            } else {
                repackConf.from += repackPaches[grunt.option('source')];
                repackConf.to += repackConf.prefix + '/' + grunt.option('source');
                repackConf.src = repackPaches[grunt.option('source')] + '/*'
            }

            console.log('Current version: ' + repackConf.prefix);
        } else {
            grunt.fail.warn('need enter source (for example: --source=front)');
            return;
        }

        grunt.config.merge({
            copy: {
                main: {
					expand: true,
                    cwd:  repackConf.from,
                    src:  repackConf.src,
                    dest: repackConf.to
                }
            }
        });

        grunt.task.run(['copy']);
    });
	
	//compile css
    grunt.registerTask('css', function(dev) {
        dev = dev || 'dev';

        var opt = [
				'clean:css_all',
				'copydeps',
				'compass:dev',
				'concat:css'
			];
        if (dev != 'dev') {
            opt = [
					'clean:css_all',
					'copydeps',
					'compass:'+dev,
					'concat:css',
					'cssmin'
				];
        }
        grunt.log.subhead('Config: '+dev);
        grunt.task.run(opt);
    });

    //prepare js files before build
    grunt.registerTask('js', function(dev) {
        dev = dev || 'dev';
        var opt = [
            'clean:js_all',
			'copydeps',
            'clean:js_concats'
        ];
        if (dev == 'prod') {
            opt = [
                'clean:js_all',
				'copydeps',
                'clean:js_concats',
            ];
        }
        grunt.log.subhead('Config: '+dev);
        grunt.task.run(opt);
    });
	
	// deploy to server process
    grunt.registerTask('deploy', function(dev) {
        dev = dev || 'dev';

        grunt.task.run([
            'bump',
            'js:'+dev,
            'css:'+dev
        ]);

        grunt.option('source', "front");
        grunt.option('new-ver', true);
        grunt.task.run('repack');
    });

};