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
        // BUILD PNG SPRITES
        sprite:{
            pngsprites: {
                src: 'assets/png/*.png',
                dest: 'assets/sprites/emojione.sprites.png',
                destCss: 'assets/sprites/emojione.sprites.css',
                'cssTemplate': 'assets/sprites/emojione.sprites.mustache',
                'algorithm': 'binary-tree',
                'cssVarMap': function (sprite) {
                    sprite.name = 'emojione-' + sprite.name;
                },
                padding: 1
            }

        },
        // BUILD EMOJI ONE AWESOME CSS (SASS -> CSS)
        sass: {
            dist: {
                options: {
                    'sourcemap': 'none'
                },
                files: {
                    'assets/css/emojione-awesome.css': 'lib/emojione-awesome/emojione-awesome.scss'
                }
            }
        },
       // BUILD SVG SPRITES
       svgstore: {
          options: {
            prefix : 'emoji-', // symbol ID prefix
            svg: {
              viewBox : '0 0 64 64',
              xmlns: 'http://www.w3.org/2000/svg',
              "xmlns:xlink": "http://www.w3.org/1999/xlink"
            }
          },
          default : {
            files: {
              'assets/sprites/emojione.sprites.svg': ['assets/svg/*.svg']
            }
          }
        },
        uglify: {
            options: {
                // the banner is inserted at the top of the output
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
            },
            dist: {
                files: {
                    'lib/js/<%= pkg.name %>.min.js': ['lib/js/<%= pkg.name %>.js']
                }
            }
        },
        // OPTIMIZE PNGs
        imageoptim: {
            pngs: {
                src: ['assets/png', 'assets/png']
            },
            sprite: {
                src: ['assets/sprites', 'assets/sprites']
            }
        },
        // Minify Project CSS
        cssmin: {
            target: {
                files: {
                    'assets/css/emojione.min.css': ['assets/css/emojione.css'],
                    'assets/sprites/emojione.sprites.css': ['assets/sprites/emojione.sprites.css']
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
    grunt.loadNpmTasks('grunt-spritesmith');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-svgstore');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-jsonlint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-imageoptim');
    grunt.loadNpmTasks('grunt-contrib-qunit');
    //grunt.registerTask('default', ['jshint','jsonlint', 'sprite:pngsprites', 'sass', 'svgstore', 'uglify', 'cssmin', 'imageoptim']);
    grunt.registerTask('default', ['jshint','jsonlint', 'sass', 'svgstore', 'uglify', 'cssmin']);
    grunt.registerTask('travis', ['qunit']);
};