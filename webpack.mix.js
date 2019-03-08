let mix = require('laravel-mix')

mix.setPublicPath('dist')
	.copy('dist', '../../public/vendor/settings-bundle')
	.js('resources/js/bundle.js', '')
	//.sass('resources/sass/bundle.scss', 'css')
