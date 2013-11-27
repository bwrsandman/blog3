angular.module('eg.goal').directive('egEditor', function ($debounce) {
    return {
        restrict: 'E',
        scope: {
            model: '=ngModel',
            onChange: '&',
            ngFocus: '&',
            submodel: '='
        },
        template: '<textarea msd-elastic="\n\n" ng-model="model" ng-keyup="keyup($event)"></textarea>',
        link: function ($scope, element, attrs) {
            var textarea = element.find('textarea');
            if (attrs.placeholder) {
                textarea.attr('placeholder', $scope.$parent.$eval(attrs.placeholder));
            }

            textarea.focus(function() {
                $scope.ngFocus();
            });

            function a() {
                $scope.model = textarea.val()
                $scope.onChange();
            }

            $scope.keyup = $debounce(a, 1000);
            textarea.keyup(function () {
                $scope.$apply(function() {
                    $scope.keyup()
                });
            });
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