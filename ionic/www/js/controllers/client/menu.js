angular.module('controllers')
    .controller('ClientMenuCtrl',[
        '$scope','$ionicLoading','User',
        function($scope,$ionicLoading,User){

            $scope.user = {
                name: 'teste'
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            User.authenticated({},function(data){
                $scope.user = data.data;
                $ionicLoading.hide();
            },function(dataError){
                $ionicLoading.hide();
            })
    }]);

