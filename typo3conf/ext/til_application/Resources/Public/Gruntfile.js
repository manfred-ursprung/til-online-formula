/**
 * Created by manfred on 06.03.16.
 */
module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        //pkg: 'application',
        less: {
            //My own addon
            app: {
                src: 'Less/style.less',
                dest: 'Css/application.css'
            }
        },
        watch: {
            less: {
                files: 'Less/*.less',
                tasks: ['less:app', 'ftpPut']
            },
        },
        ftpPut: {
            options: {
                host: "ftp.mum-webdesign.de",
                user: "414277-til",
                pass: "w/jaacrLnje3",
            },
            upload: {
                files: {
                    "/htdocs/typo3conf/ext/til_application/Resources/Public/": "Css/*"
                }
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-ftp-push');
    grunt.loadNpmTasks('grunt-ftp');

    // Default task(s).
    grunt.registerTask('default', ['less']);

};
