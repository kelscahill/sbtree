module.exports = function(grunt) {

    // Paths you can change:
    var siteConfig = {
        outputFolder: 'public/',            // output from build processes
        buildFolder: 'assets/',
        harpCompileFolder: 'static/',
        siteURL: "http://localhost:9000/"       // used for YSlow, validation, uncss
    };

    var allTemplates = ["<%= config.outputFolder %>**/*.html", "<%= config.outputFolder %>**/*.php", "<%= config.outputFolder %>**/*.ejs"];

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        config: siteConfig,
        concat: {
            css: {
                src: [
                    '<%= config.buildFolder %>css/*'
                ],
                dest: '<%= config.outputFolder %>css/styles.css'
            },
            js: {
                separator: ";",
                src: [
                    '<%= config.buildFolder %>scripts/*'
                ],
                dest: '<%= config.outputFolder %>js/main.js'
            }
        },
        cssmin: {
            css: {
                src: '<%= config.outputFolder %>css/styles.css',
                dest: '<%= config.outputFolder %>css/styles.min.css'
            }
        },
        uglify: {
            js: {
                drop_console: true,
                files: {
                    '<%= config.outputFolder %>js/main.min.js': [ '<%= config.outputFolder %>js/main.js' ]
                }
            }
        },
        sass: {
            dist: {
                options: {
                    outputStyle: 'nested', // libsass doesn't support expanded yet
                    precision: 10,
                    includePaths: [ '<%= config.buildFolder %>sass', require('node-bourbon').includePaths],
                },
                files: {
                    '<%= config.buildFolder %>css/main.css': '<%= config.buildFolder %>sass/main.scss'
                }
            },
        },
        validation: {
            options: {
                reset: grunt.option('reset') || true,
                stoponerror: false,
                remotePath: '<%= config.siteURL %>',
                remoteFiles: [ 'index.html' ]                           // NOTE: you can specify more remote files to check here.
            },
            files: {
                src: [ '<%= config.outputFolder %>empty.html' ]         // NOTE: you can add static HTML files here.. There must be atleast one file or this fails
            }
        },
        yslow: {
            options: {
                thresholds: {
                    weight: 180,
                    speed: 1000,
                    score: 80,
                    requests: 15
                }
            },
            pages: {
                    files: [
                    {
                        src: '<%= config.siteURL %>index.html'          // NOTE: you can specify more files here..
                    }
                ]
            }
        },
        uncss: {
          dist: {
            options: {
                ignore: ['.uncss-keep'],
                htmlroot     : siteConfig.outputFolder,
                stylesheets: [ '<%= config.siteURL %>/css/styles.min.css' ],
                urls: [ siteConfig.siteURL ]                            // NOTE: you must list all site .html files or url's here for uncss to work.
            },
            files: {
                // NOTE: the file here is basically a dummy file.. Grunt is a bit dumb.
                './httpdocs/css/styles-uncss.min.css': [ '<%= config.outputFolder %>empty.html' ]
            }
          }
        },
        "regex-check": {
            // NOTE: Add your templates extension to the list of files to check here.
            headers: {
                options: {
                    pattern : /<h1>/g,
                    negative: true,
                    label: "Must have an H1 tag"
                },
                files: { src: allTemplates }

            },
            description: {
                options: {
                    pattern : /meta\s{1,}name=['"]description['"]\s{1,}content=['"][a-zA-Z0-9\s]{3,}['"]/g,
                    negative: true,
                    label: "Must have a META description"
                },
                files: { src: allTemplates }

            },
            title: {
                options: {
                    pattern : /<title>[a-zA-Z0-9\s&;-]{1,}<\/title>/g,
                    negative: true,
                    label: "Must have a title"
                },
                files: { src: allTemplates }

            },
            keywords: {
                options: {
                    pattern : /meta\s{1,}name=['"]keywords['"]\s{1,}content=['"][a-zA-Z0-9\s]{3,}['"]/g,
                    negative: true,
                    label: "Must have a META keywords"
                },
                files: { src: allTemplates }
            },
            facebook: {
                options: {
                    pattern : /meta\s{1,}property=['"]og:description['"]\s{1,}content=['"][a-zA-Z0-9\s]{3,}['"]/g,
                    negative: true,
                    label: "No Facebook og:description"
                },
                files: { src: allTemplates }
            }

        },
        watch: {
            sassify: {
                files: [ '<%= config.buildFolder %>sass/*'],
                tasks: ['sass:dist']
            },
            images: {
                files: [ '<%= config.buildFolder %>images/**'],
                options: {
                    livereload: true,
                },
            },
            css: {
                files: [ '<%= config.buildFolder %>css/*'],
                tasks: [ 'concat:css', 'cssmin' ],
                options: {
                    livereload: true,
                },
            },
            js: {
                files: [ '<%= config.buildFolder %>scripts/*.js'],
                tasks: ['concat:js', 'uglify'  ],
                options: {
                    livereload: true,
                },
            },
            html: {
                files: [ '<%= config.outputFolder %>**/*.{html,ejs,php}', '<%= config.outputFolder %>**/.{png,jpg,gif,svg,ico}'],
                options: {
                    livereload: true,
                }
            },
        },
        harp: {
            server: {
                server: true,
                source: '.'
            },
            compile: {
                source: '.',
                dest: '<%= config.harpCompileFolder %>'
            }
        },
        concurrent: {
            dev: ['watch', 'harp:server', 'open:dev'],
            options: {
                logConcurrentOutput: true
            }
        },
        open : {
            dev : {
                path: 'http://localhost:9000',
                app: 'Google Chrome'
            }
        }
    });



    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-harp');
    grunt.loadNpmTasks('grunt-harp-post');
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-html-validation');
    grunt.loadNpmTasks('grunt-uncss');
    grunt.loadNpmTasks('grunt-yslow');
    grunt.loadNpmTasks('grunt-regex-check');
    grunt.loadNpmTasks('grunt-open');
    grunt.loadNpmTasks('grunt-exec');


    //grunt.file.setBase('/')
    grunt.registerTask('test-html', [ 'validation', 'regex-check:headers', 'regex-check:description', 'regex-check:title', 'regex-check:keywords', 'regex-check:facebook' ]);
    grunt.registerTask('test-performance', [ 'yslow' ]);
    grunt.registerTask('build', ['sass', 'concat:css', 'cssmin:css', 'concat:js', 'uglify:js']);
    grunt.registerTask('default', ['concurrent:dev' ]);
    grunt.registerTask('start', ['concurrent:dev' ]);
    grunt.registerTask('compile', ['default', 'harp:compile']);
    grunt.registerTask('pushlive', ['default', 'harp:compile']);
};
