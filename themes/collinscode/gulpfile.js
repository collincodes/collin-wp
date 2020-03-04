// gulp dependencies
const autoprefixer = require("gulp-autoprefixer");
const babel = require("gulp-babel");
const browserSync = require("browser-sync").create();
const cleanCSS = require("gulp-clean-css");
const concat = require("gulp-concat");
const eslint = require("gulp-eslint");
const { series, parallel, src, dest, watch } = require("gulp");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");

// browsersync and paths
const serverURL = "http://localhost";
const paths = {
  compiled: "./compiled",
  css: "./css/*.css",
  js: "./js/*.js",
  sass: "./sass/**/*.sass",
  scripts: "./js/scripts.js",
  templates: "./**/*.php"
};

// sass task
const sassTask = () => {
  return (
    src("sass/**/main.sass")
      // compress & minify
      .pipe(
        sass({
          outputStyle: "compressed"
        }).on("error", sass.logError)
      )
      // add autoprefixers
      .pipe(
        autoprefixer({
          overrideBrowserslist: ["last 2 versions"]
        })
      )
      // rename file
      .pipe(rename("styles.min.css"))
      .pipe(dest(paths.compiled))
      .pipe(browserSync.stream())
  );
};

// scripts task
const scriptsTask = () => {
  return src(paths.scripts)
    .pipe(
      babel({
        presets: ["@babel/env"]
      })
    )
    .pipe(uglify())
    .pipe(rename("scripts.min.js"))
    .pipe(dest(paths.compiled));
};

// lint task
const lintTask = () => {
  return src([paths.scripts])
    .pipe(eslint())
    .pipe(eslint.format());
};

// minify and concat all extra css
const compileCssTask = () => {
  return src(paths.css)
    .pipe(
      cleanCSS({
        compatibility: "ie8"
      })
    )
    .pipe(concat("extra-css.min.css"))
    .pipe(dest(paths.compiled));
};

// minify and concat all extra js
const compileJsTask = () => {
  return src([paths.js, "!./js/scripts.js"])
    .pipe(
      uglify().on("error", function(e) {
        console.log(e);
      })
    )
    .pipe(concat("extra-scripts.min.js"))
    .pipe(dest(paths.compiled));
};

const reload = cb => {
  browserSync.reload();
  cb();
};

const watchAll = () => {
  browserSync.init({
    proxy: serverURL,
    open: false
  });
  watch(paths.sass, { events: "all" }, sassTask);
  watch(paths.scripts, { events: "all" }, series(scriptsTask, lintTask));
  watch(paths.templates, { events: "change" }, reload);
};

const tasks = series(
  sassTask,
  scriptsTask,
  lintTask,
  compileCssTask,
  compileJsTask
);

exports.default = series(tasks, watchAll);
