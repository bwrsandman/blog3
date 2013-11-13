var shared = require('./karma-shared.conf');

module.exports = function (config) {
    shared(config);

    config.set({
        frameworks: ['ng-scenario'],
        files: [
            'test/e2e/**/controllersSpec.js'
        ],
        urlRoot: '/_karma_/',
        proxies: {
            '/': 'http://blog3.ru/'
        }
    });
};
