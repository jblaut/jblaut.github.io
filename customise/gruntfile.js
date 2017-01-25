module.exports = function(grunt){
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
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-express');
	grunt.registerTask('default',['sass']);
	grunt.registerTask('server',['express','watch']);
}