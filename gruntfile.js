module.exports = function ( grunt ) {

	// Configure tasks
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		uglify: {
			dev: {
				src: "assets/js/*.js",
				dest: "js/scripts.min.js"
			}
		},
		watch: {
			js: {
				files: ["assets/js/**"],
				tasks: ["uglify:dev"]
			},
			grunt: { files: ['gruntfile.js'] },
			css: {
				files: 'assets/css/*.css',
				tasks: ["postcss","cssmin"]
			}
		},
		cssmin: {
			my_target: {
			    files: [{
			      expand: true,
			      cwd: 'assets/css/',
			      src: [ '*.css', '!*.min.css' ], // 1
			      dest: '',
			      ext: '.min.css'
			    }]
			  }
		},
		postcss: {
		    options: {
				processors: [
		        	require('autoprefixer')({browsers: 'last 2 versions'}) // add vendor prefixes
		      	]
		    },
		    dist: {
				src: 'assets/css/*.css'
		    }
		}
	});

	// Load the plugins
	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.loadNpmTasks("grunt-contrib-watch");
	grunt.loadNpmTasks("grunt-contrib-cssmin");
	grunt.loadNpmTasks('grunt-postcss');

	// Register tasks
	grunt.registerTask("default", ["uglify:dev"]);

}