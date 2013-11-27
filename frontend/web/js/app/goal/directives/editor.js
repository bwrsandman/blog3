angular.module('eg.goal').directive('egEditor', function ($debounce) {
    return {
        restrict: 'E',
        scope: {
            model: '=ngModel',
            ngChange: '&',
            submodel: '='
        },
        template: '<textarea msd-elastic="\n\n" ng-model="model"></textarea>',
        link: function ($scope, element, attrs) {
            if (attrs.placeholder) {
                element.find('textarea').attr('placeholder', $scope.$parent.$eval(attrs.placeholder));
            }
            var onChange = function (newVal, oldVal) {
                if (newVal != oldVal) {
                    $scope.ngChange();
                }
            };
            $scope.$watch("model", $debounce(onChange, 1000), true);
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