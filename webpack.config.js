var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/web')
    .addEntry('mainCss', './assets/scss/main.scss')
    .addEntry('mainJs', './assets/js/main.js')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader(function (sassOption) {}, {
        resolveUrlLoader: false
    })
    .autoProvidejQuery();

module.exports = Encore.getWebpackConfig();