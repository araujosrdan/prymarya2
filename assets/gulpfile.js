// Iniciando os módulos
const { src, dest, watch, series, parallel } = require("gulp");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
const postcss = require("gulp-postcss");
const replace = require("gulp-replace");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const uglify = require("gulp-uglify");

const cbString = new Date().getTime();

// Variáveis ARQUIVOS
const files = {
    scssPath: "scss/**/*.scss",
    jsPath: "js/**/*.js"
}

// Tarefa SASS
function scssTask(){
    return src(files.scssPath)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(sourcemaps.write("."))
        .pipe(dest("dist")
    );
}
// Tarefa JS
function jsTask(){
    return src(files.jsPath)
        .pipe(concat("all.js"))
        .pipe(uglify())
        .pipe(dest("dist")
    );
}

// Tarefa CACHE
function cacheBustTask(){
    return src([
         "../views/template.php",
         "../views/welcome.php",
         "../views/login.php",
         "../views/404.php"
        ])
        .pipe(replace(/cb=\d+/g, "cb=" + cbString))
        .pipe(dest("../views/")
    );
}

// Tarefa WATCH
function watchTask(){
    watch([files.scssPath, files.jsPath],
        parallel(scssTask, jsTask));
}

// Tarefa BUILD
exports.default = series(
    parallel(scssTask, jsTask),
    cacheBustTask,
    watchTask
);