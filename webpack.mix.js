const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/* mix.js('resources/js/app.js', 'public/js/site.js')
   .scripts('node_modules/popper.js/dist/popper.js', 'public/js/popper.js')
   .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
   .scripts('node_modules/feather-icons/dist/feather.js', 'public/js/feather.js')
   .scripts('resources/js/dropzone.js', 'public/js/dropzone.js')
   .sass('resources/sass/app.scss', 'public/css/site.css')
   .options({
       
      processCssUrls: false

   }); */
   


/*    mix.scripts(  ['node_modules/jquery-ui-dist/jquery-ui.js'], 'public/js/jquery.ui.js')
   .options({
       
      processCssUrls: false
   
   });  */

 mix.js('resources/js/app.js', 'public/js/site.js')
 .styles(['resources/css/frontend.css'], 'public/css/frontend.css')
 .scripts(['resources/js/custom.js'], 'public/js/frontend.js')
.sass('resources/sass/app.scss', 'public/css/site.css')
.sass('resources/sass/admin.scss', 'public/css/admin.css')
.options({
    
   processCssUrls: false

}); 


/* mix.js('resources/js/tinymce.js', 'public/js/tinymce/tinymce.js')
   .copyDirectory('node_modules/tinymce/skins', 'public/js/tinymce/skins')
   .scripts('node_modules/tinymce/plugins/emoticons/js/emojis.js', 'public/js/tinymce/emojis.js'); */