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
    .controller('OrderController', ['$scope', '$http', '$state',
        function($scope, $http, $state){
            $scope.getOrders = function (){
                $http.get('http://localhost:8888/orders').then(
                    function(data){
                        $scope.orders = data.data._embedded.orders;
                        console.log($scope.orders);
                    }
                )
            };

            $scope.doRefresh = function(){
                $scope.getOrders();
                $scope.$broadcast('scroll.refreshComplete');
            };

            $scope.onOrderDelete = function(order){
                $http.delete('http://localhost:8888/orders/'+ order.id);
                $scope.getOrders();
            };
            $scope.getOrders();

        }
    ])
