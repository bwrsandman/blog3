angular.module('eg.goal').directive('egEditor', function ($debounce) {

    return {
        restrict: 'E',
        require: '^ngModel',
        scope: {
            ngModel: '=',
            ngChange: '&',
            ngFocus: '&',
            submodel: '=',
            placeholder: '&',
            fg: '&'
        },
        template: '<div text-angular ng-model="ngModel" ng-change="onChange()" ng-focus="ngFocus()">{{ngModel}}</div>',
        link: function ($scope, element, attrs) {
            var editor = element.children('div');

            //css
            editor
                .addClass('eg-editor');

            $scope.onChange = $debounce($scope.ngChange, 1000);
        }
    };
})
;

angular.module('eg.goal').directive('egGoalPane', function ($debounce) {
    return {
        restrict: 'E',
        replace: false,
        transclude: true,
        scope: {
        },
        link: function ($scope, element, attrs) {
        }
    };
});

angular.module('eg.goal').directive('contenteditable', ['$timeout', '$compile', function ($timeout, $compile) {


    return {
        restrict: 'A',
        require: '?ngModel',
        link: function ($scope, $element, attrs, ngModel) {
            // don't do anything unless this is actually bound to a model
            if (!ngModel) {
                return
            }

            ngModel.$render = function () {
                $element.html(ngModel.$modelValue || '');
            };


            // view -> model
            var read = function (e) {
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
            }


            // Listen for change events to enable binding
            $element.on('blur keyup change paste', function () {
                $scope.$apply(read);
            });
        }
    }
}]);