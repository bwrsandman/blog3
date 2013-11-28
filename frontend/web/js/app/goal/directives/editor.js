angular.module('eg.goal').directive('egEditor', function ($debounce) {
    return {
        restrict: 'E',
        scope: {
            model: '=ngModel',
            ngChange: '&',
            ngFocus: '&',
            submodel: '='
        },
        template: '<textarea msd-elastic="\n\n" ng-model="model" ng-change="onChange()" ng-focus="ngFocus()"></textarea>',
        link: function ($scope, element, attrs) {
            var textarea = element.find('textarea');
            if (attrs.placeholder) {
                textarea.attr('placeholder', $scope.$parent.$eval(attrs.placeholder));
            }

            $scope.onChange = $debounce(function() {$scope.ngChange()}, 1000);
        }
    };
});

angular.module('eg.goal').directive('egGoalPane', function ($debounce) {
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