const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
	mix.styles([
	'bootstrap.min.css',
	'style.css',
	'ionicons.min.css',
	'dataTables.tableTools.css',
	'dataTables.bootstrap.min.css',
	'responsive.bootstrap.min.css',
	'buttons.bootstrap.min.css'
	], 'public/css/all.css');
});
