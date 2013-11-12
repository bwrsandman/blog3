var shared = function (config) {
    config.set({
        basePath: '../',
        frameworks: ['mocha'],
        reporters: ['progress'],
        browsers: ['PhantomJS', 'PhantomJS_custom'],

        // you can define custom flags
        customLaunchers: {
            'PhantomJS_custom': {
                base: 'PhantomJS',
                options: {
                    settings: {
                        webSecurityEnabled: false
                    }
                }
            }
        },
        autoWatch: true,

        // these are default values anyway
        singleRun: false,
        reportSlowerThan: 500,
        colors: true
    });
};

shared.files = [
    'test/mocha.conf.js',

    //3rd Party Code
    'components/angular/angular.js',

    //Test-Specific Code
    'node_modules/chai/chai.js',
    'test/lib/chai-should.js',
    'test/lib/chai-expect.js'
];

module.exports = shared;
