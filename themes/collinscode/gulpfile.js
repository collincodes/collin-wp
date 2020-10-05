// gulp dependencies
const autoprefixer = require("autoprefixer");
const babel = require("gulp-babel");
const browserSync = require("browser-sync").create();
const concat = require("gulp-concat");
const eslint = require("gulp-eslint");
const { series, parallel, src, dest, watch } = require("gulp");
const rename = require("gulp-rename");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const inject = require("gulp-inject-string");
const clean = require("gulp-clean");
const postcss = require("gulp-postcss");
const tailwindcss = require("tailwindcss");
const cssnano = require("cssnano");

const serverUrl = "http://localhost";

/** Define paths **/
const paths = {
  dist: "./dist/",
  glob: {
    styles: "./src/scss/**/*.scss",
    scripts: "./src/js/**/*.js",
  },
  theme: {
    styles: "./src/scss/theme.scss",
    scripts: "./src/js/theme.js",
    enqueues: "./library/enqueues.php",
  },
  templates: "./**/*.php",
};

/** Versioning for stylesheet and scripts **/
const hash = Math.random().toString(36).substring(7);

/** Clean dist directory **/
const cleanDist = () => {
  return src(paths.dist, {
    allowEmpty: true,
  }).pipe(clean());
};

/** Optimize stylesheet **/
const styles = () => {
  return (
    src(paths.theme.styles)
      .pipe(sass().on("error", sass.logError))
      // postcss functions
      .pipe(
        postcss([
          autoprefixer({ overrideBrowserslist: ["last 2 versions"] }),
          tailwindcss("./tailwind.config.js"),
          cssnano(),
        ])
      )
      // rename file
      .pipe(rename(`theme-${hash}.min.css`))
      .pipe(dest(paths.dist))
      .pipe(browserSync.stream())
  );
};

/** Inject new css into enqueues **/
const injectCss = () => {
  return src(paths.theme.enqueues)
    .pipe(
      inject.replace(/theme(\-.{0,6})?\.min\.css/g, `theme-${hash}.min.css`)
    )
    .pipe(dest("./library/"));
};

/** Optimize scripts **/
const scripts = () => {
  return src(paths.theme.scripts)
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(uglify())
    .pipe(concat(`theme-${hash}.min.js`))
    .pipe(dest(paths.dist));
};

/** Lint scripts **/
const lint = () => {
  return src(paths.theme.scripts).pipe(eslint()).pipe(eslint.format());
};

/** Inject new scripts into enqueues **/
const injectJs = () => {
  return src(paths.theme.enqueues)
    .pipe(inject.replace(/theme(\-.{0,6})?\.min\.js/g, `theme-${hash}.min.js`))
    .pipe(dest("./library/"));
};

const reload = (cb) => {
  browserSync.reload();
  cb();
};

/** Watch all tasks for new changes **/
const watchAll = () => {
  browserSync.init({
    proxy: serverUrl,
    open: false,
  });
  watch(paths.glob.styles, { events: "all" }, styles);
  watch(paths.glob.scripts, { events: "all" }, series(scripts, lint));
  watch(paths.templates, { events: "change" }, reload);
};

/** Perform all tasks in order **/
const tasks = series(cleanDist, styles, scripts, lint, injectCss, injectJs);

exports.default = series(tasks, watchAll);
