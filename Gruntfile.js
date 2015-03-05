/**
 * Created by manfred on 27.02.15.
 */
//aufruf in Rootfolder: /mnt/aragon-www/til/html
// mit grunt watch:styles

module.exports = function (grunt){
    //Grunt configuration
    //files:
    grunt.initConfig({
        less: {
            app: {
                files: {'typo3conf/ext/sitetemplates/Resources/Public/Css/bootstrap.css': 'typo3conf/ext/sitetemplates/Resources/Public/Bootstrap/bootstrap-master/less/bootstrap.less'}

            }
        },
        watch:{
            styles:{
                files:  ["typo3conf/ext/sitetemplates/Resources/Public/Bootstrap/bootstrap-master/less/**/*.less"],
                tasks:  ["less:app"],
                options: {spawn: false}
            }
        }
    });

    //Load plugins
    grunt.loadNpmTasks("grunt-contrib-less");
    grunt.loadNpmTasks("grunt-contrib-watch");

}
