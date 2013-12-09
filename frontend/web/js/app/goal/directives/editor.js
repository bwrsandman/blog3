angular.module('eg.goal').directive('egEditor', function ($debounce) {
    var some = {};

    return {
        restrict: 'E',
        scope: {
            ngModel: '=',
            ngChange: '&',
            ngFocus: '&',
            submodel: '=',
            fg: '&'
        },
        template: '<textarea msd-elastic="" ng-model="ngModel" ng-change="onChange()" ng-focus="ngFocus()"></textarea>',
        link: function ($scope, element, attrs) {
            var textarea = element.find('textarea');
            if (attrs.placeholder) {
                textarea.attr('placeholder', $scope.$parent.$eval(attrs.placeholder));
            }

            $scope.onChange = $debounce($scope.ngChange, 1000);
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