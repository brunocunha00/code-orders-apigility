/**
 * Created by Bruno on 05/03/2016.
 */

angular.module('starter.controllers', [])
    .controller('LoginController', ['$scope', '$http', '$state', 'OAuth',
        function($scope, $http, $state, OAuth){
            $scope.login = function(data){
                OAuth.getAccessToken(data)
                    .then(function(){
                        $state.go('tabs.orders');
                    }, function(){
                        $scope.error_message = "Usuário/Senha inválidos."
                    });
            }

        }
    ])