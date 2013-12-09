'use strict';

angular.module('eg.goal').directive('egEditor', function ($debounce) {
    var some = {};

    return {
        restrict: 'E',
        scope: {
            ngModel: '=',
            ngChange: '&',
            ngFocus: '&',
            submodel: '=',
            placeholder: '&',
            fg: '&'
        },
        template: '<div contenteditable="true" class="eg-editor" strip-br="true" ng-model="ngModel" ng-change="onChange()" ng-focus="ngFocus()"></div>',
        link: function ($scope, element, attrs) {
            $scope.onChange = $debounce($scope.ngChange, 1000);
        }
    };
});

angular.module('eg.goal').directive('egGoalPane', function () {
    return {
        restrict: 'E',
        replace: false,
        transclude: true,
        scope: {
        },
        link: function ($scope, element, attrs) {
            element.addClass('');
        }
    };
});

angular.module('eg.goal', []).directive('contenteditable', ['$timeout', function ($timeout) {
    return {
        restrict: 'A',
        require: '?ngModel',
        link: function ($scope, $element, attrs, ngModel) {
            // don't do anything unless this is actually bound to a model
            if (!ngModel) {
                return
            }

            // view -> model
            $element.on('input', function (e) {
                var html, html2, rerender
                html = $element.html()
                rerender = false
                if (attrs.stripBr && attrs.stripBr !== "false") {
                    html = html.replace(/<br>$/, '')
                }
                if (attrs.noLineBreaks && attrs.noLineBreaks !== "false") {
                    html2 = html.replace(/<div>/g, '').replace(/<br>/g, '').replace(/<\/div>/g, '')
                    if (html2 !== html) {
                        rerender = true
                        html = html2
                    }
                }
                ngModel.$setViewValue(html)
                if (rerender) {
                    ngModel.$render()
                }
                if (html === '') {
                    // the cursor disappears if the contents is empty
                    // so we need to refocus
                    $timeout(function () {
                        $element[0].blur()
                        $element[0].focus()
                    })
                }
            })

            // model -> view
            var oldRender = ngModel.$render
            ngModel.$render = function () {
                var el, el2, range, sel
                if (!!oldRender) {
                    oldRender()
                }
                $element.html(ngModel.$viewValue || '')
            }
        }
    }
}]);