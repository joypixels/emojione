module.exports = function (grunt) {

  grunt.initConfig({



    pkg: grunt.file.readJSON('package.json'),

    sass: {                              // Task
      dist: {                            // Target
        options: {                       // Target options
          style: 'compressed'
        },
        files: {                         // Dictionary of files
          'assets/sprites/emojione.sprites.css': 'assets/sprites/emojione.sprites.scss'
        }
      }
    },

    //Sprite Creator, run 'grunt sprite':
    sprite:{
      all: {
        src: 'assets/png/*.png',
        destImg: 'assets/sprites/emojione.sprites.png',
        destCSS: 'assets/sprites/emojione.sprites.scss',
        'cssTemplate': 'assets/sprites/emojione.sprites.mustache',
        'algorithm': 'binary-tree',
        'cssVarMap': function (sprite) {
          sprite.name = 'emojione-' + sprite.name;
        }
      }
    }

  });

  // Load in `grunt-spritesmith`
  grunt.loadNpmTasks('grunt-spritesmith');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('default', ['sprite', 'sass']);
}