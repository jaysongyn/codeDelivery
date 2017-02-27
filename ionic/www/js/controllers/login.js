angular.module('controllers')
    .controller('LoginCtrl',['$scope','OAuth','$cookies','$ionicPopup','$state',function($scope,OAuth,$cookies,$ionicPopup,$state){

        $scope.user = {
            username: '',
            password: ''
        }

        $scope.login = function (){
            console.log("adfq");
            OAuth.getAccessToken($scope.user,$scope.password)
                .then(function(data){
                $state.go('client.checkout');
            },function(responseError){
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: 'Login e/ou senha inválidos!'
                })
            });
        }
    }]);
