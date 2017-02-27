angular.module('controllers')
    .controller('ClientOrderCtrl',[
        '$scope','$ionicLoading','Order',
        function($scope,$ionicLoading,Order){

            $scope.items  = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });


            function getOrders(){
               return  Order.query({
                    id: null,
                    orderBy: 'created_at',
                    sorteBy: 'desc'
                }).$promise;
            }

            $scope.doRefresh = function()
            {
                getOrders().then(function(data){
                    $scope.items = data.data;
                  $scope.$broadcast('scroll.refreshComplete');
                },function(dataError){
                    $scope.$broadcast('scroll.refreshComplete');
                })
            }


            getOrders().then( function(data){

                $scope.items = data.data;
                $ionicLoading.hide();
            },function(dataError){
                $ionicLoading.hide();
            });




    }]);

