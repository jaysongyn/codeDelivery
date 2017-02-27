angular.module('controllers')
    .controller('ClientCheckoutDetailCtrl',['$stateParams','$cart','$scope','$state',function($stateParams,$cart,$scope,$state){
        $scope.product = $cart.getItem($stateParams.index);

        $scope.updateQtd = function(){
            $cart.updateQtd($stateParams.index,$scope.product.qtd);
            $state.go('client.checkout');
        }
    }]);
