var shared = require('./karma-shared.conf');

module.exports = function (config) {
    shared(config);

    config.set({
        frameworks: ['ng-scenario'],
        files: [
            'test/e2e/**/controllersSpec.js',
            'components/angular-mocks/angular-mocks.js'
        ],
        watch: {
            javascript: {
                files: 'app/**/*.js'
            }
        },
        autoWatch: true,
        urlRoot: '/_karma_/',
        proxies: {
            '/': 'http://blog3.ru/'
        }
    });
};
