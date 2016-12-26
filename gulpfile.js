var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var concatCss = require('gulp-concat-css');
gulp.task('minify', function() {
  return gulp.src(['app/webroot/css/plugins/bootstrap/css/bootstrap.min',
	  'app/webroot/css/fonts/style.css',
	  'app/webroot/css/main.css',
	  'app/webroot/css/main-responsive.css',
	  'app/webroot/plugins/iCheck/skins/all.css',
	  'app/webroot/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css',
	  'app/webroot/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
	  'app/webroot/css/theme_light.css',
	  'app/webroot/plugins/select2/select2.css',
	  'app/webroot/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css',
	  'app/webroot/plugins/bootstrap-modal/css/bootstrap-modal.css',
	  'app/webroot/css/developer.css',
	  'app/webroot/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
	  'app/webroot/plugins/ladda-bootstrap/dist/ladda-themeless.css',
	  
	  ])
    .pipe(concatCss("bundle.css"))
    .pipe(gulp.dest('app/webroot/css/build'));
});