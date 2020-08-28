// globals
const port = 32;
const serverURL = `http://localhost:${port}`;

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
const inject = require("gulp-inject-string");
const clean = require("gulp-clean");

// browsersync and paths
const paths = {
  compiled: "./compiled",
  css: "./css/*.css",
  js: "./js/*.js",
  theme: {
    styles: "./src/styles/theme/theme.scss",
    scripts: "./src/scripts/theme/theme.js"
  },
  templates: "./**/*.php"
};

const hash = Math.random()
  .toString(36)
  .substring(7);

const cleanCompiled = () => {
  return src(compiled, {
    allowEmpty: true
  }).pipe(clean());
};

// sass task
const themeStyleTask = () => {
  return (
    src(paths.theme.styles)
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
      .pipe(rename(`theme-${hash}.min.css`))
      .pipe(dest(paths.compiled))
      .pipe(browserSync.stream())
  );
};

// inject new file name into functions.php
const injectCss = () => {
  return src("functions.php")
    .pipe(
      inject.replace(/theme(\-.{0,6})?\.min\.css/g, `theme-${hash}.min.css`)
    )
    .pipe(dest("./"));
};

// scripts task
const themeScriptTask = () => {
  return src(paths.theme.scripts)
    .pipe(
      babel({
        presets: ["@babel/env"]
      })
    )
    .pipe(uglify())
    .pipe(concat(`theme-${hash}.min.js`))
    .pipe(dest(paths.compiled));
};

// lint task
const lintTask = () => {
  return src([paths.theme.scripts])
    .pipe(eslint())
    .pipe(eslint.format());
};

// inject new file name into functions.php
const injectJs = () => {
  return src("functions.php")
    .pipe(inject.replace(/theme(\-.{0,6})?\.min\.js/g, `theme-${hash}.min.js`))
    .pipe(dest("./"));
};

// minify and concat all extra css
const extraCssTask = () => {
  return src(paths.css)
    .pipe(
      cleanCSS({
        compatibility: "ie8"
      })
    )
    .pipe(concat("extra.min.css"))
    .pipe(dest(paths.compiled));
};

// minify and concat all extra js
const extraJsTask = () => {
  return src(paths.js)
    .pipe(
      uglify().on("error", function(e) {
        console.log(e);
      })
    )
    .pipe(concat("extra.min.js"))
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
  watch(paths.theme.styles, { events: "all" }, themeStyleTask);
  watch(
    paths.theme.scripts,
    { events: "all" },
    series(themeScriptTask, lintTask)
  );
  watch(paths.templates, { events: "change" }, reload);
  // watch("../../plugins/collins-blocks/styles/scss/**/*.scss", {
  //   events: "change"
  // });
};

const tasks = series(
  cleanCompiled,
  themeStyleTask,
  themeScriptTask,
  lintTask,
  extraCssTask,
  extraJsTask,
  injectCss,
  injectJs
);

exports.default = series(tasks, watchAll);
