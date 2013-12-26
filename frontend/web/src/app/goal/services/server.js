'use strict';
// services in angular.js is lazy, but socket must be opened ASAP
// i know about .run() on service, but it's critical time
(function () {

    // WAMP session object
    var sess;
    var prefix = 'http://' + document.domain + '/api/v1/';

    function onConnect(session) {
        sess = session;
//        sess._subscribe = sess.subscribe;
//        sess.subscribe = function (id, callback) {
//            sess._subscribe(id, function (data) {
//                $rootScope.$apply(function () {
//                    callback && callback(data);
//                });
//            })
//        };
    }

    function onDisconnect(code, reason) {
        sess = null;
        console.log("Connection lost (" + code + " " + reason + ")");
    }

    // connect to WAMP server
    ab.connect('ws://' + document.domain + ':8047/', onConnect, onDisconnect, {
        'maxRetries': 60000,
        'retryDelay': 1000
    });

    angular.module('eg.goal').service('egWampSession', ['$q', '$rootScope', 'alertService', function ($q, $rootScope, alertService) {
        return sess;
    }]);

    angular.module('eg.goal').factory('$socketResource', ['$q', '$rootScope', 'egWampSession', 'alertService', function ($q, $rootScope, egWampSession, alertService) {
        //egWampSession.subscribe(prefix + "user", onEvent);

        function publishEvent() {
            sess.publish(prefix + "user", {a: "foo", b: "bar", c: 23});
        }

        var DEFAULT_ACTIONS = {
            'get': {
                url: 'view'
            },
            'save': {
                url: 'save'
            },
            'query': {
                url: 'index',
                isArray: true
            },
            'delete': {
                url: 'delete'
            }
        };

        var noop = angular.noop,
            forEach = angular.forEach,
            extend = angular.extend,
            copy = angular.copy,
            isFunction = angular.isFunction;


        var Resource = function (data) {
            copy(data || {}, this);
        }

        function resourceFactory(url, paramDefaults, actions) {
            actions = extend({}, DEFAULT_ACTIONS, actions);

            var baseUrl = prefix + url + '/';

            forEach(actions, function (action, name) {

                var value = action.isArray ? [] : new Resource();

                Resource[name] = function (url, params, callback) {
                    url = baseUrl + url;
                    var promise = egWampSession.call(url, params).then(function (response) {
                        var data = response.data,
                            promise = value.$promise;

                        if (data) {
                            // Need to convert action.isArray to boolean in case it is undefined
                            // jshint -W018
                            if (angular.isArray(data) !== (!!action.isArray)) {
                                throw $resourceMinErr('badcfg', 'Error in resource configuration. Expected ' +
                                    'response to contain an {0} but got an {1}',
                                    action.isArray ? 'array' : 'object', angular.isArray(data) ? 'array' : 'object');
                            }
                            // jshint +W018
                            if (action.isArray) {
                                value.length = 0;
                                forEach(data, function (item) {
                                    value.push(new Resource(item));
                                });
                            } else {
                                copy(data, value);
                                value.$promise = promise;
                            }
                        }

                        value.$resolved = true;

                        response.resource = value;

//                        $rootScope.$apply(function() {
                            callback(response)
//                        });

                        return response;
                    });
                    // we are creating instance / collection
                    // - set the initial promise
                    // - return the instance / collection
                    value.$promise = promise;
                    value.$resolved = false;
                    return value;
                };

                Resource.prototype['$' + name] = function (params, success, error) {
//                Resource['$' + name] = function (params, success, error) {
                    if (isFunction(params)) {
                        error = success;
                        success = params;
                        params = {};
                    }

                    var result = Resource[name](action.url, params, success);
                    return result.$promise || result;
                };
            });

            return Resource;
        }

        return resourceFactory;
    }]);

})();