module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        cssjanus: {
            build: {
                src: 'style.css',
                dest: 'rtl.css'
            }
        }
    });
    grunt.loadNpmTasks('grunt-cssjanus');


    grunt.registerTask('default', ['cssjanus']);

};