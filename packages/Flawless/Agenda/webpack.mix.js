const {
    mix
} = require("laravel-mix");
require("laravel-mix-merge-manifest");

if (mix.inProduction()) {
    var publicPath = 'publishable/assets';
} else {
    var publicPath = "../../../public/vendor/webkul/agenda/assets";
}

mix.setPublicPath(publicPath).mergeManifest();
mix.disableNotifications();

mix.inProduction()

mix.js(
        [
            __dirname + "/src/Resources/assets/js/app.js"
        ],
        "js/agenda.js"
    )
    .copy(__dirname + "/src/Resources/assets/img", publicPath + "/images")
    .sass(__dirname + "/src/Resources/assets/sass/app.scss", "css/agenda.css")
    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}