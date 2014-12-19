'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var jsFileList = [
    // Foundation Vendor
    "bower_components/foundation/js/vendor/fastclick.js",
    "bower_components/foundation/js/vendor/placeholder.js",

    // Foundation Core
    "bower_components/foundation/js/foundation/foundation.js",
    "bower_components/foundation/js/foundation/foundation.abide.js",
    "bower_components/foundation/js/foundation/foundation.accordion.js",
    "bower_components/foundation/js/foundation/foundation.alert.js",
    "bower_components/foundation/js/foundation/foundation.clearing.js",
    "bower_components/foundation/js/foundation/foundation.dropdown.js",
    "bower_components/foundation/js/foundation/foundation.equalizer.js",
    "bower_components/foundation/js/foundation/foundation.interchange.js",
    "bower_components/foundation/js/foundation/foundation.joyride.js",
    "bower_components/foundation/js/foundation/foundation.magellan.js",
    "bower_components/foundation/js/foundation/foundation.offcanvas.js",
    "bower_components/foundation/js/foundation/foundation.orbit.js",
    "bower_components/foundation/js/foundation/foundation.reveal.js",
    "bower_components/foundation/js/foundation/foundation.tab.js",
    "bower_components/foundation/js/foundation/foundation.tooltip.js",
    "bower_components/foundation/js/foundation/foundation.topbar.js",
    'assets/js/_*.js'
  ];

  grunt.initConfig({
    jshint: {
      options: {
        "bitwise": true,
        "browser": true,
        "curly": true,
        "eqeqeq": true,
        "eqnull": true,
        "esnext": true,
        "immed": true,
        "jquery": true,
        "latedef": true,
        "newcap": true,
        "noarg": true,
        "node": true,
        "strict": false,
        "trailing": true,
        "undef": true,
        "globals": {
          "jQuery": true,
          "alert": true
        }
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.js',
        '!assets/js/ie.js',
        '!assets/**/*.min.*'
      ]
    },
    sass: {
      options: {
        includePaths: [
          'bower_components/foundation/scss',
          'bower_components/bourbon/dist'
        ]
      },
      dev: {
        options: {
          style: 'expanded'
        },
        files: {
          'assets/css/main.css': [
            'assets/sass/main.scss'
          ],
          'assets/css/editor-style.css': [
            'assets/sass/editor-style.scss'
          ],
          'assets/css/font-awesome.css': [
            'bower_components/fontawesome/scss/font-awesome.scss'
          ]
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [jsFileList],
        dest: 'assets/js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [jsFileList]
        }
      },
      ie: {
        files: {
          'assets/js/ie.js': [
            'bower_components/respond/dest/respond.src.js',
            'bower_components/selectivizr/selectivizr.js'
          ]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        src: 'assets/css/main.css'
      }
    },
    csscomb: {
      options: {
        config: '.csscomb.json'
      },
      files: {
        'assets/css/main.css': ['assets/css/main.css'],
      }
    },
    pixrem: {
      options: {
        rootvalue: '16px',
        replace: true
      },
      dev: {
        src: ['assets/css/main.css'],
        dest: 'assets/css/rem-fallback.css'
      }
    },
    cssjanus: {
      dev: {
        ext: '-rtl.css',
        expand: true,
        src: [
          'assets/css/main.css'
        ]
      }
    },
    cssmin: {
      minify: {
        keepSpecialComments: 0,
        expand: true,
        cwd: 'assets/css/',
        src: ['*.css', '!*.min.css', '!rem-fallback.css', '!main-rtl.css'],
        dest: 'assets/css/',
        ext: '.min.css'
      }
    },
    copy: {
      main: {
        expand: true,
        flatten: true,
        filter: 'isFile',
        src: 'bower_components/fontawesome/fonts/*',
        dest: 'assets/fonts/'
      },
    },
    modernizr: {
      build: {
        devFile: 'bower_components/modernizr/modernizr.js',
        outputFile: 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            ['assets/js/scripts.min.js'],
            ['assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
    // https://www.npmjs.org/package/grunt-wp-i18n
    makepot: {
      target: {
        options: {
          domainPath: '/languages/',
          potFilename: '{%= prefix %}.pot',
          type: 'wp-theme'
        }
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: 'assets/manifest.json',
          querystring: {
            style: '{%= prefix %}_css',
            script: '{%= prefix %}_js'
          }
        },
        files: {
          'inc/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    clean: {
      dist: {
        src: [
          'assets/css/*',
          'assets/fonts/*',
          'assets/js/*.js',
          'assets/js/vendor/',
          '!assets/js/_*.js',
        ]
      }
    },
    imagemin: {
      dist: {
        files: [{
          progressive: true,
          expand: true,
          cwd: 'assets/img/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'assets/img/'
        }]
      }
    },
    watch: {
      sass: {
        files: [
          'assets/sass/*.scss',
          'assets/sass/**/*.scss'
        ],
        tasks: [
          'stylesheets',
          'notify:sass'
        ]
      },
      js: {
        files: [
          jsFileList,
          '<%= jshint.all %>'
        ],
        tasks: [
          'scripts',
          'notify:js'
        ]
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'assets/css/main.css',
          'assets/js/scripts.js',
          'templates/*.php',
          '*.php'
        ]
      }
    },
    versioncheck: {
      options: {
        skip: ["semver", "npm", "lodash"],
        hideUpToDate: false
      }
    },
    notify: {
      sass: {
        options: {
          title: 'Grunt, grunt!',
          message: 'Sass is Sassy'
        }
      },
      js: {
        options: {
          title: 'Grunt, grunt!',
          message: 'JS is all good'
        }
      },
      dev: {
        options: {
          title: 'Grunt, grunt!',
          message: 'Development processed without errors.'
        }
      },
      build: {
        options: {
          title: 'Grunt, grunt!',
          message: 'We\'ll do it live!'
        }
      }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('stylesheets', [
    'sass',
    'autoprefixer',
    'csscomb',
    'pixrem',
    'cssjanus'
  ]);
  grunt.registerTask('scripts', [
    'jshint',
    'copy',
    'uglify:ie',
    'concat'
  ]);
  grunt.registerTask('dev', [
    'clean',
    'stylesheets',
    'scripts',
    'notify:dev'
  ]);
  grunt.registerTask('build', [
    'dev',
    'cssmin',
    'uglify',
    'modernizr',
    'version',
    'imagemin',
    'makepot',
    'notify:build'
  ]);
};
