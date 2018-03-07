const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const uglify = require('gulp-uglify');
const pump = require('pump');
const babel = require('gulp-babel');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const rename = require("gulp-rename");
const changed = require('gulp-changed');

const themePath = '/opt/lampp/htdocs/wp-agency/wp-content/themes/wp-agency/';

// Optimize images
gulp.task('imageMin', () =>
  gulp.src('src/img/*')
      .pipe(changed(themePath + 'img'))
      .pipe(imagemin())
      .pipe(gulp.dest(themePath + 'img'))
);

// Compile custom Sass
gulp.task('sass', () => 
  gulp.src('src/sass/*.scss')
      .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
      .pipe(gulp.dest(themePath))
);


// Javascripts minify(+concat +convert ES6 +uglify)
gulp.task('minify', () =>
gulp.src(['src/js/*.js'])
.pipe(concat('main.js'))
.pipe(babel({
  presets: ['env']
}))
.pipe(uglify())
.pipe(gulp.dest(themePath + 'js'))
);

// Copy styles
gulp.task('copyStyles', () => 
  gulp.src([
    'node_modules/dist/css/bootstrap.min.css',
    'node_modules/fullpage.js/dist/jquery.fullpage.min.css',
  ])
      .pipe(gulp.dest(themePath + 'css'))
);

// Copy Scripts
gulp.task('copyScripts', () => 
  // jquery, fullpage.js 
  gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/fullpage.js/dist/jquery.fullpage.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
  ])
      .pipe(gulp.dest(themePath + 'js'))
)

// Copy wp sources
const wpSrc = [
  'src/screenshot.png',
  'src/*.php'
];

gulp.task('copyWp', () => 
  gulp.src(wpSrc)
      .pipe(gulp.dest(themePath))
)

// default
gulp.task('default', [
  'imageMin',
  'sass',
  'minify',
  'copyStyles',
  'copyScripts',
]);

// watch
gulp.task('watch', () => {
  gulp.watch('src/img/*', ['imageMin']);
  gulp.watch('src/sass/*.scss', ['sass']);
  gulp.watch('node_modules/bootstrap/scss/bootstrap.scss', ['bootstrap']);
  gulp.watch('src/js/*.js', ['minify']);
  gulp.watch(wpSrc, ['copyWp']);
})