'use strict';

angular.module('MapApp').controller('PlacesListController', ['$scope', '$rootScope', 'Places', '$dialog', 'lang', 'alertService'
    , function($scope, $rootScope, Places, $dialog, lang, alertService) {
        $scope.curLang = lang;
        alertService.add('danger', 'nooooo!!!');
        $rootScope.$broadcast('notification:add',{type:"success", msg:'yes!'});

        $scope.places = Places.getAll();

        $rootScope.$on('places:updated', function() {
            $scope.places = Places.getAll();
        });

        $scope.isEmpty = function() {
            if ($scope.places.length === 0) {
                return true;
            }
            return false;
        }

        $scope.confirm = function(place) {
            var title = 'Confirm';
            var msg = 'Do you really want to delete this place?';
            var btns = [{result:'no', label: 'No'}, {result:'yes', label: 'Yes', cssClass: 'btn-primary'}];

            $dialog.messageBox(title, msg, btns)
                .open()
                .then(function(result){
                    if (result === 'yes') {
                        $scope.delete(place);
                    }
                });
        }

        $scope.delete = function(place) {
            Places.delete(place);
        }

        $scope.show = function(place) {
            $rootScope.$broadcast('place:show', place);
        }
    }]);