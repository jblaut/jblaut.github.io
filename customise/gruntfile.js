module.exports = function(grunt){
	require('load-grunt-tasks')(grunt);
	
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		sass:{
			compile:{
				files:{
					'app/styles/main.css' : 'app/styles/main.scss'
				}
			}
		},
		watch:{
			options:{
				livereload:true
			},
			files:['app/styles/*.scss'],
			tasks:['sass']
		},
		express:{
			all:{
				options:{
					port:9000,
					hostname:'localhost',
					bases:['app/.'],
					livereload:true
				}
			}
		},
		php: {
      dist: {
        options: {
					port:9000,
					hostname:'localhost',
					base:'app/.'
        }
      }
    }
	});
	
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-express');
	grunt.registerTask('default',['sass']);
	grunt.registerTask('s-js',['express','watch']);
	grunt.registerTask('s-php',['php:dist','watch']);
}