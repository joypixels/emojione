module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            files: ['gruntfile.js', 'lib/js/emojione.js']
        },
        jsonlint: {
            files: {
                src: ['emoji.json','emoji_strategy.json']
            }
        },
        // BUILD EMOJI ONE AWESOME CSS (SASS -> CSS)
        sass: {
            dist: {
                files: {
                    'extras/css/emojione-awesome.css': 'lib/emojione-awesome/emojione-awesome.scss'
                }
            }
        },
        uglify: {
            options: {
                // the banner is inserted at the top of the output
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
				mangle: false,
				ASCIIOnly: true
            },
            dist: {
                files: {
                    'lib/js/<%= pkg.name %>.min.js': ['lib/js/<%= pkg.name %>.js']
                }
            }
        },
        // Minify Project CSS
        cssmin: {
            target: {
                files: {
                    'extras/css/emojione.min.css': ['extras/css/emojione.css']
                }
            }
        },
        watch: {
            files: ['<%= jshint.files %>'],
            tasks: ['jshint']
        },
        // run QUnit tests
        qunit: {
            all: ['lib/js/tests/tests.html']
        }

    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-jsonlint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-qunit');
    grunt.registerTask('default', ['jshint','jsonlint', 'sass', 'uglify', 'cssmin']);
    grunt.registerTask('travis', ['qunit']);
};