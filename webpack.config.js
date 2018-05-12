var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/web')
    .addEntry('main', './assets/scss/main.scss')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader(function (sassOption) {}, {
        resoleUrlLoader: false
    })
    .autoProvidejQuery();

module.exports = Encore.getWebpackConfig();