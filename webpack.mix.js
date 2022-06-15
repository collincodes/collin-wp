/**
 * webpack.mix.js
 * 
 * Using laravel-mix for a simple webpack wrapper
 */

let mix = require('laravel-mix')

mix.setPublicPath('./dist')

mix.copy('src/library', 'dist/library')
mix.copy('src/assets/images', 'dist/images')
mix.copy([
  'src/*.php',
  'src/templates/**/*.php'
], 'dist')

mix.js('src/assets/app.js', 'dist')
mix.postCss('src/assets/app.css', 'dist', [
  require('tailwindcss')
])

mix.version()

mix.browserSync({
  proxy: 'localhost:8082',
  files: ['src/templates/**/*.php']
})
