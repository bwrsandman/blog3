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
            $scope.$watch("model", $debounce($scope.ngChange, 1000), true);
        }
    };
});